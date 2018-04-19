<?php

namespace App\Http\Controllers;

use App\User;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Protect these actions with authorization middleware
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Return requested data for DataTables
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getData(Request $request){
        return DataTables::of(\Auth::user()->users)
            ->addColumn('options', function(User $user){
                return view('users.options')->with(compact('user'));
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if( ! \Auth::user()->can('create', \App\User::class) ){
            return response()->json('You are not authorized to do that.', 403);
        }

        return \Auth::user()
            ->users()
            ->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if( ! \Auth::user()->can('view', $user) ){
            if(request()->expectsJson())
                return response()->json('You are not authorized to do that.', 403);
            else
                return back()
                    ->withErrors(['You are not authorized to edit this user.']);
        }

        return view('users.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  User  $user
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserRequest $request)
    {
        if( ! \Auth::user()->can('update', $user) ){
            if(request()->expectsJson())
                return response()->json('You are not authorized to do that.', 403);
            else
                return back()
                    ->withErrors(['You are not authorized to modify this user.']);
        }

        $user->update($request->all());

        return response()->json('Updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if( ! \Auth::user()->can('delete', $user) ){
            if(request()->expectsJson())
                return response()->json('You are not authorized to do that.', 403);
            else
                return back()
                    ->withErrors(['You are not authorized to delete this user.']);
        }

        $user->delete();

        if(request()->expectsJson())
            return response()->json('DELETED', 200);
        else
            return back()->with(['status' => 'Deleted']);
    }
}
