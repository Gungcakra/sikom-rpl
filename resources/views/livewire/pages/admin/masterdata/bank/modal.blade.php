<div class="modal fade" tabindex="-1" id="bankModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$bankId ? 'Edit' : 'Add'}} Bank</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body">
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama Bank</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('nama_bank') is-invalid @enderror" placeholder="Nama Bank" wire:model="nama_bank" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nomor Rekening</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('nomor_rekening') is-invalid @enderror" placeholder="Nomor Rekening" wire:model="nomor_rekening" />
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Atas Nama</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('atas_nama') is-invalid @enderror" placeholder="Atas Nama" wire:model="atas_nama" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nominal</span>
                        </label>
                        <input type="number" class="form-control form-control-solid @error('nominal') is-invalid @enderror" placeholder="Nominal" wire:model="nominal" />
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($bankId) ? 'update' : 'store' }}">{{ $bankId ? 'Update' : 'Store' }}</button>
            </div>
        </div>
    </div>
</div>
