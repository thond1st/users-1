<?php

namespace Vitorbar\Users\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Vitorbar\Users\Role;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('users')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('users::role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users::role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
        ]);

        try {
            Role::create($data);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([$e->getMessage()]);
        }

        return redirect()->route('role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id)->first();

        if (! $role) {
            request()->route('role.index')
                ->withErrors('Função não encontrada.');
        }

        return view('users::role.edit', compact('role'));
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
        $role = Role::find($id)->first();

        if (! $role) {
            request()->route('role.index')
                ->withErrors('Função não encontrada.');
        }

        try {
            $role->name = $request->get('name');
            $role->save();
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id)->first();

        if (! $role) {
            request()->route('role.index')
                ->withErrors('Função não encontrada.');
        }

        DB::beginTransaction();

        try {
            foreach ($role->users as $user) {
                $user->delete();
            }

            $role->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withErrors($e->getMessage());
        }

        DB::commit();

        return redirect()->route('role.index');
    }
}
