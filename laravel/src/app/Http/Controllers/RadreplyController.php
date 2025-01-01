<?php

namespace App\Http\Controllers;

use App\Models\Radreply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RadreplyController extends Controller
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
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'user_profile' => ['required'],
        ]);

        $data = [];

        if($validator->fails()){
            $data['error'] = true;
            $data['msg'] = $validator->messages();
            return response()->json($data, 200);
        } else {
            $data['error'] = false;
            
            $radreply =[ 
                [
                    'username' => $request->username,
                    'attribute' => 'Mikrotik-Group',
                    'op' => ':=',
                    'value' => $request->user_profile
                ]
            ];
            if ($request->rate_limit) {
                array_push($radreply,[
                    'username' => $request->username,
                    'attribute' => 'Mikrotik-Rate-Limit',
                    'op' => ':=',
                    'value' => $request->rate_limit
                ]);
            }
            $savedata = Radreply::insert($radreply);

            $data['msg'] = $savedata;
            return response()->json($data, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Radreply $radreply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Radreply $radreply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Radreply $radreply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Radreply $radreply)
    {
        //
    }
}
