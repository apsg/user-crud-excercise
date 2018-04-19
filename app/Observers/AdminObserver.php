<?php

namespace App\Observers;

use App\Admin;

class AdminObserver{
	
	/**
	 * Delete all users created by this admin.
	 * @param  Admin  $admin [description]
	 * @return [type]        [description]
	 */
	public function deleting(Admin $admin){
		$admin->users()->delete();
	}

}