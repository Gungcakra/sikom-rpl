<div class="modal fade" tabindex="-1" id="pengurusModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $id_pengurus ? 'Edit' : 'Tambah' }} Pengurus</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Anggota</span>
                        </label>
                        <select class="form-select form-select-solid @error('id_anggota') is-invalid @enderror" wire:model="id_anggota">
                            <option value="">Pilih Anggota</option>
                            @foreach($anggotas as $anggota)
                                <option value="{{ $anggota->id_anggota }}">{{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Jabatan</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('jabatan') is-invalid @enderror" placeholder="Masukkan Jabatan" wire:model="jabatan" />
                        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Periode Mulai</span>
                        </label>
                        <input type="date" class="form-control form-control-solid @error('periode_mulai') is-invalid @enderror" wire:model="periode_mulai" />
                        @error('periode_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Periode Akhir</span>
                        </label>
                        <input type="date" class="form-control form-control-solid @error('periode_akhir') is-invalid @enderror" wire:model="periode_akhir" />
                        @error('periode_akhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click.prevent="{{ $id_pengurus ? 'update' : 'store' }}">{{ $id_pengurus ? 'Update' : 'Store' }}</button>
            </div>
        </div>
    </div>
</div>
