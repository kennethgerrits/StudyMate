<?php

namespace App\Http\Controllers;

use App\Module;
use App\Role;
use App\User;

class DashboardController extends Controller
{

    public function index()
    {
        $guest = User::wherehas('roles', function ($query) {
            $query->where('role_id', '=', Role::GUEST);
        })->first();
        $modules = Module::all();

        return view('dashboard.index', [
            'guest' => $guest,
            'maxEC' => $guest->max_ec,
            'achievedEC' => $guest->achieved_ec,
            'modules' => $modules,
            'barwidth' => $guest->progress_percentage
        ]);
    }

    public function details($block_id)
    {
        $guest = User::wherehas('roles', function ($query) {
            $query->where('role_id', '=', Role::GUEST);
        })->first();
        $modules = Module::all();
        $maxEC = 0;
        $achievedEC = 0;
        $barwidth = '';

        foreach ($guest->modules()->where('block_id', '=', $block_id)->get() as $module) {
            $maxEC += $module->study_points;
            if ($module->is_finished) {
                $achievedEC += $module->study_points;
            }
        }

        if ($maxEC > 0) {
            $percentage = round(($achievedEC / $maxEC * 100), -1);
        } else {
            $percentage = 0;
        }

        switch ($percentage) {
            case 0:
                $barwidth = 'nullpercent';
                break;
            case 10:
                $barwidth = 'tenpercent';
                break;
            case 20:
                $barwidth = 'twentypercent';
                break;
            case 30:
                $barwidth = 'thirtypercent';
                break;
            case 40:
                $barwidth = 'fourtypercent';
                break;
            case 50:
                $barwidth = 'fiftypercent';
                break;
            case 60:
                $barwidth = 'sixtypercent';
                break;
            case 70:
                $barwidth = 'seventypercent';
                break;
            case 80:
                $barwidth = 'eightypercent';
                break;
            case 90:
                $barwidth = 'ninetypercent';
                break;
            case 100:
                $barwidth = 'onehundredpercent';
                break;
        }

        return view('dashboard.details', [
            'guest' => $guest,
            'maxEC' => $maxEC,
            'achievedEC' => $achievedEC,
            'modules' => $modules,
            'id' => $block_id,
            'barwidth' => $barwidth
        ]);
    }
}
