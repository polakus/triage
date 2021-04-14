<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class userRolController extends Controller
{
    // get a list of all permissions directly assigned to the user
    // $permissionNames = $user->getPermissionNames(); // collection of name strings
    // $permissions = $user->permissions; // collection of permission objects

    // get all permissions for the user, either directly, or from roles, or from both
    // $permissions = $user->getDirectPermissions();
    // $permissions = $user->getPermissionsViaRoles();
    // $permissions = $user->getAllPermissions();

    // get the names of the user's roles
    // $roles = $user->getRoleNames(); // Returns a collection
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id){
        // $useroles = User::find($id)->getAllPermissions();
        $useroles = User::find($id)->getRoleNames();

        return view('rolusuario.show', compact('useroles'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
