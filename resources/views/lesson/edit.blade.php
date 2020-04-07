@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if(empty($lesson->id))
                            Добави тема
                        @else
                            Редактирай тема
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ route('subject.lesson.edit', array('subjectId' => $subjectId, 'lesson' => $lesson)) }}" method="post">
                            <div class="row">
                                <div class="col-3 form-group">
                                    <label for="lesson-number">Номер на темата</label>
                                    <input id="lesson-number" type="text" class="form-control" name="number" value="{{ $lesson->number }}">
                                </div>
                                <div class="col-12 form-group">
                                    <label for="lesson-name">Име на темата</label>
                                    <textarea name="name" id="lesson-name" class="form-control" cols="30" rows="3">{{ $lesson->name }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2">
                                @if(empty($lesson->id))
                                    Добави
                                @else
                                    Редактирай
                                @endif
                            </button>
                            <a href="{{ route('subject.lesson.list', array('subjectId' => $subjectId)) }}" class="btn btn-primary float-right">Отказ</a>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
