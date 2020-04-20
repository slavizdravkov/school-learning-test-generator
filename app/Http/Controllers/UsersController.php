<?php

namespace App\Http\Controllers;

use App\Library\Helpers\Constants\CapabilitiesNames;
use App\Library\Helpers\Constants\RolesNames;
use App\Role;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Auth::user()->hasPermission(CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
            ? Role::all()
            : Auth::user()->roles;

        return view('users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Auth::user()->hasPermission(CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
            ? $this->validateParams($request)
            : $this->validateParams($request, Auth::user()->roles);

        $user = User::make($request->all(['name', 'email']));
        $user->created_from = Auth::user()->name;
        $user->password = Hash::make(Str::random(8));
        $user->save();
        $user->assignRole($request->request->get('roles'));

        event(new Registered($user));

        return redirect()->route('users.index')->with('success', 'Потребителят беше добавен успешно.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        if ($user->hasRole(RolesNames::ROLE_NAME_ADMIN)) {
            $this->authorize(CapabilitiesNames::CAPABILITY_NAME_EDIT_ADMIN_USERS);
        }

        $roles = Auth::user()->hasPermission(CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
            ? Role::all()
            : Auth::user()->roles;

        return view('users.create', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $isVerifiedUser = null !== $user->email_verified_at;

        Auth::user()->hasPermission(CapabilitiesNames::CAPABILITY_NAME_VIEW_ROLES)
            ? $this->validateParams($request, null, $isVerifiedUser)
            : $this->validateParams($request, Auth::user()->roles, $isVerifiedUser);

        if (!$isVerifiedUser) {
            $user->update($request->all(['name', 'email']));
            $request->get('email') === $user->email ?: event(new Registered($user));
        }
        $user->assignRole($request->request->get('roles'));

        return redirect()->route('users.index')->with('success', 'Потребителят беше редактиран успешно.');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(User $user)
    {
        if ($user->hasRole(RolesNames::ROLE_NAME_ADMIN)) {
            $this->authorize(CapabilitiesNames::CAPABILITY_NAME_ADMIN_USERS_CHANGE_STATUS);
        }

        $user->toggleStatus()->save();

        return back()->with('success', 'Старуса е променен успешно');
    }

    protected function validateParams(Request $request, Collection $roles = null, $isVerifiedUser = false)
    {
        $validations = [];

        if (null !== $roles) {
            $rolesIds = implode(',', $roles->pluck('id')->toArray());
            $validations['roles'] = 'required|in:' . $rolesIds;
        } else {
            $validations['roles'] = 'required|exists:roles,id';
        }

        if (!$isVerifiedUser) {
            $validations['name'] = 'required|max:255';
            $validations['email'] = 'required|email';
        }

        return $request->validate($validations);
    }
}
