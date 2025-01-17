<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return response()->json(User::all());
    }

    public function show($id){
        return response()->json(User::find($id));
    }

    public function store(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->balance = $request->balance;
        $user->role = $request->role;        
        $user->save();
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->balance = $request->balance;

        $user->save();
    }

    public function destroy($id){
        User::find($id)->delete();
    }

    public function ProductWithUser(){
        $user = Auth::user();
        return User::with('users')
        ->where('user_id','=',$user->id)
        ->get();
        ;


    }
}
