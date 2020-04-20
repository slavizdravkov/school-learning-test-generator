@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if(empty($role))
                            <h4 class="mb-0">Add</h4>
                        @else
                            <h4 class="mb-0">Edit</h4>
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ empty($role) ? route('roles.store') : route('roles.update', $role) }}" method="post">
                            @isset($role)@method('PUT')@endisset
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="role-name">Name</label>
                                    <input
                                        id="role-name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name', $role->name ?? '') }}"
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="role-label">Label</label>
                                    <input
                                        id="role-label"
                                        type="text"
                                        class="form-control @error('label') is-invalid @enderror"
                                        name="label"
                                        value="{{ old('label', $role->label ?? '') }}"
                                    >
                                    @error('label')
                                        <div class="invalid-feedback">{{ $errors->first('label') }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                    Capabilities:
                                    <hr>
                                    <div class="row">
                                        @foreach($capabilities as $capability)
                                            <div class="col-12 col-lg-3">
                                                <div class="form-check">
                                                    <input
                                                        id="{{ $capability->name }}"
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value="{{ $capability->id }}"
                                                        name="capabilities[]"
                                                        @if($errors->any())
                                                            @if(in_array($capability->id, old('capabilities', [])))
                                                                checked="checked"
                                                            @endif
                                                        @else
                                                            @if(isset($role) && $role->hasCapability($capability))
                                                                checked="checked"
                                                            @endif
                                                        @endif
                                                    >
                                                    <label for="{{ $capability->name }}">{{ $capability->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                        @error('capabilities')
                                            <div class="text-danger col-12">{{ $errors->first('capabilities') }}</div>
                                        @enderror
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('roles.index') }}" class="btn btn-primary mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    @if(empty($role))
                                        Add
                                    @else
                                        Edit
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
