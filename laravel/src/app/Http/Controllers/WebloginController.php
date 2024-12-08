<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use DateTime;

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
        //return view('weblogin.login',compact('data'));
        return view('weblogin.emailv1',compact('data'));
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
                $emaildb = DB::table('radcheck')->where('username',$email)->orderBy('id','asc')->get();
                if (($emaildb->count() == 0)) {
                    $data = [
                        "username" => $email,
                        "attribute" => "Cleartext-Password",
                        "op" => ":=",
                        "value" => $email
                    ];
                    $addemail = DB::table('radcheck')->insert($data);
                   
                    $waktu = new DateTime();
                    $waktu1 = $waktu->modify("+30 minutes");
                    $expiration = $waktu1->format('d M Y H:i:s');

                    $data = [
                        "username" => $email,
                        "attribute" => "Expiration",
                        "op" => ":=",
                        "value" => $expiration
                    ];
                    $addemail = DB::table('radcheck')->insert($data);

                    $usergroup = DB::table('radusergroup')->insert([
                        "username" => $email,
                        "groupname" => "limit1M",
                        "priority" => 10
                    ]);

                    if ($addemail) {
                        $pesan['error'] = false;
                        $pesan['data'] = "Email sudah ditambahkan bisa langsung konek";
                        $pesan['email'] = $email;
                        return json_encode($pesan);
                    } else {
                        $pesan['error'] = true;
                        $pesan['data'] = 'Ada kesalahan pada database';
                        $pesan['email'] = $email;
                        return json_encode($pesan);
                    }
                }  else {
                    if ($emaildb->count() > 1) {
                        $expire = $emaildb[1]->value;
                        $today = new DateTime();
                        $tgl = $today->format('d M Y H:i:s');
                        $tgl_expire = strtotime($expire);
                        $tgl_sekarang = strtotime($tgl);

                        if ($tgl_expire < $tgl_sekarang) {
                            $pesan['data'] = 'Email login anda telah expired!';
                            $pesan['error'] = true;
                        } else {
                            $pesan['data'] = 'Email login anda masih berlaku!';
                            $pesan['error'] = false;
                        }
                        $pesan['email'] = $emaildb;

                        return json_encode($pesan);
                    } else {
                        $pesan['data'] = 'Email khusus member!';
                        $pesan['error'] = false;
                        $pesan['email'] = $emaildb;
                        return json_encode($pesan);
                    }
                }
            } else {
                $pesan['error'] = true;
                $pesan['data'] = "Your email not valid";
                $pesan['email'] = $email;
                return json_encode($pesan);
            }
        } else {
            $pesan['error'] = true;
            $pesan['data'] = "Your email not valid";
            $pesan['email'] = $email;
            return json_encode($pesan);
        }
    }

    public function testlogin() {
        return view('weblogin.loginv1');
    }

    public function testloginmail() 
    {
        return view('weblogin.email');
    }

    public function checkMember(Request $request)
    {
        $data =  $request->all();
        $member = Member::where('email',$request->email)->first();
        $res = [];

        if ($member) {
            $res['error'] = false;
            $res['data'] = $member;
            return json_encode($res);
        } else {
            $datamem = Member::create($data);

            if ($datamem)
            {
                $res['error'] = false;
                $res['data'] = $datamem;
                return json_encode($res);
            } else {
                $res['error'] = true;
                $res['data'] = "Ada error saat simpasan data member";
                return json_encode($res);
            }
        }
    }

    
}
