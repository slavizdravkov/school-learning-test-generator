@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if(empty($capability))
                            <h4 class="mb-0">Add</h4>
                        @else
                            <h4 class="mb-0">Edit</h4>
                        @endif
                    </div>

                    <div class="card-body">
                        <form action="{{ empty($capability) ? route('capabilities.store') : route('capabilities.update', $capability) }}" method="post">
                            @isset($capability)@method('PUT')@endisset
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="capability-name">Name</label>
                                    <input
                                        id="capability-name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name', $capability->name ?? '') }}"
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="capability-label">Label</label>
                                    <input
                                        id="capability-label"
                                        type="text"
                                        class="form-control @error('label') is-invalid @enderror"
                                        name="label"
                                        value="{{ old('label', $capability->label ?? '') }}"
                                    >
                                    @error('label')
                                        <div class="invalid-feedback">{{ $errors->first('label') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('capabilities.index') }}" class="btn btn-primary mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    @if(empty($capability))
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
