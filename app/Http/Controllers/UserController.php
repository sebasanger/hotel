<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        return User::orderBy('id', 'DESC')->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:50',
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
            'telefono' => $request['telefono'],
            'celular' => $request['celular'],
            'direccion' => $request['direccion'],
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string|max:50',
            'email' => [ Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|min:8|max:50',
        ]);



        $user->update($request->all());

        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $user;
    }
}
