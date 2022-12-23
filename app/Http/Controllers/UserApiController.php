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

   // post api for multple user
   public function addMultiUser(Request $request)
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
               foreach($data['users'] as $userData){
                    $user = new User();
                    $user->name = $userData['name'];
                    $user->email = $userData['email'];
                    $user->password = bcrypt( $userData['password']);
                    $user->save();
                    $message = 'Users insert successfully by UserAPI';
               }
               return response()->json(['message' => $message], 201);
        }
    }
    // put api for multple update
    public function updateUser(Request $request, $id)
    {
        if($request->ismethod('put')){
            $data = $request->all();
           // return $data;
           $rules = [
                   'name' => 'required',

                   'password' => 'required'
            ];
            $customMessage = [
                 'name.required' => 'Name is required',

                 'password.required' => 'Password is required',
            ];

            // $validator = Validator::make($data, $rules, $customMessage);
            //  if($validator->fails()){
            //      return response()->json($validator->errors(), 422);
            //  }
           $user = User::find($id);
           $user->name = $data['name'];
           $user->password = bcrypt( $data['password']);
           $user->save();
           $message = 'User update successfully by UserAPI';
           return response()->json(['message' => $message], 202);
        }
    }

    // patch api for single record update
    public function updateUserSingle(Request $request, $id)
    {
        if($request->ismethod('patch')){
            $data = $request->all();
           // return $data;
           $rules = [
                   'name' => 'required',

            ];
            $customMessage = [
                 'name.required' => 'Name is required',
            ];

            // $validator = Validator::make($data, $rules, $customMessage);
            //  if($validator->fails()){
            //      return response()->json($validator->errors(), 422);
            //  }
           $user = User::find($id);
           $user->name = $data['name'];
           $user->save();
           $message = 'User single information update successfully by UserAPI';
           return response()->json(['message' => $message], 202);
        }
    }

    // delete api for single record delete

    public function deleteSignleRecord($id = null)
    {
        User::findOrFail($id)->delete();
        $message = 'User single records delete successfully by UserAPI';
        return response()->json(['message' => $message], 200);
    }
    // delete api for single record delete json formet
    public function deleteSignleRecordJson(Request $request)
    {
        if($request->isMethod('delete')){
            $data = $request->all();
            User::where('id', $data['id'])->delete();
            $message = 'User single records delete successfully with JSON formet by UserAPI';
            return response()->json(['message' => $message], 200);
        }
    }

}
