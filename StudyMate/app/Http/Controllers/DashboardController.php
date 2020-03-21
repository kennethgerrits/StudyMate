<?php

namespace App\Http\Controllers;

use App\Module;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $guest = User::wherehas('roles', function ($query){
            $query->where('role_id','=', Role::GUEST);
        })->first();
        $modules = Module::all();
        $maxEC = 0;
        $achievedEC = 0;
        foreach ($guest->modules()->get() as $module){
            $maxEC += $module->study_points;
            if($module->is_finished){
                $achievedEC += $module->study_points;
            }
        }

        return view('dashboard.dashboard',[
            'guest' => $guest,
            'maxEC' => $maxEC,
            'achievedEC' => $achievedEC,
            'modules' => $modules
        ]);
    }

    public function details($block_id){
        $guest = User::wherehas('roles', function ($query){
            $query->where('role_id','=', Role::GUEST);
        })->first();
        $modules = Module::all();
        $maxEC = 0;
        $achievedEC = 0;
        foreach ($guest->modules()->where('block_id', '=', $block_id)->get() as $module){
            $maxEC += $module->study_points;
            if($module->is_finished){
                $achievedEC += $module->study_points;
            }
        }

        return view('dashboard.dashboarddetails',[
            'guest' => $guest,
            'maxEC' => $maxEC,
            'achievedEC' => $achievedEC,
            'modules' => $modules,
            'id' => $block_id
        ]);
    }
}
