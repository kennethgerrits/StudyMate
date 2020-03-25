<?php

namespace App\Http\Controllers;

use App\Exam;
use App\ExamType;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    public function index()
    {
        $exams = Exam::where('is_finished', '=', false)->where('deadline_date', '>=', Carbon::now()->toDate())->get();
        $tags = Tag::all();
        return view('deadlines.index',[
            'exams' => $exams,
            'tags' => $tags
        ]);
    }

    public function indexSort(Request $request){
        $sortTable = $request->get('table') ?? 'events';
        $sortColumn = $request->get('column') ?? 'start_date';
        $sortOrder = $request->get('order') ?? 'desc';
        $laravel_query->orderBy($sortTable.'.'.$sortColumn, $sortOrder);
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
