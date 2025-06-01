{{-- MENU --}}
<div class="modal fade" tabindex="-1" id="menuModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$menuId ? 'Edit' : 'Add'}} Menu</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

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
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Name" id="name" autocomplete="off" wire:model="name" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Order</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('route')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Order" autocomplete="off" id="order" wire:model="order" />
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Route</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('route')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Route" id="route" autocomplete="off" wire:model="route" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Icon</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('icon')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Icon" id="icon" autocomplete="off" wire:model="icon" />

                    </div>
                </div>
                <!--end::Input group-->


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($menuId) ? 'update' : 'store' }}">{{ $menuId ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>


{{-- SUBMENU --}}
<div class="modal fade" tabindex="-1" id="subMenuModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">SubMenu</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeSubMenuModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

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
                        @error('subMenuName')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Name" id="name" autocomplete="off" wire:model="subMenuName" />
                        <input type="hidden" class="form-control form-control-solid" placeholder="Enter Name" id="name" autocomplete="off" wire:model="menuId" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Order</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target Position for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('subMenuOrder')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Order" autocomplete="off" id="order" wire:model="subMenuOrder" />
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row g-9 mb-8">

                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Route</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('subMenuRoute')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <input type="text" class="form-control form-control-solid" placeholder="Enter Route" id="subMenuRoute" autocomplete="off" wire:model="subMenuRoute" />
                    </div>

                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Permission</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        @error('permissionId')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>

                        @enderror
                        <select class="form-select" data-control="select2" data-placeholder="Select Role" wire:model="permissionId">

                            <option>Select Permission</option>
                            @foreach ($permissions as $permission)

                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <!--end::Input group-->


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeSubMenuModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ $subMenuId ? 'updateSubMenu('.$subMenuId.')' : 'storeSubMenu('.$menuId.')' }}">{{ $subMenuId ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>
