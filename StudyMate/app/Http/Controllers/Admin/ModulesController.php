<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
use App\Module;
use App\Period;
use App\User;
use Illuminate\Http\Request;

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
        $users = User::all();
        $teachers = collect();
        foreach ($users as $user) {
            if ($user->hasRole('teacher')) {
                $teachers->push($user);
            }
        }

        $blocks = Block::all();
        $periods = Period::all();

        return view('admin.modules.create', [
            'teachers' => $teachers,
            'blocks' => $blocks,
            'periods' => $periods
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $module = Module::create([
            'name' => $request['name'],
            'overseer' => $request['overseer'],
            'taught_by' => $request['taught_by'],
            'block_id' => $request['block_id'],
            'period_id' => $request['period_id'],
            'study_points' => $request['study_points'],
            'is_finished' => $request['is_finished'],
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
        $users = User::all();
        $teachers = collect();
        foreach ($users as $user) {
            if ($user->hasRole('teacher')) {
                $teachers->push($user);
            }
        }

        $blocks = Block::all();
        $periods = Period::all();

        return view('admin.modules.edit')->with([
            'module' => $module,
            'teachers' => $teachers,
            'blocks' => $blocks,
            'periods' => $periods
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
        //$module->sync($request->modules);

        $module->name = $request->name;
        $module->overseer = $request->overseer;
        $module->taught_by = $request->taught_by;
        $module->block_id = $request->block_id;
        $module->period_id = $request->period_id;
        $module->study_points = $request->study_points;
        $module->is_finished = $request->is_finished;


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
        if ($module->delete()) {
            $request->session()->flash('success', $module->name.' has been deleted.');
        } else {
            $request->session()->flash('error', $module->name.' could not be deleted.');
        }

        return redirect()->route('admin.modules.index');
    }

}
