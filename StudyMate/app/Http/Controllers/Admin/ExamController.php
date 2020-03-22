<?php

namespace App\Http\Controllers\Admin;

use App\Exam;
use App\ExamType;
use App\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\AssignOp\Mod;


class ExamController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->zipfile->storeAs('exam_files', $request->zipfile->getClientOriginalName());
        $filename =$request->zipfile->getClientOriginalName();
        if($request->examtype == 'assessment')
        $exam = Exam::create([
            'description' => $request['description'],
            'deadline_date' => $request['deadline'],
            'appendix' => $filename,
            'is_finished' => 0,
            'module_id' => 1,
            'examtype_id' => ExamType::ASSESSMENT,
        ]);

        $request->session()->flash('success', $exam->description.' has been created.');
        return redirect()->route('admin.modules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $moduleid
     * @return \Illuminate\Http\Response
     */
    public function show($moduleid)
    {
        $module = Module::where('id', '=', $moduleid)->first();
        $assessment = $module->exams()
            ->where('examtype_id', '=', ExamType::ASSESSMENT)
            ->first();
        return view('admin.exams.show',[
            'id' => $moduleid,
            'assessment' => $assessment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
