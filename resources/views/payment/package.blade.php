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
						<h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Pembayaran
						</h1>
						<!--end::Title-->
						<!--begin::Breadcrumb-->
						<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
								<!--begin::Item-->
								<li class="breadcrumb-item text-muted">
										<a href="index.html" class="text-muted text-hover-primary">Pembayaran</a>
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

		<div class="card mb-5 mb-xl-10">
      <!--begin::Card body-->
      <div class="card-body">
        <!--begin::Notice-->
        <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-12 p-6">
          <!--begin::Icon-->
          <i class="ki-outline ki-information fs-2tx text-info me-4"></i>
          <!--end::Icon-->
          <!--begin::Wrapper-->
          <div class="d-flex flex-stack flex-grow-1">
            <!--begin::Content-->
            <div class="fw-semibold">
              <h4 class="text-gray-900 fw-bold">{{ $package->name }}</h4>
              <div class="fs-6 text-gray-700">Rp {{ number_format($package->bundling_price, 0, ',', '.') }} / 30 Hari</div>
            </div>
            <!--end::Content-->
          </div>
          <!--end::Wrapper-->
        </div>
        <!--end::Notice-->
      </div>
      <!--end::Card body-->
    </div>

    <div class="card mb-5 mb-xl-10">
      <!--begin::Card header-->
      <div class="card-header card-header-stretch pb-0">
        <!--begin::Title-->
        <div class="card-title">
          <h3 class="m-0">Payment Methods</h3>
        </div>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar m-0">
          <!--begin::Tab nav-->
          <ul class="nav nav-stretch nav-line-tabs border-transparent" role="tablist">
            @foreach($groups as $key => $channel)
            <!--begin::Tab item-->
            <li class="nav-item" role="presentation">
              <a id="kt_billing_{{ Str::slug($key, '_'); }}_tab" class="nav-link fs-5 fw-bold me-5 @if($key == "Virtual Account") active @endif" data-bs-toggle="tab" role="tab" href="#kt_billing_{{ Str::slug($key, '_'); }}" aria-selected="true">{{ $key }}</a>
            </li>
            <!--end::Tab item-->
            @endforeach
          </ul>
          <!--end::Tab nav-->
        </div>
        <!--end::Toolbar-->
      </div>
      <!--end::Card header-->
      <!--begin::Tab content-->
      <div id="kt_billing_payment_tab_content" class="card-body tab-content">
        <!--begin::Tab panel-->
        @foreach($groups as $key => $channels)
        <div id="kt_billing_{{ Str::slug($key, '_'); }}" class="tab-pane fade show @if($key == "Virtual Account") active @endif" role="tabpanel" aria-labelledby="kt_billing_{{ Str::slug($key, '_'); }}_tab">
          <!--begin::Title-->
          <h3 class="mb-5">Pilih Metode Pembayaran</h3>
          <!--end::Title-->
          <!--begin::Row-->
          <div class="row gx-9 gy-6">
            @foreach($channels as $channel)
            <!--begin::Col-->
            <div class="col-xl-6" data-kt-billing-element="card">
              <!--begin::Card-->
              <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                <!--begin::Info-->
                <div class="d-flex flex-column py-2">
                  <!--begin::Owner-->
                  <div class="d-flex align-items-center fs-4 fw-bold mb-5">{{ $channel['name'] }}
                  <span class="badge badge-light-success fs-7 ms-2">{{ $channel['code'] }}</span></div>
                  <!--end::Owner-->
                  <!--begin::Wrapper-->
                  <div class="d-flex align-items-center">
                    <!--begin::Icon-->
                    <img src="{{ $channel['icon_url'] }}" width="120px" alt="{{ $channel['name'] }}" class="me-4">
                    <!--end::Icon-->
                    <!--begin::Details-->
                    <div>
                      <div class="fs-4 fw-bold">Total Pembayaran: Rp {{ number_format($package->bundling_price + ($channel['total_fee']['flat'] == 0 ? ($package->bundling_price * $channel['total_fee']['percent'] / 100) : $channel['total_fee']['flat']), 0, ',', '.') }}</div>
                      <div class="fs-6 fw-semibold text-gray-500">+ Fee: @if($channel['total_fee']['flat'] == 0) {{ $channel['total_fee']['percent'] }}% @else Rp {{ number_format($channel['total_fee']['flat'], 0, ',', '.') }} @endif</div>
                    </div>
                    <!--end::Details-->
                  </div>
                  <!--end::Wrapper-->
                </div>
                <!--end::Info-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center py-2">
                  <form action="{{ url('billing-invoice/register-package') }}" method="POST">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">
                    <input type="hidden" name="channel" value="{{ $channel['code'] }}">
                    <button class="btn btn-sm btn-primary btn-active-primary-primary">Pilih</button>
                  </form>
                </div>
                <!--end::Actions-->
              </div>
              <!--end::Card-->
            </div>
            <!--end::Col-->
            @endforeach
          </div>
          <!--end::Row-->
        </div>
        @endforeach
        <!--end::Tab panel-->
      </div>
      <!--end::Tab content-->
    </div>
@endsection
