{{-- ROLE MODAL --}}
<div class="modal fade" tabindex="-1" id="roleModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$roleId ? 'Edit' : 'Add'}} Role</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($CustomerId) ? 'update' : 'store' }}"
                > --}}

                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Name</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Name" id="name" autocomplete="off" wire:model="name" />
                    </div>
                
                </div>
                <!--end::Input group-->


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($roleId) ? 'updateRole' : 'storeRole' }}">{{ $roleId ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>

{{-- PERMISSION MODAL --}}
<div class="modal fade" tabindex="-1" id="permissionModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$permissionId ? 'Edit' : 'Add'}} Permission</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($CustomerId) ? 'update' : 'store' }}"
                > --}}

                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Name</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('permissionName')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Name" id="name" autocomplete="off" wire:model="permissionName" />
                    </div>
                
                </div>
                <!--end::Input group-->


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModalPermission">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($permissionId) ? 'updatePermission' : 'storePermission' }}" >{{ $permissionId ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>


{{-- ASIGN MODAL --}}

<div class="modal fade" tabindex="-1" id="asignModal" aria-hidden="true" wire:wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Asign Permission</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModalAsign">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($CustomerId) ? 'update' : 'store' }}"
                > --}}

                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <!--begin::Label-->
                        
                        @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input type="checkbox" wire:model="selectedPermissions" class="form-check-input" name="permissions[]" value="{{ $permission->id }}"
                            {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                
                </div>
                <!--end::Input group-->


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModalAsign">Close</button>
                <button class="btn btn-primary" wire:click="assignPermissionsToRole">{{ $permissionId ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>