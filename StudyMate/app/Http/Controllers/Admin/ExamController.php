<?php

namespace App\Http\Controllers\Admin;

use App\Exam;
use App\ExamType;
use App\Http\Controllers\Controller;
use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        if ($request->examtype === 'exam') {
            $exam = Module::where('id', '=', $request->id)
                ->first()
                ->exams()
                ->where('examtype_id', '=', ExamType::EXAM)
                ->first();
            if ($exam != null) {
                $exam->description = $request->description;
                $exam->deadline_date = $request->deadline;

                if ($exam->save()) {
                    $request->session()->flash('success', $exam->description.' has been updated.');
                } else {
                    $request->session()->flash('error', $exam->description.' could not be updated.');
                }
            } else {
                $exam = Exam::create([
                    'description' => $request['description'],
                    'deadline_date' => $request['deadline'],
                    'is_finished' => 0,
                    'module_id' => $request['id'],
                    'examtype_id' => ExamType::EXAM,
                ]);

                $request->session()->flash('success', $exam->description.' has been created.');
            }
        }

        if ($request->examtype === 'assessment') {
            $assessment = Module::where('id', '=', $request->id)
                ->first()
                ->exams()
                ->where('examtype_id', '=', ExamType::ASSESSMENT)
                ->first();
            if ($request->zipfile != '') {
                $request->zipfile->storeAs('exam_files', $request->zipfile->getClientOriginalName());
                $filename = $request->zipfile->getClientOriginalName();
            }
            if ($assessment != null) {
                $assessment->description = $request->description;
                $assessment->deadline_date = $request->deadline;
                $assessment->appendix = $filename;

                if ($assessment->save()) {
                    $request->session()->flash('success', $assessment->description.' has been updated.');
                } else {
                    $request->session()->flash('error', $assessment->description.' could not be updated.');
                }
            } else {
                if ($filename != null) {
                    $exam = Exam::create([
                        'description' => $request['description'],
                        'deadline_date' => $request['deadline'],
                        'appendix' => $filename,
                        'is_finished' => 0,
                        'module_id' => $request['id'],
                        'examtype_id' => ExamType::ASSESSMENT,
                    ]);
                    $request->session()->flash('success', $exam->description.' has been created.');
                } else {
                    $exam = Exam::create([
                        'description' => $request['description'],
                        'deadline_date' => $request['deadline'],
                        'is_finished' => 0,
                        'module_id' => $request['id'],
                        'examtype_id' => ExamType::ASSESSMENT,
                    ]);
                    $request->session()->flash('success', $exam->description.' has been created.');
                }
            }
        }

        if ($request->examtype === 'assignment') {
            $assignment = Module::where('id', '=', $request->id)
                ->first()
                ->exams()
                ->where('examtype_id', '=', ExamType::ASSIGNMENT)
                ->first();
            if ($assignment != null) {
                $assignment->description = $request->description;
                $assignment->deadline_date = $request->deadline;

                if ($assignment->save()) {
                    $request->session()->flash('success', $assignment->description.' has been updated.');
                } else {
                    $request->session()->flash('error', $assignment->description.' could not be updated.');
                }
            } else {
                $exam = Exam::create([
                    'description' => $request['description'],
                    'deadline_date' => $request['deadline'],
                    'is_finished' => 0,
                    'module_id' => $request['id'],
                    'examtype_id' => ExamType::ASSIGNMENT,
                ]);

                $request->session()->flash('success', $exam->description.' has been created.');
            }
        }
        return redirect()->route('admin.modules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Module $moduleid
     * @return \Illuminate\Http\Response
     */
    public function show($moduleid)
    {
        $module = Module::where('id', '=', $moduleid)->first();
        $exam = $module
            ->exams()
            ->where('examtype_id', '=', ExamType::EXAM)
            ->first();
        $assessment = $module
            ->exams()
            ->where('examtype_id', '=', ExamType::ASSESSMENT)
            ->first();
        $assignment = $module
            ->exams()
            ->where('examtype_id', '=', ExamType::ASSIGNMENT)
            ->first();

        return view('admin.exams.show', [
            'moduleid' => $moduleid,
            'assessment' => $assessment,
            'exam' => $exam,
            'assignment' => $assignment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroyAppendix($examid)
    {
        $exam = Exam::where('id', '=', $examid)->first();
        $filename = $exam->appendix;
        $exam->appendix = null;
        $exam->save();
        unlink(storage_path('app\public\exam_files\\'.$filename));
        return redirect()->route('admin.modules.index');
    }

    public function downloadZipfile($examid)
    {
        $filename = Exam::where('id', '=', $examid)->pluck('appendix')->first();
        //dd($filename);
        return response()->download(storage_path('app\public\exam_files\\'.$filename));
    }
}
