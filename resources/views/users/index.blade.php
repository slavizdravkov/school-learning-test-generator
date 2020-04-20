@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-10">
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
                        <h4 class="mb-0">Потребители</h4>
                        @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_ADD_USERS)
                            <a href="{{ route('users.create') }}" class="btn btn-primary">Добави</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Име</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Добавен от</th>
                                <th class="text-center">Дата на добавяне</th>
                                <th class="text-center">Статус</th>
                                <th class="text-center w-25">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->created_from }}</td>
                                    <td class="text-center">{{ $user->created_at->format('d.m.Y') }}</td>
                                    <td class="text-center @if($user->is_blocked) text-danger @else text-success @endif">{{ $user->status }}</td>
                                    <td class="text-center">
                                        @if($user->hasRole(\App\Library\Helpers\Constants\RolesNames::ROLE_NAME_ADMIN))
                                            @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_EDIT_ADMIN_USERS)
                                                <a href="{{ route('users.edit', $user) }}">Редактирай</a>
                                            @endcan
                                            @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_ADMIN_USERS_CHANGE_STATUS)
                                                | <a href="{{ route('users.changeStatus', $user) }}">
                                                    @if($user->is_blocked)
                                                        Активирай
                                                    @else
                                                        Блокирай
                                                    @endif
                                                </a>
                                            @endcan
                                        @else
                                            @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_EDIT_USERS)
                                                <a href="{{ route('users.edit', $user) }}">Редактирай</a>
                                            @endcan
                                            @can(\App\Library\Helpers\Constants\CapabilitiesNames::CAPABILITY_NAME_CHANGE_USERS_STATUSES)
                                                | <a href="{{ route('users.changeStatus', $user) }}">
                                                    @if($user->is_blocked)
                                                        Активирай
                                                    @else
                                                        Блокирай
                                                    @endif
                                                </a>
                                            @endcan
                                        @endif
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
    {{ $users->links() }}
@endsection
