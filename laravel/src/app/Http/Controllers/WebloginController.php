<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebloginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('weblogin.login');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function reqlogin(Request $request) {
        $data = $request->all();
        //dd(($data));
        return view('weblogin.login',compact('data'));
    }

    public function loginemail(Request $request) {
        $dataemail = $request->validate([
            'email' => ['required','email:dns']
        ]);
        $radcheckuser = DB::table('radcheck')->where('username',$dataemail)->where('attribute','Cleartext-Password')->first();
        return json_encode($radcheckuser);
    }
}
