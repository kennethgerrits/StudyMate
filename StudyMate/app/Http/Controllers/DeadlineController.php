<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamType;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function index($column = null, $order = null, $table = null)
    {
//        if($table != null){
//            dd($table, $column);
//        }
        $lastorder = 'asc';
        if($table != null){
            if($order == 'asc'){
                $exams = Exam::with($table)
                    ->where('is_finished', '=', false)
                    ->where('deadline_date', '>=', Carbon::now()->toDate())->get()
                    ->sortByDesc($table.'.'.$column);
                $lastorder = 'desc';
            }else{
                $exams = Exam::with($table)
                    ->where('is_finished', '=', false)
                    ->where('deadline_date', '>=', Carbon::now()->toDate())->get()
                    ->sortBy($table.'.'.$column);
            }
        }elseif($table == null && $column != null){
            $exams = Exam::where('is_finished', '=', false)->where('deadline_date', '>=', Carbon::now()->toDate())->orderBy($column, $order)->get();
            if($order == 'asc'){
                $lastorder = 'desc';
            }else{
                $lastorder = 'asc';
            }
        }
        else{
            $exams = Exam::where('is_finished', '=', false)->where('deadline_date', '>=', Carbon::now()->toDate())->get();
        }
        $tags = Tag::all();
        return view('deadlines.index',[
            'exams' => $exams,
            'tags' => $tags,
            'order' => $lastorder
        ]);
    }

    public function indexSort(Request $request){
        dd($request);
        $tags = Tag::all();
        $sortTable = $request->get('table') ?? 'events';
        $sortColumn = $request->get('column') ?? 'start_date';
        $sortOrder = $request->get('order') ?? 'desc';
        $exams = Exam::where('is_finished', '=', false)->where('deadline_date', '>=', Carbon::now()->toDate())->orderBy($sortTable.'.'.$sortColumn, $sortOrder);
        return view('deadlines.index',[
            'exams' => $exams,
            'tags' => $tags
        ]);
    }

    public function saveChanges(Request $request){
        $delimiters = collect(['[', ']']);
        foreach ($request->tags as $tag){
            $tag = str_replace(['[', ']'], '', $tag);
            $tag = explode(',', $tag);
            $exam = Exam::where('id', '=', $tag[0])->first();
            $exam->tag_id = $tag[1];
            $exam->save();
        }
        if($request->finished != null){
            foreach($request->finished as $finishedid){
                $target = Exam::where('id', '=', $finishedid)->first();
                $target->is_finished = true;
                $target->save();
            }
        }
        return redirect()->route('getDeadlineManagerIndex');
    }

}
