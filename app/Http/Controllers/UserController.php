<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Role;
use App\Models\User;
use App\Providers\Users\Create;
use App\Providers\Users\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $users = User::with('role')->get();
        $roles = Role::orderBy('name')->get();

        return view('users.index', compact('users', 'roles'));
    }

    public function get(int $id): User
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'email', 'max:45', Rule::unique('users', 'email')->ignore($user->id)],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $user->update($data);

        return redirect()->route('users.index')->with('status', 'De gebruiker is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(User::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(User $user): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($user);
    }
}
