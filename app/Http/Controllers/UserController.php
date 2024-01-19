<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return new UserResource(true, 'List of Users!', $users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'role_id' => 'required',
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'role_id.required' => 'The Role ID must be filled in!',
            'name.required' => 'The Name must be filled in!',
            'name.regex' => 'The Name only contains letters!',
            'name.max' => 'The Name exceeds the limit, make it shorter!',
            'email.required' => 'The Email must be filled in!',
            'email.email' => 'The Email you entered is incorrect!',
            'email.unique' => 'The Email you entered is already used, use another Email!',
            'email.required' => 'The Password must be filled in!',
            'email.min' => 'The Password must contain at least 6 digits!',
        ]);


        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $user = User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        if ($user)
            return new UserResource(true, 'Successfully Added User!', $user);
        return response()->json(['message' => 'Failed to Add User!'], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource(true, 'Successfully Show User Detail!', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'role_id' => 'required',
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'role_id.required' => 'The Role ID must be filled in!',
            'name.required' => 'The Name must be filled in!',
            'name.regex' => 'The Name only contains letters!',
            'name.max' => 'The Name exceeds the limit, make it shorter!',
            'email.required' => 'The Email must be filled in!',
            'email.email' => 'The Email you entered is incorrect!',
            'email.required' => 'The Password must be filled in!',
            'email.min' => 'The Password must contain at least 6 digits!',
        ]);


        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $updated = $user->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'updated_at' => Carbon::now(),
        ]);

        if ($updated)
            return new UserResource(true, 'Successfully Updated User!', $user);
        return response()->json(['message' => 'Failed to Update User!'], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if ($deleted)
            return new UserResource(true, 'Successfully Deleted User!', null);
        return response()->json(['message' => 'Failed to Delete User!'], 422);
    }
}
