<?php

namespace App\Repositories\Dashboard;
use App\Models\Role;

class RolesRepository
{
    public function getRole($id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function createRole($request)
    {
        $role = Role::create([
            'role' => [
                'ar' => $request->role['ar'],
                'en' => $request->role['en'],
            ],
            'permessions' => json_encode($request->permessions),
        ]);

        return $role;

    }

    public function getRoles()
    {
        $roles = Role::select('id', 'role', 'permession')->paginate(6);
        return $roles;
    }

    public function updateRole($request, $role)
    {
        $role = $role->update([
            'role' => $request->role,
            'permessions' => json_encode($request->permessions),
        ]);
        return $role; //return true or flase in upadte

    }

    public function destroy($role)
    {
        return $role->delete();
    }
}
