<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Main\StoreUserRequest;
use App\Http\Requests\Admin\Main\UpdateUserRequest;
use App\Jobs\StoreUserJob;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        $roles = User::getRoles();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        StoreUserJob::dispatch($data);

        return redirect()->route('admin.user.index');
    }

    public function edit(User $user)
    {
        $roles = User::getRoles();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => 'required|string|max:255',
            'role' => 'required|integer',
        ]);

        $user->update($data);

        return redirect()->route('admin.user.show', $user);
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
