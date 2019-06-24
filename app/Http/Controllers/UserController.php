<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function indexAction()
    {
        $users = User::all();

        return view('users.index')
            ->with('title', 'Listado de usuarios')
            ->with('users', $users);
    }

    public function editAction(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function newAction()
    {
        return view('users.create');
    }

    public function showAction(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function storeAction()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'profession_id' => 'required|numeric',
            'password' => ['required','min:6']
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo correo es obligatorio',
            'email.email' => 'Por favor ingrese una dirección de correo válida',
            'profession_id.required' => 'El campo id de profesión es obligatorio',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'profession_id' => $data['profession_id'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }

    public function updateAction(User $user)
    {
        $data = request()->validate([
            'password' => '',
            'name' => 'required',
            'profession_id' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)]
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function destroyAction(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
