<?php

namespace App\Http\Controllers;

use App\Models\Mikrotik;
use App\Models\Radgroupreply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;

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

    public function edit_mac_binding($id)
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $getmac = $API->comm('/ip/hotspot/ip-binding/print', [
				"?.id" => $id,
			]);
            $data['error'] = false;
            $data['mac'] = $getmac;
            return response()->json($data,200);
        } else {
            $data['error'] = true;
            $data['msg'] = "Error connection to the gateway!";
            return response()->json($data,200);
        }
    }

    public function update_mac_binding(Request $request, $id)
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;

        if ($this->isValidMacAddress($request->mac)) {
            $validator = Validator::make($request->all(), [
                    'mac' => ['required'],
                    'type' => ['required'],
                    'comment' => ['required'],
                    'disabled' => ['required'],
            ]);
            if($validator->fails()){
                $data['error'] = true;
                $data['msg'] = $validator->messages();
                return response()->json($data, 200);
            }
            if ($API->connect($ip, $user, $password)) {
                $API->comm("/ip/hotspot/ip-binding/set",[
                    '.id' => $id,
                    'mac-address' => $request->mac,
                    'type' => $request->type,
                    'comment' => $request->comment,
                    'disabled' => $request->disabled
                ]);
                $data['error'] = false;
                $data['msg'] = "Mac Address updated!";
                return response()->json($data,200);
            }
        } else {
            $data['error'] = true;
            $data['msg'] = "Mac Address invalid! ".$request->mac;
            return response()->json($data,200);
        }
    }

    public function delete_mac_binding(Request $request)
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm("/ip/hotspot/ip-binding/remove",[
                '.id' => $request->id 
            ],);
            $data['error'] = false;
            $data['msg'] = "Mac Address has been deleted!";
            return response()->json($data,200);
        } else {
            $data['error'] = true;
            $data['msg'] = "Error connected to gateway!";
            return response()->json($data,200);
        }
    }

    function changeEnvValue($key, $newValue)
    {
        $envFile =base_path('/.env'); // Path to the .env file
        $updated = false;

        if (!file_exists($envFile)) {
            throw new Exception('.env file does not exist.');
        }

        // Read file into an array
        $lines = file($envFile);

        foreach ($lines as $index => $line) {
            // Skip comments or empty lines
            if (strpos(trim($line), '#') === 0 || trim($line) === '') {
                continue;
            }

            // Match the key
            if (strpos($line, $key . '=') === 0) {
                $lines[$index] = $key . '=' . $newValue . PHP_EOL; // Update the line
                $updated = true;
                break;
            }
        }

        // If the key was not found, append it
        if (!$updated) {
            $lines[] = $key . '=' . $newValue . PHP_EOL;
        }

        // Write the updated content back to the file
        file_put_contents($envFile, implode('', $lines));
    }

    public function set_login_email_profile(Request $request, $id) 
    {
        $expire = $request->expire;
        if (!$expire) $expire = 60;
        $rate_limit = $request->rate_limit;
        if (!$rate_limit) $rate_limit = "1M/1M 2M/2M 1M/1M 40/40";
        try {
            $this->changeEnvValue('USER_PROFILE_EXPIRE',$expire);
            $radgroupreply = DB::table('radgroupreply')->where('id',$id)->update(['value' => $rate_limit]);
            $data['error'] = false;
            $data['msg'] = "Update variable success";
            return response()->json($data,200);
        }catch (Exception $e) {
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            return response()->json($data,200);
        }
    }
    
    public function form_login_email_profile()
    {
        $expire = env('USER_PROFILE_EXPIRE');
        $radgroupreply = Radgroupreply::where('groupname','GUEST')->where('attribute','Mikrotik-Rate-Limit')->first();   
        return view('hotspot.guestprofile',compact('expire','radgroupreply'));
    }

    public function login_email_active()
    {
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {

			$active_user = $API->comm('/ip/hotspot/active/print');
            if (count($active_user) > 0) { 
                $data = [
                    'error' => false,
                    'title' => 'Hotspot Active User',
                    'active_user' => $active_user,
                ];
            } else {
                $data = [
                    'error' => true,
                    'title' => 'Hotspot Active User',
                    'msg' => "Empty data",
                ];
            }
            return view('hotspot.guestactive',compact('data'));
            // return response()->json($data,200);

		} else {
            $data = [
                'error' => true,
                'title' => 'Hotspot Active User',
                'msg' => 'Error while fetch of data!',
            ];
            return view('hotspot.guestactive',compact('data'));
            // return response()->json($data,200);
		}
    }

}
