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
        $ip = '172.16.0.12';
        $user = 'putu';
        $password = 'v3l088';
        $API = new Mikrotik();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

			$hotspotactive = $API->comm('/ip/hotspot/active/print');

            $data = [
                'menu' => 'Hotspot',
                'totalhotspotactive' => count($hotspotactive),
                'hotspotactive' => $hotspotactive,
            ];

            return response()->json($data);

		} else {
            return respone()->json("Gagal Konek");
		}
    }

    public function hotspot_user_profile()
    {
        $ip = '172.16.0.12';
        $user = 'putu';
        $password = 'v3l088';
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
