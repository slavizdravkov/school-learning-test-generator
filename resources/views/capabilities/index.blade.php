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
                        <h4 class="mb-0">Capabilities</h4>
                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_ADD_CAPABILITIES)
                            <a href="{{ route('capabilities.create') }}" class="btn btn-primary">Add</a>
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
                            @foreach($capabilities as $capability)
                                <tr>
                                    <td>{{ $capability->name }}</td>
                                    <td>{{ $capability->label }}</td>
                                    <td class="text-center">
                                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_EDIT_CAPABILITIES)
                                            <a href="{{ route('capabilities.edit', $capability) }}">Edit</a>
                                        @endcan

                                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_DELETE_CAPABILITIES)
                                            | <a href="{{ route('capabilities.delete', $capability) }}">Delete</a>
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
    {{ $capabilities->links() }}
@endsection
