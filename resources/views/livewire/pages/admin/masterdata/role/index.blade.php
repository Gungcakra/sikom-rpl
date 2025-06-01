<div>
    <x-slot:title>Role Management</x-slot:title>
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Role Management</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Role</li>
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
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Add Role</button>
                <button class="btn btn-sm fw-bold btn-primary" wire:click="createPermission()">Add Permission</button>
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
        <div class="row g-5 g-xl-8 d-flex justify-content-center m-5">

            @foreach ($roles as $role)
            <div class="col-xl-4">
                <!--begin::List Widget 1-->
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">{{ $role->name }}</span>
                            {{-- <span class="text-muted mt-1 fw-semibold fs-7">Pending 10 tasks</span> --}}
                        </h3>
                        <div class="card-toolbar">

                            <!--begin::Menu-->
                            <button wire:click="editRole({{ $role->id }})" class="btn btn-sm btn-icon btn-color-success btn-active-light-success" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-pencil">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                            <button wire:click="createAsign({{ $role->id }})" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-category fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </button>
                            <button wire:click="deleteRole({{ $role->id }})" class="btn btn-sm btn-icon btn-color-danger btn-active-light-danger" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-trash">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </button>
                            <!--begin::Menu 1-->
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-5">
                        
                        <!--begin::Item-->
                        @foreach ($role->permissions as $permission)
                        <div class="d-flex align-items-center mb-7">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-duotone ki-abstract-26 fs-2x text-success">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-dark text-hover-primary fs-6 fw-bold">{{ $permission->name }}</a>
                            </div>
                            <!--end::Text-->
                        </div>
                        @endforeach
                        <!--end::Item-->

                        <!--end::Item-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::List Widget 1-->
            </div>
            @endforeach

        </div>
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card p-5">
                <div class="flex w-full">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input
                            type="text"
                            data-kt-customer-table-filter="search"
                            class="form-control form-control-solid w-250px ps-12"
                            placeholder="Search Permission Name"
                            wire:model.live.debounce.100ms="search"
                        />
                    </div>
    
                </div>
                <div class="row g-5 g-xl-8 d-flex justify-content-center m-5">
                    <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>No</th>
                                <th>Action</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
        
                            @if (count($permissionData) < 1) <tr>
                                <td colspan="6" class="text-center">No Data Found</td>
                                </tr>
                                @else
                                @foreach ( $permissionData as $index => $permission)
        
                                <tr wire:key="permission-{{ $permission->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a wire:click="editPermission({{ $permission->id }})" class="menu-link px-3 w-100">Edit</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 w-100" data-kt-ecommerce-product-filter="delete_row" wire:click="deletePermission({{ $permission->id }})">Delete</a>
                                            </div>
                                            <!--end::Menu item-->
                                    </td>
                                    <td>{{ $permission->name }}</td>
        
                                </tr>
                                @endforeach
                                @endif
                        </tbody>
        
        
                    </table>
                </div>
            </div>
        </div>
        {{-- MODAL --}}
        @include('livewire.pages.admin.masterdata.role.modal')

    </div>
</div>
@push('scripts')    
    <script>
        $(function () { 
            Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('roleModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
        } else {
            existingModal.show();
        }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('roleModal');
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

        Livewire.on('show-modal-permission', () => {
            var modalEl = document.getElementById('permissionModal');
                       var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
        } else {
            existingModal.show();
        }
        });
        Livewire.on('hide-modal-permission', () => {
            var modalEl = document.getElementById('permissionModal');
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

        Livewire.on('show-modal-asign', () => {
            var modalEl = document.getElementById('asignModal');
                       var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
            var myModal = new bootstrap.Modal(modalEl, {});
            myModal.show();
        } else {
            existingModal.show();
        }
        });
        Livewire.on('hide-modal-asign', () => {
            var modalEl = document.getElementById('asignModal');
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

        Livewire.on('delete-role', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Yes"
                , cancelButtonText: "No"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteRoleConfirm');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });

        Livewire.on('delete-permission', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Yes"
                , cancelButtonText: "No"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deletePermissionConfirm');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled", "info");
                }
            });
        });
         });
    </script>
@endpush
