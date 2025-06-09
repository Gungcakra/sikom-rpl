<x-slot:title>Dashboard</x-slot:title>

<div class="flex container flex-col">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary" wire:navigate>Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    {{-- <li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<!--end::Item-->
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">Dashboards</li> --}}
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->

            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl" style="min-height: 100vh">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">



                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #3E97FF;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #3E97FF">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-3hx text-white fw-bold me-6">{{ count($totalAnggotaOrganisasi) }}</span>
                                {{-- <div class="fw-bold fs-6 text-white">
									<span class="d-block">Outbound</span>
									<span class="">Calls</span>
								</div> --}}
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">Total Anggota</span>
                                {{-- <span class="opacity-50">Service</span> --}}
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <div class="col-xl-4">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #3E97FF;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #3E97FF">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-3hx text-white fw-bold me-6">{{ $totalKegiatan }}</span>
                                {{-- <div class="fw-bold fs-6 text-white">
									<span class="d-block">Outbound</span>
									<span class="">Calls</span>
								</div> --}}
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">Total Kegiatan</span>
                                {{-- <span class="opacity-50">Service</span> --}}
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--end::Col-->
                <div class="col-xl-4">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #3E97FF;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #3E97FF">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-3hx text-white fw-bold me-6">{{ $totalSaldo }}</span>
                                {{-- <div class="fw-bold fs-6 text-white">
									<span class="d-block">Outbound</span>
									<span class="">Calls</span>
								</div> --}}
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">Total Saldo</span>
                                {{-- <span class="opacity-50">Service</span> --}}
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                {{-- <div class="col-xl-6">
                    <!--begin::Chart widget 36-->
                    <div class="card card-flush overflow-hidden h-lg-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Performance</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6"> today</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div class="btn btn-sm btn-light d-flex align-items-center px-4" onchange="loadData()">
									<!--begin::Display range-->
									<div class="text-gray-600 fw-bold">Loading date range...</div>
									<!--end::Display range-->
									<i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
										<span class="path4"></span>
										<span class="path5"></span>
										<span class="path6"></span>
									</i>
								</div>
                                <input type="text" class="btn btn-sm btn-light d-flex align-items-center px-4" id="range">
                                <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end p-0">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_36" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>

                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 36-->
                </div> --}}
                <!--end::Col-->
            </div>

            <!--end::Row-->
            {{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                @forelse($pengumumanSaya as $pengumuman)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card shadow-sm border-0 h-100" style="border-radius: 1rem;">
                            <div class="card-body d-flex flex-column justify-content-between" style="background: #fff; border-radius: 1rem;">
                                <span class="badge bg-light text-primary mb-2">{{ \Carbon\Carbon::parse($pengumuman->tanggal_post)->format('d M Y') }}</span>
            <h4 class="fw-bold text-dark mb-2">{{ $pengumuman->judul }}</h4>
            <p class="text-gray-700 mb-0" style="min-height: 60px;">{{ Str::limit($pengumuman->isi, 100) }}</p>
            <span class="text-muted fs-7 mt-3">Diposting: {{ \Carbon\Carbon::parse($pengumuman->created_at)->diffForHumans() }} {{ $pengumuman->organisasi->nama_organisasi }}</span>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="alert alert-info text-center mb-0">
        Belum ada pengumuman.
    </div>
</div>
@endforelse
</div> --}}
{{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!-- Organisasi Diikuti -->
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title fw-bold text-dark">Organisasi Diikuti</h3>
                        </div>
                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table class="table table-row-dashed align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="fw-bold text-gray-400">
                                            <th class="min-w-150px">Nama Organisasi</th>
                                            
                                            <th class="min-w-100px">Bergabung Sejak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($organisasiDiikuti as $org)
                                            <tr>
                                                <td>{{ $org->organisasi->nama_organisasi ?? '-' }}</td>

<td>{{ \Carbon\Carbon::parse($org->pivot->created_at ?? $org->created_at)->format('d M Y') }}</td>
</tr>
@empty
<tr>
    <td colspan="3" class="text-center text-muted">Belum mengikuti organisasi.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- Kegiatan Diikuti -->
<div class="col-xl-6">
    <div class="card card-flush h-100">
        <div class="card-header pt-5">
            <h3 class="card-title fw-bold text-dark">Kegiatan Diikuti</h3>
        </div>
        <div class="card-body pt-3">
            <div class="table-responsive">
                <table class="table table-row-dashed align-middle gs-0 gy-3">
                    <thead>
                        <tr class="fw-bold text-gray-400">
                            <th class="min-w-150px">Nama Kegiatan</th>
                            <th class="min-w-100px">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatanSaya as $kegiatan)
                        <tr>
                            <td>{{ $kegiatan->kegiatan->nama_kegiatan ?? '-' }}</td>

                            <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai ?? $kegiatan->created_at)->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum mengikuti kegiatan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div> --}}
<!--begin::Row-->
{{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Card widget 19-->
					<div class="card card-flush h-lg-100">
						<!--begin::Header-->
						<div class="card-header pt-5">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-dark">Performance</span>
								<span class="text-gray-400 mt-1 fw-semibold fs-6">1,046 Inbound Calls today</span>
							</h3>
							<!--end::Title-->
							<!--begin::Toolbar-->
							<div class="card-toolbar">
								<!--begin::Label-->
								<span class="badge badge-light-danger fs-base mt-n3">
								<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
									<span class="path1"></span>
									<span class="path2"></span>
								</i>7.4%</span>
								<!--end::Label-->
							</div>
							<!--end::Toolbar-->
						</div>
						<!--end::Header-->
						<!--begin::Card body-->
						<div class="card-body d-flex align-items-end pt-6">
							<!--begin::Row-->
							<div class="row align-items-center mx-0 w-100">
								<!--begin::Col-->
								<div class="col-7 px-0">
									<!--begin::Labels-->
									<div class="d-flex flex-column content-justify-center">
										<!--begin::Label-->
										<div class="d-flex fs-6 fw-semibold align-items-center">
											<!--begin::Bullet-->
											<div class="bullet bg-success me-3" style="border-radius: 3px;width: 12px;height: 12px"></div>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="fs-5 fw-bold text-gray-600 me-5">CRM Team Performance:</div>
											<!--end::Label-->
											<!--begin::Stats-->
											<div class="ms-auto fw-bolder text-gray-700 text-end">72.56%</div>
											<!--end::Stats-->
										</div>
										<!--end::Label-->
										<!--begin::Label-->
										<div class="d-flex fs-6 fw-semibold align-items-center my-4">
											<!--begin::Bullet-->
											<div class="bullet bg-primary me-3" style="border-radius: 3px;width: 12px;height: 12px"></div>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="fs-5 fw-bold text-gray-600 me-5">Recurring Calls:</div>
											<!--end::Label-->
											<!--begin::Stats-->
											<div class="ms-auto fw-bolder text-gray-700 text-end">29.34%</div>
											<!--end::Stats-->
										</div>
										<!--end::Label-->
										<!--begin::Label-->
										<div class="d-flex fs-6 fw-semibold align-items-center">
											<!--begin::Bullet-->
											<div class="bullet me-3" style="border-radius: 3px;background-color: #E4E6EF;width: 12px;height: 12px"></div>
											<!--end::Bullet-->
											<!--begin::Label-->
											<div class="fs-5 fw-bold text-gray-600 me-5">Tickets Raised:</div>
											<!--end::Label-->
											<!--begin::Stats-->
											<div class="ms-auto fw-bolder text-gray-700 text-end">17.83%</div>
											<!--end::Stats-->
										</div>
										<!--end::Label-->
									</div>
									<!--end::Labels-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-5 d-flex justify-content-end px-0">
									<!--begin::Chart-->
									<div id="kt_card_widget_19_chart" class="min-h-auto h-150px w-150px" data-kt-size="150" data-kt-line="25"></div>
									<!--end::Chart-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card widget 19-->
				</div>
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-xl-6">
					<!--begin::Engage widget 9-->
					<div class="card h-lg-100" style="background: linear-gradient(112.14deg, #FF8A00 0%, #E96922 100%)">
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Row-->
							<div class="row align-items-center">
								<!--begin::Col-->
								<div class="col-sm-7 pe-0 mb-5 mb-sm-0">
									<!--begin::Wrapper-->
									<div class="d-flex justify-content-between h-100 flex-column pt-xl-5 pb-xl-2 ps-xl-7">
										<!--begin::Container-->
										<div class="mb-7">
											<!--begin::Title-->
											<div class="mb-6">
												<h3 class="fs-2x fw-semibold text-white">Upgrade Your Plan</h3>
												<span class="fw-semibold text-white opacity-75">Flat cartoony and illustrations with vivid color</span>
											</div>
											<!--end::Title-->
											<!--begin::Items-->
											<div class="d-flex align-items-center flex-wrap d-grid gap-2">
												<!--begin::Item-->
												<div class="d-flex align-items-center me-5 me-xl-13">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px symbol-circle me-3">
														<span class="symbol-label" style="background: rgba(255, 255, 255, 0.15);">
															<i class="ki-duotone ki-abstract-41 fs-4 text-white">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>
													</div>
													<!--end::Symbol-->
													<!--begin::Info-->
													<div class="m-0">
														<a href="../../demo1/dist/pages/user-profile/projects.html" class="text-white text-opacity-75 fs-8">Projects</a>
														<span class="fw-bold text-white fs-7 d-block">Up to 500</span>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Item-->
												<!--begin::Item-->
												<div class="d-flex align-items-center">
													<!--begin::Symbol-->
													<div class="symbol symbol-30px symbol-circle me-3">
														<span class="symbol-label" style="background: rgba(255, 255, 255, 0.15);">
															<i class="ki-duotone ki-abstract-26 fs-4 text-white">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>
														</span>
													</div>
													<!--end::Symbol-->
													<!--begin::Info-->
													<div class="m-0">
														<a href="../../demo1/dist/apps/user-management/users/list.html" class="text-white text-opacity-75 fs-8">Tasks</a>
														<span class="fw-bold text-white fs-7 d-block">Unlimited</span>
													</div>
													<!--end::Info-->
												</div>
												<!--end::Item-->
											</div>
											<!--end::Items-->
										</div>
										<!--end::Container-->
										<!--begin::Action-->
										<div class="m-0">
											<a href="#" class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Upgrade Plan</a>
										</div>
										<!--begin::Action-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--begin::Col-->
								<!--begin::Col-->
								<div class="col-sm-5">
									<!--begin::Illustration-->
									<img src="assets/media/svg/illustrations/easy/7.svg" class="h-200px h-lg-250px my-n6" alt="" />
									<!--end::Illustration-->
								</div>
								<!--begin::Col-->
							</div>
							<!--begin::Row-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Engage widget 9-->
				</div>
				<!--end::Col-->
			</div> --}}
<!--end::Row-->
<!--begin::Row-->
{{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Chart Widget 37-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-6">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Currency-->
                                    <span class="fs-3 fw-semibold text-gray-400 align-self-start me-1">$</span>
                                    <!--end::Currency-->
                                    <!--begin::Value-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">3,274.94</span>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>9.2%</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-400">Avg. Agent Earnings</span>
                                <!--end::Description-->
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                    <i class="ki-duotone ki-dots-square fs-1 text-gray-400 me-n1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </button>
                                <!--begin::Menu 2-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Ticket</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Customer</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                        <!--begin::Menu item-->
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">New Group</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--end::Menu item-->
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Admin Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Staff Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Member Group</a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">New Contact</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu separator-->
                                    <div class="separator mt-3 opacity-75"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3 py-3">
                                            <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 2-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0 px-0">
                            <!--begin::Nav-->
                            <ul class="nav d-flex justify-content-between mb-3 mx-9">
                                <!--begin::Item-->
                                <li class="nav-item mb-3">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-info btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px active" data-bs-toggle="tab" id="kt_charts_widget_37_tab_1" href="#kt_charts_widget_37_tab_content_1">1d</a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-info btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_37_tab_2" href="#kt_charts_widget_37_tab_content_2">5d</a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-info btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_37_tab_3" href="#kt_charts_widget_37_tab_content_3">1m</a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-info btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_37_tab_4" href="#kt_charts_widget_37_tab_content_4">6m</a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-flex flex-center btn-active-info btn-color-gray-600 btn-active-color-white rounded-2 w-45px h-35px" data-bs-toggle="tab" id="kt_charts_widget_37_tab_5" href="#kt_charts_widget_37_tab_content_5">1y</a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content mt-n6">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_charts_widget_37_tab_content_1">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_37_chart_1" data-kt-chart-color="danger" class="min-h-auto h-200px ps-3 pe-6"></div>
                                    <!--end::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="min-w-100px"></th>
                                                    <th class="min-w-100px text-end pe-0"></th>
                                                    <th class="text-end min-w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-danger">-139.34</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">3:10 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$3,207.03</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-success">+576.24</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">3:55 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$3,274.94</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-success">+124.03</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_37_tab_content_2">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_37_chart_2" data-kt-chart-color="danger" class="min-h-auto h-200px ps-3 pe-6"></div>
                                    <!--end::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="min-w-100px"></th>
                                                    <th class="min-w-100px text-end pe-0"></th>
                                                    <th class="text-end min-w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-success">+231.01</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-primary">+233.07</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,145.55</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-danger">+134.06</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_37_tab_content_3">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_37_chart_3" data-kt-chart-color="danger" class="min-h-auto h-200px ps-3 pe-6"></div>
                                    <!--end::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="min-w-100px"></th>
                                                    <th class="min-w-100px text-end pe-0"></th>
                                                    <th class="text-end min-w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">12:40 AM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,346.25</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-warning">+134.57</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">11:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$1,565.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-danger">+155.03</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">4:25 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-success">+124.03</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_37_tab_content_4">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_37_chart_4" data-kt-chart-color="danger" class="min-h-auto h-200px ps-3 pe-6"></div>
                                    <!--end::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="min-w-100px"></th>
                                                    <th class="min-w-100px text-end pe-0"></th>
                                                    <th class="text-end min-w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">3:20 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$3,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-danger">+234.03</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">10:30 AM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$1,474.04</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-info">-134.03</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">1:30 AM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-primary">+124.03</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_charts_widget_37_tab_content_5">
                                    <!--begin::Chart-->
                                    <div id="kt_charts_widget_37_chart_5" data-kt-chart-color="danger" class="min-h-auto h-200px ps-3 pe-6"></div>
                                    <!--end::Chart-->
                                    <!--begin::Table container-->
                                    <div class="table-responsive mx-9 mt-n6">
                                        <!--begin::Table-->
                                        <table class="table align-middle gs-0 gy-4">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr>
                                                    <th class="min-w-100px"></th>
                                                    <th class="min-w-100px text-end pe-0"></th>
                                                    <th class="text-end min-w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">3:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$1,756.25</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-primary">+144.04</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">2:30 PM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,756.26</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-danger">+124.03</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 fw-bold fs-6">12:30 AM</a>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="text-gray-800 fw-bold fs-6 me-1">$2,034.65</span>
                                                    </td>
                                                    <td class="pe-0 text-end">
                                                        <span class="fw-bold fs-6 text-success">+184.05</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart Widget 37-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Table widget 15-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Projects Stats</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-light d-flex align-items-center px-4">
                                    <!--begin::Display range-->
                                    <div class="text-gray-600 fw-bold">Loading date range...</div>
                                    <!--end::Display range-->
                                    <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                </div>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                            <th class="p-0 pb-3 min-w-175px text-start">ITEM</th>
                                            <th class="p-0 pb-3 min-w-100px text-end">CALLS</th>
                                            <th class="p-0 pb-3 min-w-100px text-end">CRP RANK</th>
                                            <th class="p-0 pb-3 min-w-150px text-end pe-12">PROGRESS</th>
                                            <th class="p-0 pb-3 w-125px text-end pe-7">CHART</th>
                                            <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="assets/media/avatars/300-3.jpg" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Guy Hawkins</a>
                                                        <span class="text-gray-400 fw-semibold d-block fs-7">Haiti</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">245</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$78.34%</span>
                                            </td>
                                            <td class="text-end pe-12">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>9.2%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_15_chart_1" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="assets/media/avatars/300-10.jpg" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Jane Cooper</a>
                                                        <span class="text-gray-400 fw-semibold d-block fs-7">Monaco</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">725</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$63.83%</span>
                                            </td>
                                            <td class="text-end pe-12">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-danger fs-base">
                                                    <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>0.4%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_15_chart_2" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="assets/media/avatars/300-9.jpg" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Jacob Jones</a>
                                                        <span class="text-gray-400 fw-semibold d-block fs-7">Poland</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">173</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$92.56%</span>
                                            </td>
                                            <td class="text-end pe-12">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>9.2%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_15_chart_3" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="assets/media/avatars/300-2.jpg" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Esther Howard</a>
                                                        <span class="text-gray-400 fw-semibold d-block fs-7">Kiribatir</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">642</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$64.02%</span>
                                            </td>
                                            <td class="text-end pe-12">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-success fs-base">
                                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>9.2%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_15_chart_4" class="h-50px mt-n8 pe-7" data-kt-chart-color="success"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50px me-3">
                                                        <img src="assets/media/avatars/300-1.jpg" class="" alt="" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="../../demo1/dist/apps/projects/users.html" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Ralph Edwards</a>
                                                        <span class="text-gray-400 fw-semibold d-block fs-7">Iceland</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">329</span>
                                            </td>
                                            <td class="text-end pe-0">
                                                <span class="text-gray-600 fw-bold fs-6">$89.31%</span>
                                            </td>
                                            <td class="text-end pe-12">
                                                <!--begin::Label-->
                                                <span class="badge badge-light-danger fs-base">
                                                    <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>0.4%</span>
                                                <!--end::Label-->
                                            </td>
                                            <td class="text-end pe-0">
                                                <div id="kt_table_widget_15_chart_5" class="h-50px mt-n8 pe-7" data-kt-chart-color="danger"></div>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Table widget 15-->
                </div>
                <!--end::Col-->
            </div> --}}
<!--end::Row-->
<!--begin::Row-->
{{-- <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Calls by Departments</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">8k social visitors</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">PDF Report</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_31_chart" class="w-100 h-300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Maps widget 2-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Calls Geography</span>
                                <span class="text-gray-400 pt-2 fw-semibold fs-6">Updated 37 minutes ago</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="../../demo1/dist/apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">PDF Report</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-center">
                            <!--begin::Map container-->
                            <div id="kt_maps_widget_2_map" class="w-100 h-350px"></div>
                            <!--end::Map container-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Maps widget 2-->
                </div>
                <!--end::Col-->
            </div> --}}
<!--end::Row-->
</div>
<!--end::Content container-->
</div>

</div>
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function() {
        $('input[id="range"]').daterangepicker({
            opens: "left"
            , locale: {
                format: "MM/DD/YYYY"
            }
        });


        $("#range").on("apply.daterangepicker", function(event, picker) {
            $(this).val(
                picker.startDate.format("MM/DD/YYYY") +
                " - " +
                picker.endDate.format("MM/DD/YYYY")
            );
            Livewire.dispatch('loadData', {
                startDate: picker.startDate.format("YYYY-MM-DD")
                , endDate: picker.endDate.format("YYYY-MM-DD")
            });
        });


        $("#range").on("cancel.daterangepicker", function() {
            $(this).val('');
        });
    });




    // (function () {
    //     var e = document.getElementById("kt_charts_widget_3_chart");
    //     if (e) {
    //     var t = { self: null, rendered: false };

    //     var renderChart = function () {
    //         var chartHeight = parseInt(KTUtil.css(e, "height"));
    //         var gray500 = KTUtil.getCssVariableValue("--bs-gray-500");
    //         var gray200 = KTUtil.getCssVariableValue("--bs-gray-200");
    //         var infoColor = KTUtil.getCssVariableValue("--bs-info");

    //         var options = {
    //         series: [
    //             {
    //             name: "Monthly Service",
    //             data: window.incomeChartData.map(item => item.income),
    //             },
    //         ],
    //         chart: {
    //             fontFamily: "inherit",
    //             type: "area",
    //             height: chartHeight,
    //             toolbar: { show: false },
    //         },
    //         plotOptions: {},
    //         legend: { show: false },
    //         dataLabels: { enabled: false },
    //         fill: { type: "solid", opacity: 1 },
    //         stroke: {
    //             curve: "smooth",
    //             show: true,
    //             width: 3,
    //             colors: [infoColor],
    //         },
    //         xaxis: {
    //             categories: window.incomeChartData.map(item => item.hour),
    //             axisBorder: { show: false },
    //             axisTicks: { show: false },
    //             labels: {
    //             style: {
    //                 colors: gray500,
    //                 fontSize: "12px",
    //             },
    //             },
    //             crosshairs: {
    //             position: "front",
    //             stroke: {
    //                 color: infoColor,
    //                 width: 1,
    //                 dashArray: 3,
    //             },
    //             },
    //             tooltip: {
    //             enabled: true,
    //             offsetY: 0,
    //             style: { fontSize: "12px" },
    //             },
    //         },
    //         yaxis: {
    //             labels: {
    //             style: {
    //                 colors: gray500,
    //                 fontSize: "12px",
    //             },
    //             },
    //         },
    //         states: {
    //             normal: { filter: { type: "none", value: 0 } },
    //             hover: { filter: { type: "none", value: 0 } },
    //             active: {
    //             allowMultipleDataPointsSelection: false,
    //             filter: { type: "none", value: 0 },
    //             },
    //         },
    //         tooltip: {
    //             style: { fontSize: "12px" },
    //             y: {
    //             formatter: function (value) {
    //                 return "Rp " + value + "K";
    //             },
    //             },
    //         },
    //         colors: [
    //             KTUtil.getCssVariableValue("--bs-info-light"),
    //         ],
    //         grid: {
    //             borderColor: gray200,
    //             strokeDashArray: 4,
    //             yaxis: { lines: { show: true } },
    //         },
    //         markers: { strokeColor: infoColor, strokeWidth: 3 },
    //         };

    //         t.self = new ApexCharts(e, options);
    //         t.self.render();
    //         t.rendered = true;
    //     };

    //     renderChart();

    //     KTThemeMode.on("kt.thememode.change", function () {
    //         if (t.rendered) {
    //         t.self.destroy();
    //         }
    //         renderChart();
    //     });
    //     }
    // })();

</script>
@endpush
