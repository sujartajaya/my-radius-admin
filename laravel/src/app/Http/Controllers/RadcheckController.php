<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radcheck;

class RadcheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $radcheck = Radcheck::create($request->all());
        
        if ($radcheck) {
            $res['error'] = false;
            $res['data'] = $radcheck;
            return response()->json($res);
        } else {
            $res['error'] = true;
            $res['data'] = "Some error!";
            return response()->json($res);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $radcheck = Radcheck::find($id);
        return response()->json($radcheck);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $radcheck = Radcheck::find($id);
        $radcheck->update($request->all());
        return response()->json($radcheck);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
