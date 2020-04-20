<?php

namespace App\Http\Controllers;


use App\Capability;
use Illuminate\Http\Request;

class CapabilitiesController extends Controller
{
    public function index()
    {
        return view('capabilities.index', ['capabilities' => Capability::paginate(20)]);
    }

    public function show(Capability $capability)
    {
        return view('capabilities.show', ['capability' => $capability]);
    }

    public function create()
    {
        return view('capabilities.create');
    }

    public function store(Request $request)
    {
        Capability::create($this->validateRequest($request));

        return redirect()->route('capabilities.index')->with('success', 'Success');
    }

    public function edit(Capability $capability)
    {
        return view('capabilities.create', ['capability' => $capability]);
    }

    public function update(Capability $capability, Request $request)
    {
        $capability->update($this->validateRequest($request));

        return redirect()->route('capabilities.index')->with('success', 'Success');
    }

    public function delete(Capability $capability)
    {
        $capability->delete();

        return back()->with('success', 'Success');
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'name' => 'required|max:255',
            'label' => 'required|max:255',
        ]);
    }
}
