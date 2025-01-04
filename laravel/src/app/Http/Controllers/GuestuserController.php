<?php

namespace App\Http\Controllers;

use App\Models\Guestuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mikrotik;

class GuestuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        $guestusers = Guestuser::search($request->search)->paginate(8);

        return view('hotspot.guests',compact('guestusers','data'));

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
            'email' => ['required', 'email:rfc,dns','unique:guestusers'],
            'username' => ['required', 'unique:guestusers'],
            'password' => ['required'],
        ]);
         $data = [];
        
        if($validator->fails()){
            $data['error'] = true;
            $data['msg'] = $validator->messages();
            return response()->json($data, 200);
        } else {
            $data['error'] = false;
            $datasave = Guestuser::create($request->all());
            $data['msg'] = $request->all();
            return response()->json($data, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guestuser $guestuser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guestuser $guestuser,$id)
    {
        $users = $guestuser->find($id);
        return response()->json($users,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guestuser $guestuser, $id)
    {
        $user = $guestuser->find($id);

        $validator = [];
        $msgvalidator = [];
        $data = [];
        if ($user->email != $request->email) {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email:rfc,dns','unique:guestusers']
            ]);
            if ($validator->fails()) {
                $msgvalidator['email'] = $validator->messages(); 
            }
        }
        if ($user->username != $request->username) {
            $validator = Validator::make($request->all(), [
                'username' => ['required','unique:guestusers']
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
    public function destroy(Guestuser $guestuser)
    {
        //
    }
}
