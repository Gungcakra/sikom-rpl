<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Body-->
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
        <!--begin::Form-->
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <!--begin::Wrapper-->
            <div class="w-lg-500px p-10">
                <!--begin::Form-->
                {{-- <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"  action="#"> --}}
                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bolder mb-3">Registrasi</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    {{-- <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div> --}}
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
                <!--begin::Login options-->
                <div class="row g-3 mb-9">
                    <!--begin::Col-->
                    {{-- <div class="col-md-6">
                            <!--begin::Google link=-->
                            <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-15px me-3" />Sign in with Google</a>
                            <!--end::Google link=-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                            <!--begin::Google link=-->
                            <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                            <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show h-15px me-3" />
                            <img alt="Logo" src="assets/media/svg/brand-logos/apple-black-dark.svg" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
                            <!--end::Google link=-->
                        </div> --}}
                    <!--end::Col-->
                </div>
                <!--end::Login options-->
                <!--begin::Separator-->
                {{-- <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                    </div> --}}
                <!--end::Separator-->
                <!--begin::Input group=-->
                <div class="row">
                    <div class="col-md-6 mb-8">
                        <input type="text" placeholder="Nama" name="nama" autocomplete="off" class="form-control bg-transparent" wire:model="nama" />
                    </div>
                    <div class="col-md-6 mb-8">
                        <input type="text" placeholder="NIM" name="nim" autocomplete="off" class="form-control bg-transparent" wire:model="nim" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-8">
                        <input type="text" placeholder="No HP" name="no_hp" autocomplete="off" class="form-control bg-transparent" wire:model="no_hp" />
                    </div>
                    <div class="col-md-6 mb-8">
                        <input type="text" placeholder="Prodi" name="prodi" autocomplete="off" class="form-control bg-transparent" wire:model="prodi" />
                    </div>
                </div>
                <div class="mb-8" wire:ignore>
                    <select class="form-select" data-control="select2" data-placeholder="Pilih Organisasi" name="organisasi" wire:model="id_organisasi" onchange="@this.set('id_organisasi', Array.from(this.selectedOptions).map(option => option.value))" data-allow-clear="true" multiple="multiple">
                        <option value=""></option>
                        @foreach($organisasi as $org)
                        <option value="{{ $org->id_organisasi }}">{{ $org->nama_organisasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-8">
                        <input type="text" placeholder="Username" name="name" autocomplete="off" class="form-control bg-transparent" wire:model="name" />
                    </div>

                    <div class="col-md-6 mb-8">
                        <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" wire:model="email" />
                    </div>
                </div>
                <div class="mb-3">
                    <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" wire:model="password" />
                </div>
                <!--end::Input group=-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                    <div></div>
                    <!--begin::Link-->
                    {{-- <a href="../../demo1/dist/authentication/layouts/corporate/reset-password.html" class="link-primary">Forgot Password ?</a> --}}
                    <!--end::Link-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button id="kt_sign_in_submit" class="btn btn-primary" wire:click="register">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Registrasi</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">
                    {{-- <a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html" class="link-primary">Sign up</a> --}}
                </div>
                <!--end::Sign up-->
                {{-- </form> --}}
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Form-->
        <!--begin::Footer-->

        <!--end::Footer-->
    </div>
    <!--end::Body-->
    <!--begin::Aside-->
    <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/auth/stikom.png')}})">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
            <!--begin::Logo-->
            <a class="mb-0 mb-lg-12">
                {{-- <img alt="Logo" src="{{ asset('assets/media/logos/custom-1.png')}}" class="h-60px h-lg-75px" /> --}}
            </a>
            <!--end::Logo-->
            <!--begin::Image-->
            {{-- <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/media/misc/auth-screens.png')}}" alt="" /> --}}
            <!--end::Image-->
            <!--begin::Title-->
            {{-- <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1> --}}
            <!--end::Title-->
            <!--begin::Text-->
            {{-- <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a>introduces a person they’ve interviewed
            <br />and provides some background information about
            <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>and their
            <br />work following this is a transcript of the interview.</div> --}}
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Aside-->

</div>
