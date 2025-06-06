<div class="d-flex flex-column flex-column-fluid">
    <x-slot:title>Laporan Transaksi</x-slot:title>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laporan Keuangan</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Transaksi</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>

            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                {{-- <button class="btn btn-sm fw-bold btn-primary" wire:click="create()">Tambah Transaksi</button> --}}
                @if(Auth::user()->roles->pluck('name')->first() == 'pengurus')
                <button class="btn btn-sm fw-bold btn-danger" onclick="printMainContent()">Export To PDF</button>
                <button class="btn btn-sm fw-bold btn-success" onclick="exportToExcel()">Export To EXCEL</button>
                @endif
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card p-5">
                <div class="d-flex items-center gap-3">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Cari Transaksi" wire:model.live.debounce.100ms="search" />
                    </div>
                    <div class="form-group position-relative mb-0">
                        <input type="text" class="form-control form-control-solid pe-10" placeholder="Pick date range" id="range" name="range" wire:model="range" />
                        <i class="bi bi-calendar3 position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                    </div>
                    @if(Auth::user()->roles->pluck('name')->first() == 'admin')

                    <div class="" wire:ignore>
                        <select class="form-select" data-control="select2" data-placeholder="Cari Organisasi" wire:model="cariIdOrganisasi" onchange="@this.set('searchIdOrganisasi', this.value)" data-allow-clear="true">
                            <option></option>
                            @foreach($organisasi as $key => $item)
                            <option value="{{ $item->id_organisasi }}">{{ $item->nama_organisasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                <div class="table-responsive main" id="table-responsive">
                    <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>No</th>
                                @if(Auth::user()->roles->pluck('name')->first() == 'admin')
                                <th>Organisasi</td>
                                    @endif
                                <th>Bank</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Jenis Transaksi</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) < 1) <tr>
                                <td colspan="7" class="text-center">Tidak Ada Data</td>
                                </tr>
                                @else
                                @foreach ($data as $index => $transaksi)
                                <tr wire:key="transaksi-{{ $transaksi->id_transaksi }}">
                                    <td>{{ $index + 1 }}</td>
                                    @if(Auth::user()->roles->pluck('name')->first() == 'admin')
                                    <td>{{ $transaksi->bank->organisasi->nama_organisasi }}</td>
                                    @endif
                                    <td>
                                        {{ ($transaksi->bank->nama_bank ?? '-') . ' - ' . ($transaksi->bank->atas_nama ?? '-') }}
                                    </td>
                                    <td>Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $transaksi->keterangan }}</td>
                                    <td>
                                        <div class="badge badge-light-{{ $transaksi->jenis_transaksi == 'pemasukan' ? 'success' : 'danger' }}">
                                            {{ ucfirst($transaksi->jenis_transaksi) }}
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->timezone('Asia/Singapore')->format('d M Y H:i') }}</td>
                                </tr>
                                @endforeach
                                @endif
                        </tbody>
                    </table>
                    {{-- <div class="mt-4 d-flex justify-content-center">
                    {{ $data->onEachSide(1)->links() }}
                </div> --}}
            </div>

            {{-- @include('livewire.pages.admin.masterdata.transaksi.modal') --}}
        </div>

    </div>
</div>
</div>
@push('scripts')
<script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        var table = document.getElementById("table-responsive");
        var wb = XLSX.utils.table_to_book(table, {
            sheet: "Laporan Keuangan"
        });


        var ws = wb.Sheets["Laporan Keuangan"];
        var cols = [];
        var range = XLSX.utils.decode_range(ws["!ref"]);
        for (var C = range.s.c; C <= range.e.c; ++C) {
            var maxWidth = 10;
            for (var R = range.s.r; R <= range.e.r; ++R) {
                var cell = ws[XLSX.utils.encode_cell({
                    r: R
                    , c: C
                })];
                if (cell && cell.v) {
                    maxWidth = Math.max(maxWidth, cell.v.toString().length);
                }
            }
            cols.push({
                wch: maxWidth
            });
        }
        ws["!cols"] = cols;


        for (var R = range.s.r; R <= range.e.r; ++R) {
            for (var C = range.s.c; C <= range.e.c; ++C) {
                var cellAddress = XLSX.utils.encode_cell({
                    r: R
                    , c: C
                });
                if (!ws[cellAddress]) continue;
                if (!ws[cellAddress].s) ws[cellAddress].s = {};
                ws[cellAddress].s.alignment = {
                    horizontal: "center"
                    , vertical: "center"
                };
            }
        }

        var dateRange = document.getElementById("range").value || "All Dates";
        XLSX.writeFile(wb, `Laporan Keuangan - ${dateRange}.xlsx`);
    }
    $(function() {
        $("#range").daterangepicker();
        $("#range").on("apply.daterangepicker", function(event, picker) {
            $(this).val(
                picker.startDate.format("YYYY-MM-DD") +
                " - " +
                picker.endDate.format("YYYY-MM-DD")
            );
            Livewire.dispatch('loadData', {
                startDate: picker.startDate.format("YYYY-MM-DD")
                , endDate: picker.endDate.format("YYYY-MM-DD")
            });
        });

        Livewire.on('show-modal', () => {
            var modalEl = document.getElementById('transaksiModal');
            var existingModal = bootstrap.Modal.getInstance(modalEl);
            if (!existingModal) {
                var myModal = new bootstrap.Modal(modalEl, {});
                myModal.show();
                console.log('modal');

            } else {
                existingModal.show();
            }
        });
        Livewire.on('hide-modal', () => {
            var modalEl = document.getElementById('transaksiModal');
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
                    Livewire.dispatch('deleteTransaksi');
                } else {
                    Swal.fire("Cancelled", "Delete Cancelled.", "info");
                }
            });
        });


    });

    function printMainContent() {
        var printContents = document.querySelector('.main').cloneNode(true);
        var originalContents = document.body.innerHTML;


        printContents.querySelectorAll('.action').forEach(el => el.remove());

        document.body.innerHTML = printContents.innerHTML;
        document.title = "Cashflow Report";
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }

</script>
@endpush
