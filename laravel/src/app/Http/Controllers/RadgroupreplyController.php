<?php

namespace App\Http\Controllers;

use App\Models\Radgroupreply;
use Illuminate\Http\Request;

class RadgroupreplyController extends Controller
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
        $radgroupreply = Radgroupreply::create($request->all());
        if ($radgroupreply) {
            $res['error'] = false;
            $rss['data'] = $radgroupreply;
            return response()->json($res,200);
        } else {
            $res['error'] = true;
            $rss['data'] = "Error database!";
            return response()->json($res,200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Radgroupreply $radgroupreply, Request $request)
    {
        $data = $radgroupreply->select('groupname')->search($request->search)->groupby('groupname')->paginate(5);

        return view('hotspot.radgroupreply',compact('data'));

        // if ($data) {
        //     $res['error'] = false;
        //     $res['data'] = $data;
        //     return response()->json($res,200);
        // } else {
        //     $res['error'] = true;
        //     $res['data'] = "Some error!";
        //     return response()->json($res,200);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Radgroupreply $radgroupreply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Radgroupreply $radgroupreply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Radgroupreply $radgroupreply)
    {
        //
    }
}
