<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin')]

class RolesPermissions extends Component
{
    public $roles, $permissions, $name, $permissionName, $selectedRole, $selectedPermissions = [], $roleId, $idRoleToDelete, $permissionId, $roleWithPermissions, $search = '';
    protected $listeners = ['deleteRoleConfirm', 'deletePermissionConfirm'];

    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });
    
        if (!$userPermissions->contains('masterdata-role')) {
            abort(403, 'Unauthorized action.');
        }
        $this->fetchRoles();
        $this->permissions = Permission::all();
    }
    public function fetchRoles()
    {
        $this->roles = Role::with('permissions')->get();
    }


    public function openModal()
    {
        $this->dispatch('show-modal');
    }

    public function openModalPermission()
    {
        $this->dispatch('show-modal-permission');
    }
    public function openModalAsign()
    {
        $this->dispatch('show-modal-asign');
    }

    public function closeModal()
    {
        $this->reset(['name']);
        $this->dispatch('hide-modal');
        $this->roleId = null;
    }
    public function closeModalPermission()
    {
        $this->reset(['permissionName']);
        $this->dispatch('hide-modal-permission');
        $this->permissionId = null;
    }
    public function closeModalAsign()
    {
        $this->dispatch('hide-modal-asign');
    }
    public function create()
    {
        $this->openModal();
    }

    public function createPermission()
    {
        $this->openModalPermission();
    }

    public function createAsign($id)
    {
        $this->roleId = $id;
        $role = Role::findOrFail($id);

        
        $this->permissions = Permission::all();
        
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        
        $this->openModalAsign();
    }

    public function assignPermissionsToRole()
    {
        try{
            $this->validate([
                'selectedPermissions' => 'required|array',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
            }

        $role = Role::findOrFail($this->roleId);
        $permissionNames = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();
        $role->syncPermissions($permissionNames);
        if ($role) {
            $this->dispatch('success', 'Permissions assigned to role successfully');
            $this->fetchRoles();
        } else {
            $this->dispatch('error', 'Role not found');
        }
        $this->closeModalAsign();
    }
    public function storePermission()
    {
        $this->validate([
            'permissionName' => 'required|unique:permissions,name',
        ]);
        Permission::create(['name' => $this->permissionName]);
        $this->dispatch('success', 'Permission created successfully');
        // $latestPermissionId = Permission::latest()->first()->id;
        // $role = Role::find($this->roleId);
        // if ($role) {
        //     $role->givePermissionTo($latestPermissionId);
        // } else {
        //     $this->dispatch('error', 'Role not found');
        // }
        $this->closeModalPermission();
        $this->fetchRoles();
    }
    public function storeRole()
    {
        try{
            $this->validate([
                'name' => 'required|unique:roles,name',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }
        Role::create(['name' => $this->name]);
        $this->dispatch('success', 'Role created successfully');
        $this->closeModal();
        $this->fetchRoles();
    }

    public function editRole($id)
    {
        $this->roleId = $id;
        $role = Role::find($id);
        if ($role) {
            $this->name = $role->name;
            $this->dispatch('show-modal');
        } else {
            $this->dispatch('error', 'Role not found');
        }
    }


    public function updateRole()
    {
        try{
            $this->validate([
                'name' => 'required|unique:roles,name,' . $this->roleId,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }
        $role = Role::find($this->roleId);
        if ($role) {
            $role->name = $this->name;
            $role->save();
            $this->dispatch('success', 'Role updated successfully');
            $this->closeModal();
            $this->fetchRoles();
        } else {
            $this->dispatch('error', 'Role not found');
        }
    }

    public function editPermission($id)
    {
        $this->permissionId = $id;
        $permission = Permission::find($id);
        if ($permission) {
            $this->permissionName = $permission->name;
            $this->dispatch('show-modal-permission');
        } else {
            $this->dispatch('error', 'Permission not found');
        }
    }
    public function updatePermission()
    {
        try{
            $this->validate([
                'permissionName' => 'required|unique:permissions,name,' . $this->permissionId,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }
        $permission = Permission::find($this->permissionId);
        if ($permission) {
            $permission->name = $this->permissionName;
            $permission->save();
            $this->dispatch('success', 'Permission updated successfully');
            $this->closeModalPermission();
            $this->permissions = Permission::all();
        } else {
            $this->dispatch('error', 'Permission not found');
        }
    }
    public function assignPermissionToRole($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);
        if ($role && $permission) {
            $role->givePermissionTo($permission);
            $this->dispatch('success', 'Permission assigned to role successfully');
        } else {
            $this->dispatch('error', 'Role or Permission not found');
        }
    }
    public function deleteRole($id)
    {
        $this->idRoleToDelete = $id;
        $this->dispatch('delete-role', 'Are you sure you want to delete this role?');
    }
    public function deletePermission($id)
    {
        $this->permissionId = $id;
        $this->dispatch('delete-permission', 'Are you sure you want to delete this permission?');
    }
    public function deletePermissionConfirm()
    {
        if ($this->permissionId) {
            $permission = Permission::find($this->permissionId);
            if ($permission) {
                $permission->delete();
                $this->dispatch('delete-success', 'Permission deleted successfully');
                $this->permissions = Permission::all();
            } else {
                $this->dispatch('error', 'Permission not found');
            }
        }
    }
    public function deleteRoleConfirm()
    {
        if ($this->idRoleToDelete) {
            $role = Role::find($this->idRoleToDelete);
            if ($role) {
                $role->delete();
                $this->dispatch('delete-success', 'Role deleted successfully');
                $this->fetchRoles();
            } else {
                $this->dispatch('error', 'Role not found');
            }
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.role.index',[
            'permissionData' => Permission::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->get()
        ]);
    }
}
