@extends('layouts.app')
@push('css')
@endpush
@push('js')
@endpush
@section('content')
		<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100 mb-3">
				<!--begin::Page title-->
				<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
						<!--begin::Title-->
						<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Paket Layanan
						</h1>
						<!--end::Title-->
						<!--begin::Breadcrumb-->
						<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
								<!--begin::Item-->
								<li class="breadcrumb-item text-muted">
										<a href="index.html" class="text-muted text-hover-primary">Langganan</a>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="breadcrumb-item">
										<span class="bullet bg-gray-500 w-5px h-2px"></span>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="breadcrumb-item text-muted">Paket Layanan</li>
								<!--end::Item-->
						</ul>
						<!--end::Breadcrumb-->
				</div>
				<!--end::Page title-->
		</div>

		<!--begin::Pricing card-->
		<div class="card" id="kt_pricing">
			<!--begin::Card body-->
			<div class="card-body p-lg-17">
				<!--begin::Plans-->
				<div class="d-flex flex-column">
					<!--begin::Heading-->
					<div class="mb-13 text-center">
						<h1 class="fs-2hx fw-bold mb-5">Pilih Paket Layanan Anda</h1>
						<div class="text-gray-600 fw-semibold fs-5">Jika anda membutuhkan informasi lebih lanjut, hubungi kami di
						<a href="https://wa.me/6289506373551" class="link-primary fw-bold">Customer Support</a>.</div>
					</div>
					<!--end::Heading-->
					<!--begin::Nav group-->
					<div class="nav-group nav-group-outline mx-auto mb-15 d-none" data-kt-buttons="true">
						<button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3 me-2 active" data-kt-plan="month">Monthly</button>
						<button class="btn btn-color-gray-600 btn-active btn-active-secondary px-6 py-3" data-kt-plan="annual">Annual</button>
					</div>
					<!--end::Nav group-->
					<!--begin::Row-->
					<div class="row g-10">
						<!--begin::Col-->
						<div class="col-xl-4">
							<div class="d-flex h-100 align-items-center">
								<!--begin::Option-->
								<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
									<!--begin::Heading-->
									<div class="mb-7 text-center">
										<!--begin::Title-->
										<h1 class="text-gray-900 mb-5 fw-bolder">Uji Coba</h1>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="text-gray-600 fw-semibold mb-5">Coba gratis layanan kami
										<br />selama 1 bulan</div>
										<!--end::Description-->
										<!--begin::Price-->
										<div class="text-center">
											<span class="mb-2 text-primary">Rp.</span>
											<span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="0" data-kt-plan-price-annual="0">0</span>
											<span class="fs-7 fw-semibold opacity-50">/ 
											<span data-kt-element="period">Bulan</span></span>
										</div>
										<!--end::Price-->
									</div>
									<!--end::Heading-->
									<!--begin::Features-->
									<div class="w-100 mb-10">
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Face Recognition 300 Pengguna</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Scan Barcode 300 Pengguna</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Harian</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Kelas (barcode)</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Rekap Presensi</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Download Laporan (excel)</span>
											<i class="ki-outline ki-cross-circle fs-1"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Notifikasi Whatsapp</span>
											<i class="ki-outline ki-cross-circle fs-1"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-600 flex-grow-1">Open API</span>
											<i class="ki-outline ki-cross-circle fs-1"></i>
										</div>
										<!--end::Item-->
									</div>
									<!--end::Features-->
									<!--begin::Select-->
									<a href="#" class="btn btn-sm btn-primary">Pilih Paket</a>
									<!--end::Select-->
								</div>
								<!--end::Option-->
							</div>
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-xl-4">
							<div class="d-flex h-100 align-items-center">
								<!--begin::Option-->
								<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-20 px-10">
									<!--begin::Heading-->
									<div class="mb-7 text-center">
										<!--begin::Title-->
										<h1 class="text-gray-900 mb-5 fw-bolder">Paket Smart</h1>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="text-gray-600 fw-semibold mb-5">Aktifkan paket anda
										<br />lebih cepat disini</div>
										<!--end::Description-->
										<!--begin::Price-->
										<div class="text-center">
											<span class="mb-2 text-primary">Rp.</span>
											<span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="339" data-kt-plan-price-annual="3399">300k</span>
											<span class="fs-7 fw-semibold opacity-50">/ 
											<span data-kt-element="period">Bulan</span></span>
										</div>
										<!--end::Price-->
									</div>
									<!--end::Heading-->
									<!--begin::Features-->
									<div class="w-100 mb-10">
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Face Recognition 100 Pengguna</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Scan Barcode 100 Pengguna</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Harian</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Kelas (barcode)</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Rekap Presensi</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Download Laporan (Excel)</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Notifikasi Whatsapp</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Open API</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
									</div>
									<!--end::Features-->
									<!--begin::Select-->
									<a href="{{ url('payment/package/2') }}" class="btn btn-sm btn-primary">Pilih Paket</a>
									<!--end::Select-->
								</div>
								<!--end::Option-->
							</div>
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-xl-4">
							<div class="d-flex h-100 align-items-center">
								<!--begin::Option-->
								<div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
									<!--begin::Heading-->
									<div class="mb-7 text-center">
										<!--begin::Title-->
										<h1 class="text-gray-900 mb-5 fw-bolder">Paket Custom</h1>
										<!--end::Title-->
										<!--begin::Description-->
										<div class="text-gray-600 fw-semibold mb-5">Bayar sesuai kebutuhan
										<br />sekolah anda (lebih murah)</div>
										<!--end::Description-->
										<!--begin::Price-->
										<div class="text-center">
											<span class="mb-2 text-primary">Rp.</span>
											<span class="fs-3x fw-bold text-primary" data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">?</span>
											<span class="fs-7 fw-semibold opacity-50">/ 
											<span data-kt-element="period">Bulan</span></span>
										</div>
										<!--end::Price-->
									</div>
									<!--end::Heading-->
									<!--begin::Features-->
									<div class="w-100 mb-10">
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">- Face Recognition Rp. 2.5k/pengguna</span>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">- Free Presensi dengan Barcode</span>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Harian</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Presensi Kelas (barcode)</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Rekap Presensi</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Download Laporan (Excel)</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1 pe-3">Notifikasi Whatsapp</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
										<!--begin::Item-->
										<div class="d-flex align-items-center mb-5">
											<span class="fw-semibold fs-6 text-gray-800 flex-grow-1">Open API</span>
											<i class="ki-outline ki-check-circle fs-1 text-success"></i>
										</div>
										<!--end::Item-->
									</div>
									<!--end::Features-->
									<!--begin::Select-->
									<a href="https://wa.me/6289506373551" class="btn btn-sm btn-primary">Hubungi Kami</a>
									<!--end::Select-->
								</div>
								<!--end::Option-->
							</div>
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
				</div>
				<!--end::Plans-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Pricing card-->
@endsection
