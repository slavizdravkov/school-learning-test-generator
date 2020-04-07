@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Учебни предмети
                        <a href="{{ route('subject.edit') }}" class="btn btn-primary float-right">Добави</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Име</th>
                                <th class="text-center w-25">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('subject.edit', array('subject' => $subject)) }}">Редакция</a>
                                        | <a href="{{ route('subject.lesson.list', array('id' => $subject->id)) }}">Уроци</a>
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
