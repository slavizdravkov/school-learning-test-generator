@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-8">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Roles</h4>
                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_ADD_ROLES)
                            <a href="{{ route('roles.create') }}" class="btn btn-primary">Add</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Label</th>
                                <th class="text-center w-25">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->label }}</td>
                                    <td class="text-center">
                                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
                                            <a href="{{ route('roles.show', $role) }}">View</a>
                                        @endcan
                                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_EDIT_ROLES)
                                            | <a href="{{ route('roles.edit', $role) }}">Edit</a>
                                        @endcan
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
    {{ $roles->links() }}
@endsection
