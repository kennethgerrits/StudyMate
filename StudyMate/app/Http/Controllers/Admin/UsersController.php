<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Module;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('edit-users')) {
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();
        $modules = Module::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'modules' => $modules
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->modules()->sync($request->modules);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->save()) {
            $request->session()->flash('success', $user->name.' has been updated.');
        } else {
            $request->session()->flash('error', $user->name.' could not be updated.');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, User $user)
    {
        if (Gate::denies('destroy-users')) {
            return redirect(route('admin.users.index'));
        }
        $user->roles()->detach();

        if($user->delete()){
            $request->session()->flash('success', $user->name.' has been deleted.');
        }else {
            $request->session()->flash('error', $user->name.' could not be deleted.');
        }

        return redirect()->route('admin.users.index');
    }
}