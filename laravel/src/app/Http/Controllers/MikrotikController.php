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
            //dd($data);
            return view('admin.dashboardv2',compact('data'));
            //dd($data);
            //return response()->json($data);

		} else {
            $data = [
                'error' => true,
                'title' => 'System Resource',
                'msg' => 'Error connect to mikrotik',
            ];
            
            return view('admin.dashboardv2',compact('data'));
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

    public function show_mac_binding($code)
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {

			$mac = $API->comm('/ip/hotspot/ip-binding/print');

            $data = [
                'error' => false,
                'title' => 'Hotspot Mac Address Bindings',
                'mac' => $mac,
            ];
            if ($code == "blade") {
                return view('hotspot.mac',compact('data'));
            } else {
                return response()->json($data,200);
            }

		} else {
            $data = [
                'error' => true,
                'title' => 'Hotspot Mac Address Bindings',
                'msg' => 'Error while fetch of data!',
            ];
            if ($code == "blade") {
                return view('hotspot.mac',compact('data'));
            } else {
                return response()->json($data,200);
            }
		}
    }

    function isValidMacAddress($macAddress) {
        // Pola regex untuk MAC address yang valid
        $pattern = '/^([0-9A-Fa-f]{2}[:]){5}([0-9A-Fa-f]{2})$/';

        // Validasi menggunakan preg_match
        if (preg_match($pattern, $macAddress)) {
            return true;
        } else {
            return false;
        }
    }


    public function add_mac_binding(Request $request)
    {
        $data_mac = $request->mac;
        if ($this->isValidMacAddress($data_mac)) {
            
            $ip = env('MIKROTIK_IP');
            $user = env('MIKROTIK_USER');
            $password = env('MIKROTIK_PASSWORD');
            $API = new Mikrotik();
            $API->debug = false;

            if ($API->connect($ip, $user, $password)) {
                $API->comm('/ip/hotspot/ip-binding/add',[
                    'mac-address'=> $request->mac,
                    'type' => $request->type,
                    'comment' => $request->comment,
                ]);
                $data['error'] = false;
                $data['msg'] = "Mac Address has been added";
                return response()->json($data,201);
            } else {
                $data['error'] = true;
                $data['msg'] = "Error connect to gateway!";
                return response()->json($data,200);
            }
        } else {
            $data['error'] = true;
            $data['msg'] = "Mac Address invalid!";
            return response()->json($data,200);
        }
    }
}
