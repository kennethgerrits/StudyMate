<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamType;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        $examtypes = ExamType::all();
        return view('deadlines.index',[
            'exams' => $exams,
            'examtypes' => $examtypes,
        ]);
    }

}
