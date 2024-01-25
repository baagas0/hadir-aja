<!--begin::Alert-->
<div class="alert alert-dismissible bg-light-primary border border-primary d-flex flex-column flex-sm-row p-5 mb-5">
  <!--begin::Icon-->
  <i class="ki-duotone ki-search-list fs-2hx text-success me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
  <!--end::Icon-->

  <!--begin::Wrapper-->
  <div class="d-flex flex-column pe-0 pe-sm-10">
      <!--begin::Title-->
      <h5 class="mb-1">Informasi Paket Layanan</h5>
      <!--end::Title-->

      <!--begin::Content-->
      <span>Paket anda akan berakhir dalam {{ auth()->guard('web')->user()->school->remain_day }} hari kedepan.</span>
      <!--end::Content-->
  </div>
  <!--end::Wrapper-->

  <!--begin::Close-->
  <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
      <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
  </button>
  <!--end::Close-->
</div>
<!--end::Alert-->
