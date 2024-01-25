<!--begin::Invoice 2 main-->
<div class="card">
  <!--begin::Body-->
  <div class="card-body p-lg-20">
    <!--begin::Layout-->
    <div class="d-flex flex-column flex-xl-row">
      <!--begin::Content-->
      <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
        <!--begin::Invoice 2 content-->
        <div class="mt-n1">
          <!--begin::Top-->
          <div class="d-flex flex-stack pb-10">
            <!--begin::Logo-->
            <a href="#">
              <img alt="Logo" src="{{ asset('assets/media/logos/logo-hadir-aja.png') }}" style="width: 150px" />
            </a>
            <!--end::Logo-->
            @if($billing->status === 'pending')
            <!--begin::Action-->
            <a href="#" class="btn btn-sm btn-success">Pay Now</a>
            <!--end::Action-->
            @endif
          </div>
          <!--end::Top-->
          <!--begin::Wrapper-->
          <div class="m-0">
            <!--begin::Label-->
            <div class="fw-bold fs-3 text-gray-800 mb-8">Invoice #{{ $billing->billing_code }}</div>
            <!--end::Label-->
            <!--begin::Row-->
            <div class="row g-5 mb-11">
              <!--end::Col-->
              <div class="col-sm-6">
                <!--end::Label-->
                <div class="fw-semibold fs-7 text-gray-600 mb-1">Issue Date:</div>
                <!--end::Label-->
                <!--end::Col-->
                <div class="fw-bold fs-6 text-gray-800">{{ $billing->issue_date->format('d M Y') }}</div>
                <!--end::Col-->
              </div>
              <!--end::Col-->
              <!--end::Col-->
              <div class="col-sm-6">
                <!--end::Label-->
                <div class="fw-semibold fs-7 text-gray-600 mb-1">Due Date:</div>
                <!--end::Label-->
                <!--end::Info-->
                <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                  <span class="pe-2">{{ $billing->due_date->format('d M Y') }}</span>
                  <span class="fs-7 text-danger d-flex align-items-center">
                    <span class="bullet bullet-dot bg-danger me-2"></span>Due in {{ $billing->due_date->diff(\Carbon\Carbon::now())->days }} days</span>
                </div>
                <!--end::Info-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 mb-12">
              <!--end::Col-->
              <div class="col-sm-6">
                <!--end::Label-->
                <div class="fw-semibold fs-7 text-gray-600 mb-1">Issue For:</div>
                <!--end::Label-->
                <!--end::Text-->
                <div class="fw-bold fs-6 text-gray-800">{{ $billing->school->school_name }}.</div>
                <!--end::Text-->
                <!--end::Description-->
                <div class="fw-semibold fs-7 text-gray-600">{{ $billing->school->pic_name }}</div>
                <div class="fw-semibold fs-7 text-gray-600">{{ $billing->school->school_address }}</div>
                <!--end::Description-->
              </div>
              <!--end::Col-->
              <!--end::Col-->
              <div class="col-sm-6">
                <!--end::Label-->
                <div class="fw-semibold fs-7 text-gray-600 mb-1">Issued By:</div>
                <!--end::Label-->
                <!--end::Text-->
                <div class="fw-bold fs-6 text-gray-800">HadirAja Corp.</div>
                <!--end::Text-->
                <!--end::Description-->
                <div class="fw-semibold fs-7 text-gray-600">Jl. Nangka No. 25A
                  <br />Banyumanik, Semarang
                </div>
                <!--end::Description-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Content-->
            <div class="flex-grow-1">
              <!--begin::Table-->
              <div class="table-responsive border-bottom mb-9">
                <table class="table mb-3">
                  <thead>
                    <tr class="border-bottom fs-6 fw-bold text-muted">
                      <th class="min-w-175px pb-2">Description</th>
                      <th class="min-w-70px text-end pb-2">Duration</th>
                      <th class="min-w-80px text-end pb-2">User</th>
                      <th class="min-w-100px text-end pb-2">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="fw-bold text-gray-700 fs-5 text-end">
                      <td class="d-flex align-items-center pt-6">
                        <i class="fa fa-genderless text-danger fs-2 me-2"></i>{{ $billing->package->name }} ({{ $billing->start_date->format('d/m/Y') }} - {{ $billing->end_date->format('d/m/Y') }})
                      </td>
                      <td class="pt-6">{{ $billing->payment_duration }} Bulan</td>
                      <td class="pt-6">-</td>
                      <td class="pt-6 text-gray-900 fw-bolder">Rp. {{ number_format($billing->price, '2') }}</td>
                    </tr>

                    @foreach ($billing->quotas as $item)
                    <tr class="fw-bold text-gray-700 fs-5 text-end">
                      <td class="d-flex align-items-center">
                        <i style="width: 2rem;"></i> - {{ $item->service->name }}
                      </td>
                      <td></td>
                      <td>{{ $item->user_count }}</td>
                      <td class="fs-5 text-gray-900 fw-bolder">-</td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <!--end::Table-->
              <!--begin::Container-->
              <div class="d-flex justify-content-end">
                <!--begin::Section-->
                <div class="mw-300px">
                  <!--begin::Item-->
                  <div class="d-flex flex-stack mb-3">
                    <!--begin::Accountname-->
                    <div class="fw-semibold pe-10 text-gray-600 fs-7">Total:</div>
                    <!--end::Accountname-->
                    <!--begin::Label-->
                    <div class="text-end fw-bold fs-6 text-gray-800">Rp. {{ number_format($billing->price, '2') }}</div>
                    <!--end::Label-->
                  </div>
                  <!--end::Item-->
                </div>
                <!--end::Section-->
              </div>
              <!--end::Container-->
            </div>
            <!--end::Content-->
          </div>
          <!--end::Wrapper-->
        </div>
        <!--end::Invoice 2 content-->
      </div>
      <!--end::Content-->
      <!--begin::Sidebar-->
      <div class="m-0" style="max-width: 300px">
        <!--begin::Invoice 2 sidebar-->
        <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
          <!--begin::Labels-->
          <div class="mb-8">
            <span class="badge badge-light-success me-2">Telah Lunas</span>
          </div>
          <!--end::Labels-->
          <!--begin::Title-->
          <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">PAYMENT DETAILS</h6>
          <!--end::Title-->
          <!--begin::Item-->
          <div class="mb-6">
            <div class="fw-semibold text-gray-600 fs-7">Bank Pembayaran:</div>
            <div class="fw-bold text-gray-800 fs-6">BCA Virtual Account</div>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="mb-6">
            <div class="fw-semibold text-gray-600 fs-7">Account:</div>
            <div class="fw-bold text-gray-800 fs-6">-</div>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="mb-15">
            <div class="fw-semibold text-gray-600 fs-7">Payment Term:</div>
            <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">7 days
              <span class="fs-7 text-danger d-flex align-items-center">
                <span class="bullet bullet-dot bg-danger mx-2"></span>Due in {{ $billing->due_date->diff(\Carbon\Carbon::now())->days }} days</span>
            </div>
          </div>
          <!--end::Item-->
          <!--begin::Title-->
          <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">PACKAGE OVERVIEW</h6>
          <!--end::Title-->
          <!--begin::Item-->
          <div class="mb-6">
            <div class="fw-semibold text-gray-600 fs-7">Package Name</div>
            <div class="fw-bold fs-6 text-gray-800">{{ $billing->package->name }}
              <a href="#" class="link-primary ps-1">{{ $billing->package->code }}</a>
            </div>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="mb-6">
            <div class="fw-semibold text-gray-600 fs-7">Instance Name:</div>
            <div class="fw-bold text-gray-800 fs-6 d-flex align-items-center">
              {{ $billing->school->school_name }}
              <span class="fs-7 text-success d-flex align-items-center"><span class="bullet bullet-dot bg-success mx-2"></span>{{ $billing->school->pic_name }}</span>
            </div>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="m-0">
            <div class="fw-semibold text-gray-600 fs-7">Address:</div>
            <div class="fw-bold fs-6 text-gray-800 ">
              {{ $billing->school->school_address }}
            </div>
          </div>
          <!--end::Item-->
        </div>
        <!--end::Invoice 2 sidebar-->
      </div>
      <!--end::Sidebar-->
    </div>
    <!--end::Layout-->
  </div>
  <!--end::Body-->
</div>
<!--end::Invoice 2 main-->
