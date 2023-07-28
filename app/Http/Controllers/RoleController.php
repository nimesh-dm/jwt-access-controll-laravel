<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
class RoleController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json(['role' => $role], 201);
    }

    public function getRoles(Request $request){
        $role = Role::get();
        return response()->json(['roles'=>$role], 201);
    }

    public function setUserRole(Request $request){
        // try {
            $user = User::where('id', $request->get('user_id'))->first();
            $role = Role::where('id', $request->get('role_id'))->first();
            $user->roles()->attach($role);

            return response()->json(['user' => $user, 'role'=>$role], 201);
        // } catch (\Throwable $th) {
        //     return response()->json(['error'=>$th], 500);
        // }
        
    }
}
