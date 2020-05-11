<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index($query = null)
    {
        if (empty($query)) {
            $users = User::orderBy('id', 'DESC')->paginate(11);
        } else {
            $filter = trim(strtolower($query));
            $users = User::where('name', 'LIKE', "%$filter%")
                ->orWhere('email', 'LIKE', "%$filter%")
                ->paginate(20);
        }
        return $users;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:50',
            'role' => 'required',
            'telefono' => 'nullable|numeric',
            'celular' => 'nullable|numeric',
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
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');

        $user = User::findOrFail($id);

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string|max:50',
            'email' => [Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|min:8|max:50',
            'role' => 'required',
            'telefono' => 'nullable|numeric',
            'celular' => 'nullable|numeric',
        ]);
        $user->update($request->all());

        return $user;
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function userFind()
    {
        return Auth::user();
    }

    public function getAllUsers()
    {
        return User::orderBy('name')->select('id', 'name')->get();
    }
}
