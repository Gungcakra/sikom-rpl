<div class="modal fade" tabindex="-1" id="transaksiModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{$id_transaksi ? 'Edit' : 'Add'}} Transaksi</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Keterangan</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid @error('keterangan') is-invalid @enderror" placeholder="Masukkan Keterangan" id="keterangan" autocomplete="off" wire:model="keterangan" />
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Bank</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select @error('id_bank') is-invalid @enderror" data-control="select2" data-placeholder="Pilih Bank" wire:model="id_bank">
                            <option value="">Pilih Bank</option>
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id_bank }}">{{ $bank->nama_bank . ' - ' }} {{ $bank->atas_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Jenis Transaksi</span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select @error('jenis_transaksi') is-invalid @enderror" data-control="select2" data-placeholder="Pilih Jenis" wire:model="jenis_transaksi">
                            <option value="">Pilih Jenis</option>
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column col-md-6 mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nominal</span>
                        </label>
                        <!--end::Label-->
                        <input type="number" class="form-control form-control-solid @error('nominal') is-invalid @enderror" placeholder="Masukkan Nominal" autocomplete="off" id="nominal" wire:model="nominal" />
                    </div>
                </div>
                <!--end::Input group-->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">Close</button>
                <button class="btn btn-primary" wire:click="{{ isset($id_transaksi) ? 'update' : 'store' }}">{{ $id_transaksi ? 'Update' : 'Store' }}</button>
            </div>
        </div>
    </div>
</div>
