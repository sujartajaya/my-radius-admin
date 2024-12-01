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
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $email = $request->email;
        $pesan = [];
        /** cek format email */
        if (preg_match($pattern, $email)) {
            /** cek domain email */
            $emailArray = explode("@", $email);
            if (checkdnsrr(array_pop($emailArray), "MX")) {
                $emaildb = DB::table('radcheck')->where('username',$email)->first();
                if (!($emaildb)) {
                    $data = [
                        "username" => $email,
                        "attribute" => "Cleartext-Password",
                        "op" => ":=",
                        "value" => $email
                    ];
                    $addemail = DB::table('radcheck')->insert($data);
                    $usergroup = DB::table('radusergroup')->insert([
                        "username" => $email,
                        "groupname" => "limit1M",
                        "priority" => 10
                    ]);
                    if ($addemail) {
                        $pesan['error'] = false;
                        $pesan['data'] = $addemail;
                        $pesan['email'] = $email;
                    } else {
                        $pesan['error'] = true;
                        $pesan['data'] = 'Ada kesalahan pada database';
                        $pesan['email'] = $email;
                    }
                }  else {
                    $pesan['error'] = false;
                    $pesan['data'] = "Email sudah ada bisa langsung konek";
                }
            } else {
                $pesan['error'] = true;
                $pesan['data'] = "Email tidak valid";
                $pesan['email'] = $email;
            }
        } else {
            $pesan['error'] = true;
            $pesan['data'] = "Email tidak valid";
            $pesan['email'] = $email;
        }

        // $dataemail = $request->validate([
        //     'email' => ['required','email:dns']
        // ]);
        //$radcheckuser = DB::table('radcheck')->where('username',$dataemail)->where('attribute','Cleartext-Password')->first();
        //$radcheckuser = DB::table('radcheck')->get();

        return json_encode($pesan);
    }

    public function testlogin() {
        return view('weblogin.loginv1');
    }
}
