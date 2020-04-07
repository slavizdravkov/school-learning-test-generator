<?php

namespace App\Http\Controllers;

use App\Subject;
use App\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name', 'asc')->get();

        return view('subject.list', array('subjects' => $subjects));
    }

    public function edit(Request $request, Subject $subject)
    {
        $teachers = User::all()->pluck('name', 'id');

        if ($request->isMethod('POST')) {
            $validation = Validator::make($request->all(), array(
                'name' => 'required',
                'teacher_id' => 'required|in:' . implode(',', array_keys($teachers->toArray()))
            ));
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->errors());
            }

            $subject->name = $request->request->get('name');
            $subject->teacher_id = $request->request->get('teacher_id');
            $subject->save();

            return redirect()->route('subject.list');
        }

        return view('subject.edit', array(
                'subject' => $subject,
                'teachers' => $teachers
            )
        );
    }
}
