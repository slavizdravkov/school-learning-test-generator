@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if(empty($subject->id))
                            Добави учебен предмет
                        @else
                            Редактирай учебен предмет
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ route('subject.edit', array('subject' => $subject)) }}" method="post">
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="subject-name">Учебен предмет</label>
                                    <input id="subject-name" type="text" class="form-control" name="name" value="{{ $subject->name }}">
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="teacher-name">Име на преподавател</label>
                                    <select name="teacher_id" id="teacher-name" class="form-control">
                                        <option value="">Моля, изберете</option>
                                        @foreach($teachers as $id => $teacherName)
                                            <option
                                                value="{{ $id }}"
                                                {{ $subject->teacher_id == $id ? 'selected="selected"' : ''}}
                                            >
                                                {{ $teacherName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2">
                                @if(empty($subject->id))
                                    Добави
                                @else
                                    Редактирай
                                @endif
                            </button>
                            <a href="{{ route('subject.list') }}" class="btn btn-primary float-right">Отказ</a>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
