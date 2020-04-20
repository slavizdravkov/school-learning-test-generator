<?php

namespace App\Http\Controllers;

use App\Capability;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('roles.index', ['roles' => Role::paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('roles.create', ['capabilities' => Capability::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        $role = Role::create($request->all(['name', 'label']));
        $role->allowTo($request->request->get('capabilities'), false);

        return redirect()->route('roles.index')->with('success', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Role $role)
    {
        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        return view('roles.create', [
            'capabilities' => Capability::all(),
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $this->validateRequest($request);

        $role->update($request->all(['name', 'label']));
        $role->allowTo($request->request->get('capabilities'));

        return redirect()->route('roles.index')->with('success', 'Success');
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|max:255',
            'label' => 'required|max:255',
            'capabilities' => 'required|exists:capabilities,id'
        ]);
    }
}
