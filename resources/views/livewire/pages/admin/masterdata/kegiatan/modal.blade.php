<div class="modal fade" tabindex="-1" id="kegiatanModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$id_kegiatan ? 'Edit' : 'Tambah'}} Kegiatan</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row g-9 mb-8">
                    <div class="col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama Kegiatan</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('nama_kegiatan') is-invalid @enderror" placeholder="Masukkan Nama Kegiatan" wire:model="nama_kegiatan" />
                        @error('nama_kegiatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Deskripsi</span>
                        </label>
                        <textarea class="form-control form-control-solid @error('deskripsi') is-invalid @enderror" placeholder="Masukkan Deskripsi" rows="1" wire:model="deskripsi"></textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Tanggal Pelaksanaan</span>
                        </label>
                        <input type="date" class="form-control form-control-solid @error('tanggal_pelaksanaan') is-invalid @enderror" placeholder="Masukkan Tanggal Pelaksanaan" wire:model="tanggal_pelaksanaan" />
                        @error('tanggal_pelaksanaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Kuota Peserta</span>
                        </label>
                        <input type="number" class="form-control form-control-solid @error('kuota_peserta') is-invalid @enderror" placeholder="Masukkan Kuota Peserta" wire:model="kuota_peserta" />
                        @error('kuota_peserta') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Lokasi</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('lokasi') is-invalid @enderror" placeholder="Masukkan Lokasi" wire:model="lokasi" />
                        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Status</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('status') is-invalid @enderror" placeholder="Masukkan Status" wire:model="status" />
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                @if(Auth::user()->roles->pluck('name')->first() == 'admin')
                <div class="row g-9 mb-8">
                    <div class="col-md-12 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Organisasi</span>
                        </label>
                        <select class="form-select form-select-solid @error('id_organisasi') is-invalid @enderror" wire:model="id_organisasi">
                            <option value="">Pilih Organisasi</option>
                            @foreach($organisasis as $organisasi)
                                <option value="{{ $organisasi->id_organisasi }}">{{ $organisasi->nama_organisasi }}</option>
                            @endforeach
                        </select>
                        @error('id_organisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($id_kegiatan) ? 'update' : 'store' }}">{{ $id_kegiatan ? 'Update' : 'Store' }}</button>
            </div>
        </div>
    </div>
</div>
