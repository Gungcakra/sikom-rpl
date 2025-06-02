<div class="modal fade" tabindex="-1" id="organisasiModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$id_organisasi ? 'Edit' : 'Tambah'}} Organisasi</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama Organisasi</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('nama_organisasi') is-invalid @enderror" placeholder="Masukkan Nama Organisasi" wire:model="nama_organisasi" />
                        @error('nama_organisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Jenis</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('jenis') is-invalid @enderror" placeholder="Masukkan Jenis Organisasi" wire:model="jenis" />
                        @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Deskripsi</span>
                        </label>
                        <textarea class="form-control form-control-solid @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi" rows="4" wire:model="deskripsi"></textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tahun Berdiri</span>
                        </label>
                        <input type="number" class="form-control form-control-solid @error('tahun_berdiri') is-invalid @enderror" placeholder="Masukkan Tahun Berdiri" wire:model="tahun_berdiri" />
                        @error('tahun_berdiri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($id_organisasi) ? 'update' : 'store' }}">{{ $id_organisasi ? 'Update' : 'Store' }}</button>
            </div>
        </div>
    </div>
</div>
