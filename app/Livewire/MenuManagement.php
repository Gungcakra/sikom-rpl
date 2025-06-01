<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

#[Layout('layouts.admin')]
class MenuManagement extends Component
{
    public $menuId, $menus, $submenus, $name, $route, $order, $icon, $dataSubMenu, $subMenuId,  $subMenuName, $subMenuRoute, $subMenuOrder, $permissionId, $menuIdToDelete, $subMenuIdToDelete;

    protected $listeners = ['deleteMenu', 'deleteSubMenuConfirmed'];
    public $isModalOpen = false;

    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });
    
        if (!$userPermissions->contains('masterdata-menu')) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function openModal()
    {

        $this->isModalOpen = true;
        $this->dispatch('show-modal');
    }
    public function closeModal()
    {
        $this->reset(['menuId', 'name', 'route', 'order', 'icon']);
        $this->isModalOpen = false;
        $this->dispatch(event: 'hide-modal');
    }

    public function closeSubMenuModal()
    {
        $this->reset(['menuId', 'subMenuId','subMenuName', 'subMenuOrder', 'subMenuRoute','permissionId']);
        $this->dispatch(event: 'hide-submenu-modal');
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.menu.index', [
            'data' => Menu::with(['submenus.permission'])->get(),
            'permissions' => Permission::all(),
        ]);
    }

    public function create()
    {
        $this->openModal();
    }
    public function store()
    {
        
        try{
     
            $this->validate([
                'name' => 'required|string|max:255',
                'route' => 'required|string|max:255',
                'order' => 'required|integer',
                'icon' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }
        Menu::create([
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
            'icon' => $this->icon,
        ]);

        $this->dispatch('success', 'Menu added successfully!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->menuId = $id;
        $menu = Menu::findOrFail($id);
        $this->icon = $menu->icon;
        $this->fill($menu->only(['name', 'route', 'order', 'icon']));
        $this->dispatch('show-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'icon' => 'required|string|max:255',
        ]);

        $menu = Menu::findOrFail($this->menuId);
        $menu->update([
            'name' => $this->name,
            'route' => $this->route,
            'order' => $this->order,
            'icon' => $this->icon,

        ]);

        $this->dispatch('success', 'Menu updated successfully!');
        $this->closeModal();
    }
    public function delete($id)
    {
       $this->menuIdToDelete = $id;
        $this->dispatch( 'delete-menu',"Are you sure you want to delete this menu?");
    }

    public function deleteMenu()
    {
        if($this->menuIdToDelete){
            $menu = Menu::findOrFail($this->menuIdToDelete);
            $menu->delete();
            $this->dispatch('delete-success', 'Menu deleted successfully!');
        }
    }

    public function createSubMenu($id)
    {
        $this->menuId = $id;
        $this->dispatch(event: 'show-submenu-modal');
    }
    public function storeSubMenu($menuId)
    {
        try{
            $this->validate([
                'subMenuName' => 'required|string|max:255',
                'subMenuRoute' => 'required|string|max:255',
                'subMenuOrder' => 'required|integer',
                'permissionId' => 'required|exists:permissions,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }

        SubMenu::create([
            'menu_id' => $menuId,
            'name' => $this->subMenuName,
            'route' => $this->subMenuRoute,
            'order' => $this->subMenuOrder,
            'permission_id' => $this->permissionId,
        ]);

        $this->dispatch('success', 'Submenu added successfully!');
        $this->closeSubMenuModal();
    }
    public function deleteSubMenu($id)
    {
        $this->subMenuIdToDelete = $id;
        $this->dispatch('delete-submenu', 'Are you sure you want to delete this submenu?');
    }

    public function deleteSubMenuConfirmed()
    {
        if ($this->subMenuIdToDelete) {
            $submenu = SubMenu::findOrFail($this->subMenuIdToDelete);
            $submenu->delete();
            $this->dispatch('delete-success', 'Submenu deleted successfully!');
        }
    }
    public function editSubMenu($id)
    {
        $submenu = SubMenu::findOrFail($id);
        $this->subMenuId = $id;
        $this->permissionId = $submenu->permission_id;
        $this->menuId = $submenu->menu_id;
        $this->subMenuName = $submenu->name;
        $this->subMenuRoute = $submenu->route;
        $this->subMenuOrder = $submenu->order;
        // $this->fill($submenu->only(['subMenuName', 'subMenuRoute', 'subMenuOrder']));
        $this->dispatch('show-submenu-modal');
    }
    public function updateSubMenu($id)
    {
        try{
            $this->validate([
                'subMenuName' => 'required|string|max:255',
                'subMenuRoute' => 'required|string|max:255',
                'subMenuOrder' => 'required|integer',
                'permissionId' => 'required|exists:permissions,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }

        $submenu = SubMenu::findOrFail($id);
        $submenu->update([
            'name' => $this->subMenuName,
            'route' => $this->subMenuRoute,
            'order' => $this->subMenuOrder,
            'permission_id' => $this->permissionId,
        ]);

        $this->dispatch('success', 'Submenu updated successfully!');
        $this->closeSubMenuModal();
    }
}
