@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Редактиране на профила на {{ $user->name }}</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('users.updateProfile') }}" method="post">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="user-name">Име и фамилия</label>
                                    <input
                                        id="user-name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name', $user->name ?? '') }}"
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                    <label for="user-email">E-mail</label>
                                    <input
                                        id="user-email"
                                        type="text"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email', $user->email ?? '') }}"
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                    <label for="password">Парола</label>
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                    >
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                    <label for="password-confirm">Потвърди паролата</label>
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                    >
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('users.index') }}" class="btn btn-primary mr-2">Отказ</a>
                                <button type="submit" class="btn btn-primary">
                                    Редактирай
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
