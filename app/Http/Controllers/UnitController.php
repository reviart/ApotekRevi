<?php

namespace App\Http\Controllers;

use Auth;
use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('units.index', ['units' => Unit::orderBy('name', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->generate_unit($request, 0);
        return redirect()->route('units.index')->with('success', 'Unit added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('units.show', ['unit' => Unit::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('units.edit', ['unit' => Unit::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->generate_unit($request, $id);
        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }

    function generate_unit($request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191'
        ]);

        $id==0 ? $unit = new Unit : $unit = Unit::findOrFail($id);
        
        $unit->name = strtoupper($request->name);
        $unit->user_id = Auth::id();
        $unit->save();
    }
}
