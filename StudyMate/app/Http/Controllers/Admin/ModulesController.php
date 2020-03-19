<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index')->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = Module::create([
            'name' => $request['name'],
            'overseer' => $request['overseer'],
        ]);

        $request->session()->flash('success', $module->name.' has been created.');


        return redirect()->route('admin.modules.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Module $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        return view('admin.modules.edit')->with([
            'module' => $module
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Module $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $module->users()->sync($request->modules);

        $module->name = $request->name;
        $module->overseer = $request->overseer;

        if ($module->save()) {
            $request->session()->flash('success', $module->name.' has been updated.');
        } else {
            $request->session()->flash('error', $module->name.' could not be updated.');
        }

        return redirect()->route('admin.modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\Module $module
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Module $module)
    {
        $module->users()->detach();

        if ($module->delete()) {
            $request->session()->flash('success', $module->name.' has been deleted.');
        } else {
            $request->session()->flash('error', $module->name.' could not be deleted.');
        }

        return redirect()->route('admin.modules.index');
    }
}
