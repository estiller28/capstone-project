<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::latest()->get();
        return view('admin.settings.roles', compact('roles'));
    }

    public function create(){

    }

    public function store(Request $request)
    {
       $validated = $request->validate([
           'name' => 'required',
       ]);

       Role::create($validated);

       return back();

    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *

     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.

     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *

     */
    public function destroy($id)
    {
    }
}
