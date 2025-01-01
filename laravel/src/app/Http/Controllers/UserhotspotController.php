<?php

namespace App\Http\Controllers;

use App\Models\Userhotspot;
use App\Models\Mikrotik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserhotspotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userhotspots = Userhotspot::search($request->search)->paginate(8);
        $ip = env('MIKROTIK_IP');
        $user = env('MIKROTIK_USER');
        $password = env('MIKROTIK_PASSWORD');
        $API = new Mikrotik();
        $API->debug = false;
        $data=[];

        if ($API->connect($ip, $user, $password)) {
			$userprofile = $API->comm('/ip/hotspot/user/profile/print');
            $data = [
                'error' => false,
                'title' => 'Hotspot User Profile',
                'userprofile' => $userprofile,
            ];
		} else {
            $data = [
                'error' => true,
                'title' => 'Hotspot User Profile',
                'msg' => "Error when connect to mikrotik.",
            ];
		}

        return view('hotspot.users',compact('userhotspots','data'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email:rfc,dns','unique:userhotspots'],
            'username' => ['required', 'unique:userhotspots'],
            'department' => ['required'],
            'password' => ['required'],
        ]);

        $data = [];
        
        if($validator->fails()){
            $data['error'] = true;
            $data['msg'] = $validator->messages();
            return response()->json($data, 200);
        } else {
            $data['error'] = false;
            $datasave = Userhotspot::create($request->all());
            $data['msg'] = $request->all();
            return response()->json($data, 200);
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
    public function edit(Userhotspot $userhotspot, $id)
    {
        $user = $userhotspot->find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Userhotspot $userhotspot, $id)
    {
        $user = $userhotspot->find($id);

       //return response()->json($request->username);

        $validator = [];
        $msgvalidator = [];
        $data = [];
        if ($user->email != $request->email) {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email:rfc,dns','unique:userhotspots']
            ]);
            if ($validator->fails()) {
                $msgvalidator['email'] = $validator->messages(); 
            }
        }
        if ($user->username != $request->username) {
            $validator = Validator::make($request->all(), [
                'username' => ['required','unique:userhotspots']
            ]);
            if ($validator->fails()) {
                $msgvalidator['username'] = $validator->messages(); 
            }
        }

        if ($validator) {
            if($validator->fails()){
            $data['error'] = true;
            $data['msg'] = $msgvalidator;
            return response()->json($data, 200);
            } else {
                $data['error'] = false;
                $user->update($request->all());
                $data['msg'] = $user;
                return response()->json($data, 200);
            }
        }
        $data['error'] = false;
        $user->update($request->all());
        $data['msg'] = $user;
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Userhotspot $userhotspot)
    {
        //
    }

    public function userprofile(Userhotspot $userhotspot, $id)
    {
        $user = Userhotspot::find($id);
        $update = $user->update($request->all());
        if ($update) {
            $data['error'] = false;
            $data['msg'] = 'User Profile Updated';
            return respose()->json($data,200);
        } else {
            $data['error'] = true;
            $data['msg'] = 'Some error when updated';
            return respose()->json($data,200);
        }
    }
}
