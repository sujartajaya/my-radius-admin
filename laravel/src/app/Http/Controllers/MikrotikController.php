<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use Illuminate\Http\Request;

class MikrotikController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mikrotik $mikrotik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mikrotik $mikrotik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mikrotik $mikrotik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mikrotik $mikrotik)
    {
        //
    }

    public function system()
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;
        $data = [];
        if ($API->connect($ip, $user, $password)) {

			$system = $API->comm('/system/resource/print');

            $data = [
                'error' => false,
                'title' => 'System Resource',
                'system' => $system,
            ];
            return view('admin.dashboardv1',compact('data'));
            //dd($data);
            //return response()->json($data);

		} else {
            $data = [
                'error' => true,
                'title' => 'System Resource',
                'msg' => 'Error connect to mikrotik',
            ];
            return view('admin.dashboardv1',compact('data'));
            //return respone()->json("Gagal Konek");
		}
    }

    public function hotspot_user_profile()
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

			$userprofile = $API->comm('/ip/hotspot/user/profile/print');

            $data = [
                'titla' => 'Hotspot User Profile',
                'userprofile' => $userprofile,
            ];

            return response()->json($data);

		} else {
            return respone()->json("Gagal Konek");
		}
    }


}
