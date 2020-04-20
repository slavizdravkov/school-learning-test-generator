@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Role: {{ $role->label }}</h4>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-primary mr-2">Back</a>
                            @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_EDIT_ROLES)
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">Edit</a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="mb-2">Capabilities:</h4>
                        <div class="row px-3">
                            @foreach($role->capabilities as $capability)
                                <div class="col-12 col-lg-3 mb-1">
                                    <i class="fas fa-check"></i> {{ $capability->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
