<div class="modal fade" tabindex="-1" id="userModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$userId ? 'Edit' : 'Add'}} User</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($userId) ? 'update' : 'store' }}"
                > --}}

                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
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
                      
                        <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Name" id="name" autocomplete="off" wire:model="name" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Email</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                      
                        <input type="text" class="form-control form-control-solid @error('email') is-invalid @enderror" placeholder="Enter Position" autocomplete="off" id="position" wire:model="email" />
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Role</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <select class="form-select @error('role') is-invalid @enderror" data-control="select2" data-placeholder="Select Role" wire:model="selectedRole">

                            <option>Select Role</option>
                            @foreach ($roles as $role)
                                
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Password</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                     
                        <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Enter Password" autocomplete="off" id="position" wire:model="password" />
                    </div>
                </div>
                <!--end::Input group-->


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($userId) ? 'update' : 'store' }}">{{ $userId ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>