<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(){
        $guest = User::where('id', '=', '4')->first();
        $potential = 0;
        $achieved = 0;
        foreach ($guest->modules()->get() as $module){
            $potential += $module->study_points;
            if($module->is_finished){
                $achieved += $module->study_points;
            }
        }

        return view('dashboard',[
            'guest' => $guest,
            'potential' => $potential,
            'achieved' => $achieved
        ]);
    }
}
