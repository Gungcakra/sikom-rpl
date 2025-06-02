<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Daftar Kegiatan</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Daftar Kegiatan</h1>
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
            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Tambah Kegiatan</button>
            </div> --}}
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
                        <input type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Kegiatan" wire:model.live.debounce.100ms="search" />
                    </div>
                </div>
                <div class="row">
                    @forelse($data as $key => $item)
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                <div>
                                    <p class="fs-2 card-title mb-1 fw-bold text-primary">{{ $item->nama_kegiatan }}</p>
                                    <p class="fs-2 card-title mb-1 fw-bold text-primary">{{ $item->organisasi->nama_organisasi }}</p>
                                    <div class="text-muted small mb-2">
                                        <i class="ki-duotone ki-calendar"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal_pelaksanaan)->format('d M Y') }}
                                        &nbsp;|&nbsp;
                                        <i class="ki-duotone ki-location"></i>
                                        {{ $item->lokasi }}
                                    </div>
                                    <div class="mb-2">
                                        <span class="badge bg-light-primary text-primary fw-semibold">{{ $item->status }}</span>
                                        <span class="badge bg-light-info text-info fw-semibold">Kuota: {{ $item->kuota_peserta }}</span>
                                    </div>
                                    <p class="card-text text-gray-700 mb-0" style="max-width: 600px; white-space: pre-line;">
                                        {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                                    </p>
                                </div>
                                <div class="d-flex flex-column gap-2 mt-3">
                                    <button class="btn btn-sm btn-light-primary" wire:click="daftar({{ $item->id_kegiatan }})">
                                        <i class="ki-duotone ki-pencil"></i> Daftar
                                    </button>
                                    {{-- <button class="btn btn-sm btn-light-danger" wire:click="confirmDelete({{ $item->id_kegiatan }})">
                                    <i class="ki-duotone ki-trash"></i> Hapus
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Tidak Ada Data
                        </div>
                    </div>
                    @endforelse
                </div>
                {{-- @include('livewire.pages.admin.masterdata.kegiatan.modal') --}}
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
                title: message
                , showCancelButton: true
                , confirmButtonText: "Yes"
                , cancelButtonText: "No"
                , icon: "warning"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteKegiatan');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });

        Livewire.on('error-alert', (message) => {
            Swal.fire({
                title: message
                , icon: "error"
            })
        });
        Livewire.on('daftar-alert', (message) => {
            Swal.fire({
                title: message
                , icon: "info"
            })
        });
    });

</script>
@endpush
