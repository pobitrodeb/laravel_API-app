<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Dotenv\Validator;
use make;

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

    public function addUser(Request $request)
    {
        if($request->ismethod('post')){
            $data = $request->all();
           // return $data;
           $rules = [
                   'name' => 'required',
                   'email' => 'required|email|unique:users',
                   'password' => 'required'
            ];
            $customMessage = [
                 'name.required' => 'Name is required',
                 'email.required' => 'Email is required',
                 'password.required' => 'Password is required',
            ];

            // $validator = Validator::make($data, $rules, $customMessage);
            //  if($validator->fails()){
            //      return response()->json($validator->errors(), 422);
            //  }
           $user = new User();
           $user->name = $data['name'];
           $user->email = $data['email'];
           $user->password = bcrypt( $data['password']);
           $user->save();
           $message = 'User insert successfully by UserAPI';
           return response()->json(['message' => $message], 201);
        }
    }
}
