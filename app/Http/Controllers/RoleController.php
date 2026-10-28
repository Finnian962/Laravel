<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ControllerInterface;
use App\Models\Role;
use App\Providers\Roles\Create;
use App\Providers\Roles\Delete;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller implements ControllerInterface
{
    public function index(): View
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    public function get(int $id): Role
    {
        return Role::findOrFail($id);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
        ]);

        $role->update($data);

        return redirect()->route('roles.index')->with('status', 'De rol is bijgewerkt.');
    }

    public function destroy(int $id): RedirectResponse
    {
        return $this->delete(Role::findOrFail($id));
    }

    public function create(Request $request): RedirectResponse
    {
        $create = new Create;

        return $create->create($request);
    }

    public function delete(Role $role): RedirectResponse
    {
        $delete = new Delete;

        return $delete->delete($role);
    }
}
