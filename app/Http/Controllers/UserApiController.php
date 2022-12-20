<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserApiController extends Controller
{
    public function showUser($id=null)
    {
        if($id == '')
        {
            $users = User::get();
            return response()->json(['users' => $users], 200);
       }else{
        $users = User::find($id);
        return response()->json(['users' => $users], 200);
       }
    }
}
