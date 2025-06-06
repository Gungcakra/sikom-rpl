<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Manajemen Pengurus</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Manajemen Pengurus</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary" wire:navigate>Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Pengurus</li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePengurusForm" aria-expanded="false" aria-controls="collapsePengurusForm">
                    Tambah Pengurus
                </button>
            </div>
        </div>
    </div>
    {{-- Collapse Card for Form --}}
    <div class="collapse @if($showForm) show @endif mb-4" id="collapsePengurusForm">
        <div class="card card-flush border border-primary">
            <div class="card-header">
                <div class="card-title fw-bold">{{ $id_pengurus ? 'Edit' : 'Tambah' }} Pengurus</div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-light" data-bs-toggle="collapse" data-bs-target="#collapsePengurusForm" aria-label="Close" wire:click="closeModal">
                        <i class="ki-duotone ki-cross fs-2"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="row g-9 mb-8">
                    <div class="col-md-6 mb-8 fv-row d-flex flex-column">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Anggota</span>
                        </label>
                        <div wire:ignore>
                            <select class="form-select" data-control="select2" data-placeholder="Pilih Anggota" wire:model="id_anggota" onchange="@this.set('id_anggota', this.value)">
                                <option></option>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id_anggota }}" {{ $id_anggota == $anggota->id_anggota ? 'selected' : '' }}>
                                        {{ $anggota->nama . ' - ' }} {{ $anggota->organisasi->nama_organisasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('id_anggota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-8 fv-row d-flex flex-column">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Jabatan</span>
                        </label>
                        <input type="text" class="form-control form-control-solid @error('jabatan') is-invalid @enderror" placeholder="Masukkan Jabatan" wire:model="jabatan" />
                        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-6 mb-8 fv-row d-flex flex-column">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Periode Mulai</span>
                        </label>
                        <input type="date" class="form-control form-control-solid @error('periode_mulai') is-invalid @enderror" wire:model="periode_mulai" />
                        @error('periode_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-8 fv-row d-flex flex-column">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Periode Akhir</span>
                        </label>
                        <input type="date" class="form-control form-control-solid @error('periode_akhir') is-invalid @enderror" wire:model="periode_akhir" />
                        @error('periode_akhir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light" data-bs-toggle="collapse" data-bs-target="#collapsePengurusForm" wire:click="closeModal">Batal</button>
                    <button wire:click="{{ $id_pengurus ? 'update' : 'store' }}" class="btn btn-primary">{{ $id_pengurus ? 'Update' : 'Store' }}</button>
                </div>

            </div>
        </div>
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card p-5">
                <div class="flex w-full mb-4">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Nama Anggota / Jabatan" wire:model.live.debounce.100ms="search" />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Anggota</th>
                                <th>Organisasi</th>
                                <th>Jabatan</th>
                                <th>Periode Mulai</th>
                                <th>Periode Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->count() < 1) <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                                @else
                                @foreach ($data as $index => $pengurus)
                                <tr wire:key="Pengurus-{{ $pengurus->id_pengurus }}">
                                    <td>{{ $data->firstItem() + $index }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a wire:click="edit({{ $pengurus->id_pengurus }})" class="menu-link px-3 w-100">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 w-100" wire:click="delete({{ $pengurus->id_pengurus }})">Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $pengurus->anggota->nama ?? '-' }}</td>
                                    <td>{{ $pengurus->anggota->organisasi->nama_organisasi}}</td>
                                    <td>{{ $pengurus->jabatan }}</td>
                                    <td>{{ $pengurus->periode_mulai }}</td>
                                    <td>{{ $pengurus->periode_akhir }}</td>
                                </tr>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $data->onEachSide(1)->links() }}
                    </div>
                </div>
                @include('livewire.pages.admin.masterdata.pengurus.modal')
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function() {
        Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('pengurusModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
                var myModal = new bootstrap.Modal(modalEl, {});
                myModal.show();
            } else {
                existingModal.show();
            }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('pengurusModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
                modal.dispose();
            }
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            modalEl.style.display = 'none';
            modalEl.setAttribute('aria-hidden', 'true');
            modalEl.removeAttribute('aria-modal');
            modalEl.removeAttribute('role');
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        });
        Livewire.on('confirm-delete', (message) => {
            Swal.fire({
                title: message
                , showCancelButton: true
                , confirmButtonText: "Ya"
,
                confirmButtonColor: "#d33"
                , cancelButtonText: "Tidak"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deletePengurus');
                } else {
                    Swal.fire("Dibatalkan", "Penghapusan dibatalkan.", "info");
                }
            });
        });
    });

</script>
@endpush
