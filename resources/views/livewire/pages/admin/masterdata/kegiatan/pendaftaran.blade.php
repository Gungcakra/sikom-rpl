<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Pendaftaran Kegiatan</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pendaftaran Kegiatan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary" wire:navigate>Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Kegiatan</li>
                </ul>
            </div>
            <div class="d-flex items-center"></div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                {{-- <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Tambah Kegiatan</button> --}}
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card p-5">
                <div class="flex w-full">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input
                            type="text"
                            class="form-control form-control-solid w-250px ps-12"
                            placeholder="Cari Pendaftar"
                            wire:model.live.debounce.100ms="search"
                        />
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($dataPendaftaran) < 1)
                            <tr>
                                <td colspan="8" class="text-center">Tidak Ada Data</td>
                            </tr>
                            @else
                            @foreach ($dataPendaftaran as $index => $kegiatan)
                            <tr wire:key="Kegiatan-{{ $kegiatan->id_kegiatan }}">
                                <td>{{ $index + 1 }}</td>
                                {{-- <td>
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a wire:click="edit({{ $kegiatan->id_kegiatan }})" class="menu-link px-3 w-100">Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 w-100" wire:click="delete({{ $kegiatan->id_kegiatan }})">Hapus</a>
                                        </div>
                                    </div>
                                </td> --}}
                                <td>{{ $kegiatan->anggota->nama }}</td>
                                <td>{{ $kegiatan->anggota->nim }}</td>
                                <td>{{ $kegiatan->anggota->prodi }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $dataPendaftaran->onEachSide(1)->links() }}
                    </div>
                </div>
                @include('livewire.pages.admin.masterdata.kegiatan.modal')
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function() {
        Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('kegiatanModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
                var myModal = new bootstrap.Modal(modalEl, {});
                myModal.show();
            } else {
                existingModal.show();
            }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('kegiatanModal');
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
                title: message,
                showCancelButton: true,
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteKegiatan');
                } else {
                    Swal.fire("Aksi Dibatalkan", "Batal Menghapus.", "info");
                }
            });
        });
    });
</script>
@endpush
