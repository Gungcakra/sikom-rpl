<div class="modal fade" tabindex="-1" id="pengumumanModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$idPengumuman ? 'Edit' : 'Tambah'}} Pengumuman</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{-- <form id="kt_modal_new_target_form" class="form" wire:submit.prevent="{{ isset($idPengumuman) ? 'update' : 'store' }}"
                > --}}

                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Judul</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan judul pengumuman">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('judul') is-invalid @enderror" placeholder="Masukkan Judul" id="judul" autocomplete="off" wire:model="judul" />
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Isi Pengumuman</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Masukkan isi pengumuman">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <textarea class="form-control form-control-solid @error('isi') is-invalid @enderror" placeholder="Masukkan Isi Pengumuman" id="isi" rows="4" wire:model="isi"></textarea>
                        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                @if(Auth::user()->roles->pluck('name')->first() == 'admin')
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Organisasi</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih organisasi">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select @error('id_organisasi') is-invalid @enderror text-dark" data-control="select2" data-placeholder="Pilih Organisasi" wire:model="id_organisasi" data-dropdown-parent="#pengumumanModal">
                            <option value="">Pilih Organisasi</option>
                            @foreach ($organisasi as $organisasi)
                            <option value="{{ $organisasi->id_organisasi }}">{{ $organisasi->nama_organisasi }}</option>
                            @endforeach
                        </select>
                        @error('id_organisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tanggal Post</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih tanggal posting">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input type="date" class="form-control form-control-solid @error('tanggal_post') is-invalid @enderror" id="tanggal_post" wire:model="tanggal_post" />
                        @error('tanggal_post') <div class="invalid-feedback">{{ $message }}
                </div> @enderror
            </div> --}}
        </div>
        @else
        @endif
        <!--end::Input group-->


    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
        <button class="btn btn-primary" wire:click="{{ isset($idPengumuman) ? 'update' : 'store' }}">{{ $idPengumuman ? 'Update' : 'Store' }}</button>

    </div>
</div>
</div>
</div>
