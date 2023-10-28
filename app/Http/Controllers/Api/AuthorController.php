<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //register method post
    public function register(Request $request)
    {
        $request->validate([
            "name"=> "required",
            "email"=> "required|email",
            "password"=> "required|confirmed",
            "phone_no"=>"required"]);

        $author = new Author();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = bcrypt($request->password);
        $author->phone_no = $request->phone_no;
        $author->created_at = now();
        $author->updated_at = now();
        $author->save();

        return response()->json(["message" => "Author created successfully"], 201);
            

    }



    //login method
    public function login(Request $request)
    {

       $login_data = $request->validate([
            "email"=> "required|email",
            "password"=> "required"
        ]);

        if(!auth()->attempt($login_data)){
          return response()->json(["message"=> "invalid"],404);
        }

        $token = auth()->user()->createToken("auth_token");

        return response()->json(["message"=> "login successfully","token"=> $token],200);
    }

    //profile method
    public function profile()
    {

        $user = auth()->user();
        return response()->json(["message"=> "user profile","user"=> $user] ,200);
    }

    //logout method 
    public function logout(Request $request)
    {
        $token = auth()->user()->token();

        $token->revoke();

        return response()->json(["message"=> "loggedout"],200);

    }

}
