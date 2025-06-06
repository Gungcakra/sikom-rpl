<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Menu Management</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Menu Management</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary" wire:navigate>Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Menu</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Tambah Menu</button>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card p-5">
                <div class="table-responsive">
                    <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Route</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $data as $index => $menu)
    
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Menu
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a wire:click="edit({{ $menu->id }})" class="menu-link px-3 w-100">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 w-100" data-kt-ecommerce-product-filter="delete_row" wire:click="delete({{ $menu->id }})">Hapus</a>
                                        </div>
    
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 w-100" wire:click="createSubMenu({{ $menu->id }})">Tambah SubMenu</a>
                                        </div>
                                </td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->icon }}</td>
                                <td>{{ $menu->route }}</td>
                                <td>{{ $menu->order }}</td>
                            </tr>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th></th>
                                <th>Aksi</th>
                                <th>Name</th>
                                <th>Route</th>
                                <th>Permission</th>
                            </tr>
                            @foreach($menu->submenus as $submenu)
                            <tr>
                                <td></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">SubMenu
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 w-100" wire:click="editSubMenu({{ $submenu->id}})">Edit</a>
                                        </div>
    
                                        <div class="menu-item px-3">
                                            <a class="menu-link px-3 w-100" wire:click="deleteSubMenu({{ $submenu->id }})">Hapus</a>
                                        </div>
                                </td>
                                <td>— {{ $submenu->name }}</td>
                                <td>{{ $submenu->route }}</td>
                                <td>{{ $submenu->permission->name }}</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
    
    
                    </table>
                </div>
                
                {{-- MENU SUBMENU MODAL --}}
                @include('livewire.pages.admin.masterdata.menu.modal')
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>
       $(function(){
        Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('menuModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
        } else {
            existingModal.show();
        }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('menuModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
            modal.hide();
            modal.dispose();
            }
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open'); 
            document.body.style.overflow = ''; 
            document.body.style.paddingRight = ''; 
        });

        Livewire.on('show-submenu-modal', () => {
            var modalEl = document.getElementById('subMenuModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
            } else {
                existingModal.show();
            }
        });
        Livewire.on('hide-submenu-modal', () => {
            var modalEl = document.getElementById('subMenuModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
            modal.hide();
            modal.dispose();
            }
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open'); 
            document.body.style.overflow = ''; 
            document.body.style.paddingRight = ''; 
        });

        Livewire.on('delete-menu', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Ya"
,
                confirmButtonColor: "#d33"
                , cancelButtonText: "Tidak"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteMenu');
                } else {
                    Swal.fire("Aksi Dibatalkan", "Batal Menghapus.", "info");
                }
            });
        });

        Livewire.on('delete-submenu', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Ya"
,
                confirmButtonColor: "#d33"
                , cancelButtonText: "Tidak"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteSubMenuConfirmed');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled", "info");
                }
            });
        });
       });

    </script>
@endpush
