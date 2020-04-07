<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function index(Request $request, $subjectId)
    {
        $subject = Subject::where('id', $subjectId)->first();
        $lessons = Lesson::where('subject_id', $subjectId)->orderBy('number', 'ASC')->get();

        return view('lesson.list', array('subject' => $subject, 'lessons' => $lessons));
    }

    public function edit(Request $request, $subjectId, Lesson $lesson)
    {
        if ($request->isMethod('POST')) {
            $validation = Validator::make($request->all(), array(
                'number' => 'required',
                'name' => 'required',
            ));

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors());
            }

            $lesson->number = $request->request->get('number');
            $lesson->name = $request->request->get('name');
            $lesson->subject_id = $subjectId;

            $lesson->save();

            return redirect()->route('subject.lesson.list', array('subjectId' => $subjectId));
        }


        return view('lesson.edit', array('lesson' => $lesson, 'subjectId' => $subjectId));
    }
}
