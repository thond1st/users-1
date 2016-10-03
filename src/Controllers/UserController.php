<?php

namespace Vitorbar\Users\Controllers;

use Illuminate\Http\Request;

use Vitorbar\Users\Role;
use Vitorbar\Users\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter['email'] = $request->get('email');
        $filter['name']  = $request->get('name');
        $filter['phone'] = $request->get('phone');

        $users = User::with('role')
            ->where('email', 'like', '%' . $filter['email'] . '%')
            ->where('name', 'like', '%' . $filter['name'] . '%')
            ->where('phone_number', 'like', '%' . $filter['phone'] . '%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users::user.index', compact('users', 'roles', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('name', 'id')
            ->orderBy('name', 'asc')
            ->get();

        if (! $roles->count()) {
            return redirect()
                ->route('role.create')
                ->withErrors('É necessário criar uma função antes de criar um usuário.');
        }

        return view('users::user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Vitorbar\Users\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'role_id',
            'email',
            'phone_prefix',
            'phone_number',
            'password',
            'password_confirm',
        ]);

        try {
            User::create($data);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->first();

        if (! $user) {
            request()->route('user.index')
                ->withErrors('Usuário não encontrado.');
        }

        $roles = Role::select('name', 'id')
            ->orderBy('name', 'asc')
            ->get();

        return view('users::user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id)->first();

        if (! $user) {
            request()->route('role.index')
                ->withErrors('Usuário não encontrado.');
        }

        try {
            $user->name = $request->get('name');
            $user->role_id = $request->get('role_id');
            $user->email = $request->get('email');
            $user->phone_prefix = $request->get('phone_prefix');
            $user->phone_number = $request->get('phone_number');
            $user->save();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->firstOrFail();

        if (! $user->delete())
            return redirect()->back()->withErrors($user->getErrors());

        return redirect()->route('user.index');
    }
}
