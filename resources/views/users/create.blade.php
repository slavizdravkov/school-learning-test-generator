@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if(empty($user))
                            <h4 class="mb-0">Добавяне на потребител</h4>
                        @else
                            <h4 class="mb-0">Редактиране на потребител</h4>
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ empty($user) ? route('users.store') : route('users.update', $user) }}" method="post">
                            @isset($user)@method('PUT')@endisset
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="user-name">Име и фамилия</label>
                                    <input
                                        id="user-name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name', $user->name ?? '') }}"
                                        @if($user->is_confirmed ?? false) disabled="disabled" @endif
                                    >
                                    @error('name')
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="user-email">E-mail</label>
                                    <input
                                        id="user-email"
                                        type="text"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email', $user->email ?? '') }}"
                                        @if($user->is_confirmed ?? false) disabled="disabled" @endif
                                    >
                                    @error('email')
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                    Роли:
                                    <hr>
                                    <div class="row">
                                        @foreach($roles as $role)
                                            <div class="col-12 col-lg-3">
                                                <div class="form-check">
                                                    <input
                                                        id="{{ $role->name }}"
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value="{{ $role->id }}"
                                                        name="roles[]"
                                                        @if($errors->any())
                                                            @if(in_array($role->id, old('roles', [])))
                                                                checked="checked"
                                                            @endif
                                                        @else
                                                            @if(isset($user) && $user->hasRole($role))
                                                                checked="checked"
                                                            @endif
                                                        @endif
                                                    >
                                                    <label for="{{ $role->name }}">{{ $role->label }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                        @error('roles')
                                            <div class="text-danger col-12">{{ $errors->first('roles') }}</div>
                                        @enderror
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('users.index') }}" class="btn btn-primary mr-2">Отказ</a>
                                <button type="submit" class="btn btn-primary">
                                    @if(empty($user))
                                        Добави
                                    @else
                                        Редактирай
                                    @endif
                                </button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
