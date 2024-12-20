<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
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
       $data = $request->all();
       $res = Member::create($data);
       return response()->json($res,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function memberValidator(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email:dns','unique:members'],
            'username' => ['required', 'unique:members'],
        ]);
        $data = [];
        if($validator->fails()){
            $data['error'] = true;
            $data['msg'] = $validator->messages();
            return response()->json($data, 200);
        } else {
            $data['error'] = false;
            $data['msg'] = $request->all();
            return response()->json($data, 200);
        }
    }

    public function getMembers()
    {
        $data = Member::paginate(10);
        return view('member.members');
    }
}
