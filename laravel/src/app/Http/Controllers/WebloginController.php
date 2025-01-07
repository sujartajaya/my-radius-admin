<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Radcheck;
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
       return view('weblogin.adduser');
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
    public function showUser(string $username)
    {
        $users = Radcheck::select('radcheck.id','radcheck.username','radusergroup.groupname','radgroupreply.attribute','radgroupreply.op','radgroupreply.value','radusergroup.priority')->leftJoin('radusergroup','radusergroup.username','radcheck.username')->leftJoin('radgroupreply','radgroupreply.groupname','radusergroup.groupname')->where('radcheck.username',$username)->where('radcheck.attribute','Cleartext-Password')->get();
        return json_encode($users);
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

    /** API for check login email */
    public function loginemail(Request $request) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $email = $request->email;
        $pesan = [];
        $waktu = new DateTime();
        $time_expire = "+".env('USER_PROFILE_EXPIRE')." minutes";
        $waktu1 = $waktu->modify($time_expire);
        $expiration = $waktu1->format('d M Y H:i:s');
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
                    $data = [
                        "username" => $email,
                        "attribute" => "Expiration",
                        "op" => ":=",
                        "value" => $expiration
                    ];
                    $addemail = DB::table('radcheck')->insert($data);

                    $usergroup = DB::table('radusergroup')->insert([
                        "username" => $email,
                        "groupname" => "GUEST",
                        "priority" => 10
                    ]);

                    if ($addemail) {
                        $pesan['error'] = false;
                        $pesan['data'] = "New email add!";
                        $pesan['email'] = $email;
                        return json_encode($pesan);
                    } else {
                        $pesan['error'] = true;
                        $pesan['data'] = 'Database error!';
                        $pesan['email'] = $email;
                        return json_encode($pesan);
                    }
                }  else {
                    if ($emaildb->count() > 1) {
                        $expire = $emaildb[1]->value;
                        /** check if date expire == today */
                        $today = new DateTime();

                        $check_expire = new DateTime($expire);    
                        $check_expire = $check_expire->format('Y-m-d');
                        $check_today = $today->format('Y-m-d');

                        $tgl = $today->format('d M Y H:i:s');
                        $tgl_expire = strtotime($expire);
                        $tgl_sekarang = strtotime($tgl);

                        if (($tgl_expire < $tgl_sekarang) && ($check_expire == $check_today)) {
                            $pesan['data'] = 'Your internet usage time has run out, please try again tomorrow!';
                            $pesan['error'] = true;
                            $pesan['email'] = $emaildb;
                            return json_encode($pesan);
                        }
                        if (($check_expire != $check_today) && ($tgl_expire < $tgl_sekarang)) {
                            /** reset expire */
                            $radcheck = DB::table('radcheck')->where('username',$email)->where('attribute','Expiration')->update(['value' => $expiration]);
                            
                            $pesan['data'] = 'Your email can still login!';
                            $pesan['error'] = false;
                        } else {
                            $pesan['data'] = 'Your email can still login!';
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
                $pesan['data'] = "Your email not valid!";
                $pesan['email'] = $email;
                return json_encode($pesan);
            }
        } else {
            $pesan['error'] = true;
            $pesan['data'] = "Your email not valid!";
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

    /** API for req chcek member */
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

    public function getAllUsers(Request $request)
    {
        //$users = DB::table('radcheck','')->where('attribute','Cleartext-Password')->orderBy('id','asc')->paginate(5);

        //$users =  DB::table('radcheck')->select('radcheck.id','radcheck.username','radusergroup.groupname','radgroupreply.attribute','radgroupreply.op','radgroupreply.value','radusergroup.priority')->leftJoin('radusergroup','radusergroup.username','radcheck.username')->leftJoin('radgroupreply','radgroupreply.groupname','radusergroup.groupname')->where('radcheck.attribute','Cleartext-Password')->paginate(5);
        
       $users = Radcheck::search($request->search)->select('radcheck.id','radcheck.username','radusergroup.groupname','radgroupreply.attribute','radgroupreply.op','radgroupreply.value','radusergroup.priority')->leftJoin('radusergroup','radusergroup.username','radcheck.username')->leftJoin('radgroupreply','radgroupreply.groupname','radusergroup.groupname')->where('radcheck.attribute','Cleartext-Password')->paginate(2);

        //return json_encode($users);

        //$users = Radcheck::search($request->search)->where('attribute','Cleartext-Password')->paginate(5);


        //return json_encode($users);

        return view('weblogin.users',compact('users'));
    }

    public function viewModal()
    {
        return view('weblogin.modal');
    }

}
