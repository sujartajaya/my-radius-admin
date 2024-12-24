<?php

namespace App\Http\Controllers;

use App\Models\Userhotspot;
use Illuminate\Http\Request;

class UserhotspotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userhotspots = Userhotspot::search($request->search)->paginate(10);
        
        //return json_encode($userhotspots);

        return view('hotspot.users',compact('userhotspots'));
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
        $datavalidate = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email:dns','unique:userhotspots'],
            'username' => ['required', 'unique:userhotspots'],
            'department' => ['required'],
            'password' => ['required'],
        ]);
        $userhotspot = Userhotspot::create($datavalidate);
        if ($userhotspot) {
            $res['error'] = false;
            $res['data'] = $userhotspot;
            $res['msg'] = "New user created";
            return json_encode($res);
        } else {
            $res['error'] = true;
            $res['data'] = $userhotspot;
            $res['msg'] = "Error add new user";
            return json_encode($res);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Userhotspot $userhotspot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Userhotspot $userhotspot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Userhotspot $userhotspot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Userhotspot $userhotspot)
    {
        //
    }
}
