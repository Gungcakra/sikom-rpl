<div class="modal fade" tabindex="-1" id="anggotaModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$idAnggota ? 'Edit' : 'Add'}} Anggota</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($idAnggota) ? 'update' : 'store' }}"
                > --}}

                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" id="nama" autocomplete="off" wire:model="nama" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">NIM</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('nim') is-invalid @enderror" placeholder="Masukkan NIM" id="nim" autocomplete="off" wire:model="nim" />
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">No HP</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('no_hp') is-invalid @enderror" placeholder="Masukkan No HP" id="no_hp" autocomplete="off" wire:model="no_hp" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Prodi</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('prodi') is-invalid @enderror" placeholder="Masukkan Prodi" id="prodi" autocomplete="off" wire:model="prodi" />
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tanggal Gabung</span>
                        </label>
                        <!--end::Label-->
                        <input type="date" class="form-control form-control-solid @error('tanggal_gabung') is-invalid @enderror" id="tanggal_gabung" wire:model="tanggal_gabung" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Status Keanggotaan</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('status_keanggotaan') is-invalid @enderror" placeholder="Masukkan Status Keanggotaan" id="status_keanggotaan" autocomplete="off" wire:model="status_keanggotaan" />
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Organisasi</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select" wire:model="id_organisasi" data-control="select2" data-placeholder="Pilih Organisasi" data-dropdown-parent="#anggotaModal">
                            <option value="">Pilih Organisasi</option>
                            @foreach ($organisasi as $org)
                                <option value="{{ $org->id_organisasi }}" {{ $id_organisasi == $org->id_organisasi ? 'selected' : '' }}>{{ $org->nama_organisasi }}</option>
                          
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($idAnggota) ? 'update' : 'store' }}">{{ $idAnggota ? 'Update' : 'Store' }}</button>

            </div>
        </div>
    </div>
</div>
