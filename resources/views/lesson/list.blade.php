@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        {{ $subject->name }} - Уроци
                        <a href="{{ route('subject.lesson.edit', array('subjectId' => $subject->id)) }}" class="btn btn-primary float-right">Добави</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Номер на урока</th>
                                <th class="text-center">Тема</th>
                                <th class="text-center w-25">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <td class="text-center">{{ $lesson->number }}</td>
                                    <td>{{ $lesson->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('subject.lesson.edit', array('subjectId' => $subject->id, 'lesson' => $lesson)) }}">Редакция</a>
                                        | <a href="#">Въпроси</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
