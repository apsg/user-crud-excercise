<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFeatureTest extends TestCase
{

	public function setUp(){
		parent::setUp();

		// Ensure there are at least 2 admins in the DB for the tests
		factory(\App\Admin::class, max(0, 2 - \App\Admin::count()))
			->create();
		
		// Ensure each admin has at least one associated user
		\App\Admin::all()->each(function($admin){
			if($admin->users()->count() < 1){
				$admin->users()
					->create(factory(\App\User::class)
						->make()
						->toArray()
					);
			}
		});

	}

	public function test_guest_cannot_see_users_page(){
		$this->get('/users')->assertStatus(302);
	}

	public function test_admin_can_visit_users_page(){

		$admin = \App\Admin::first();

		$this->actingAs($admin)
			->get('/users')
			->assertStatus(200)
			->assertSee('Your users');
	}

	public function test_guest_cannot_create_new_users(){
		
		$data = factory(\App\User::class)->make()->toArray();

		$this->json('POST', 
				'/users', 
				$data)
			->assertStatus(401);

		$this->assertDatabaseMissing('users', $data);

	}

	public function test_admin_can_create_users(){

		$admin = \App\Admin::first();

		$fakedUser = factory(\App\User::class)->make()->toArray();

		$response = $this->actingAs($admin)
			->json('POST', 
				'/users', 
				$fakedUser);
		
		$response->assertStatus(201);

		$response->assertJson($fakedUser);

		$this->assertDatabaseHas('users', $fakedUser);

		$response->original->delete();
	}

	public function test_controller_validates_data_when_creating_users(){

		$admin = \App\Admin::first();

		$fakedUser = factory(\App\User::class)->make()->toArray();

		$testData = $fakedUser;
		$testData['name'] = '';

		$this->actingAs($admin)
			->json('POST', 
				'/users', 
				$testData)
			->assertStatus(422);

		$testData = $fakedUser;
		$testData['surname'] = '';

		$this->actingAs($admin)
			->json('POST', 
				'/users', 
				$testData)
			->assertStatus(422);

		$testData = $fakedUser;
		$testData['phone'] = '';

		$this->actingAs($admin)
			->json('POST', 
				'/users', 
				$testData)
			->assertStatus(422);

		$testData = $fakedUser;
		$testData['phone'] .= 'invalid characters';

		$this->actingAs($admin)
			->json('POST', 
				'/users', 
				$testData)
			->assertStatus(422);

		$testData = $fakedUser;
		$testData['address'] = '';

		$this->actingAs($admin)
			->json('POST', 
				'/users', 
				$testData)
			->assertStatus(422);
	}

	public function test_guest_cannot_receive_datatables_data(){
		$this->json('GET', '/users/data')->assertStatus(401);
	}

	public function test_admin_receives_correct_datatables_data(){

		$admin = \App\Admin::first();

		$response = $this->actingAs($admin)
			->json('GET', '/users/data');

		$response->assertStatus(200);

		$response->assertJsonStructure([
			'draw',
			'recordsTotal',
			'recordsFiltered',
			'data',
		]);
	}

	public function test_guest_cannot_access_edit_user_page(){
		$user = \App\User::inRandomOrder()->first();
		$this->json('GET', '/users/'.$user->id)->assertStatus(401);
	}

	public function test_admin_can_access_edit_page_of_user_he_owns(){

		$admin = \App\Admin::first();
		$user = $admin->users()->inRandomOrder()->first();

		$this->actingAs($admin)
			->json('GET', '/users/'.$user->id)
			->assertStatus(200)
			->assertSee('Edit user #'.$user->id);
	}

	public function test_admin_cannot_access_edit_page_of_user_he_does_not_own(){

		$admin = \App\Admin::inRandomOrder()->first();
		$otherAdmin = \App\Admin::where('id', '!=', $admin->id)->first();

		$user = $otherAdmin->users()->inRandomOrder()->first();

		$this->actingAs($admin)
			->get('/users/'.$user->id)
			->assertStatus(302);
	}

	public function test_guest_cannot_edit_users(){

		$user = \App\User::inRandomOrder()->first();

		$data = $user->toArray();
		$data['name'] .= 'modified';

		$this->json('PATCH', '/users/'.$user->id, $data)
			->assertStatus(401);
	}

	public function test_admin_can_edit_his_users(){

		$admin = \App\Admin::inRandomOrder()->first();
		$user = $admin->users()->inRandomOrder()->first();

		$data = $user->toArray();
		unset($data['id']);
		unset($data['created_at']);
		unset($data['updated_at']);
		unset($data['owner_id']);
		$originalData = $data;

		$data['name'] .= 'modified';

		$this->actingAs($admin)
			->json('PATCH', '/users/'.$user->id, $data)
			->assertStatus(200);

		$this->assertDatabaseHas('users', $data);

		$user->fresh()->update($originalData);
	}


	public function test_admin_cannot_edit_user_he_does_not_own(){

		$admin = \App\Admin::inRandomOrder()->first();
		$user = \App\User::where('owner_id', '!=', $admin->id)
			->inRandomOrder()
			->first();

		$data = $user->toArray();
		unset($data['id']);
		unset($data['created_at']);
		unset($data['updated_at']);
		unset($data['owner_id']);
		$data['name'] .= 'modified';

		$this->actingAs($admin)
			->json('PATCH', '/users/'.$user->id, $data)
			->assertStatus(403);
		
		$this->assertDatabaseMissing('users', $data);

	}


	public function test_guest_cannot_delete_users(){

		$user = \App\User::inRandomOrder()->first();

		$this->json('DELETE', '/users/'.$user->id)
			->assertStatus(401);

		$this->assertDatabaseHas('users', $user->toArray());
	}

	public function test_admin_can_delete_user_he_owns(){
		$admin = \App\Admin::inRandomOrder()->first();
		$user = $admin->users()->inRandomOrder()->first();

		$originalData = $user->only('name', 'surname', 'phone', 'address');

		$this->actingAs($admin)
			->json('DELETE', '/users/'.$user->id)
			->assertStatus(200);

		$this->assertDatabaseMissing('users', $originalData);

		$admin->users()->create($originalData);
	}

	public function test_admin_cannot_delete_user_he_does_not_own(){

		$admin = \App\Admin::inRandomOrder()->first();
		$user = \App\User::where('owner_id', '!=', $admin->id)
			->inRandomOrder()
			->first();

		$this->actingAs($admin)
			->json('DELETE', '/users/'.$user->id)
			->assertStatus(403);

		$this->assertDatabaseHas(
			'users', 
			$user->only('name', 'surname', 'phone', 'address') 
		);

	}


}
