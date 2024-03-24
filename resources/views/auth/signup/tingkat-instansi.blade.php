<div class="{{ $current ? 'current' : '' }}" data-kt-stepper-element="content">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold d-flex align-items-center text-gray-900">Tingkat Instansi
                <span class="ms-1" data-bs-toggle="tooltip"
                    title="Kami akan menyesuaikan data sesuai dengan tingkat instansi anda.">
                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span>
            </h2>
            <div class="text-muted fw-semibold fs-6">Kami akan menyesuaikan data menurut tingkat instansi.
            </div>
        </div>
        <div class="fv-row">
            <div class="row">
                <div class="col-lg-12">
                    @csrf
                </div>
                <div class="col-lg-6">
                    <input type="radio" class="btn-check" name="step1_school_level"
                        value="SMP/MTs" checked="checked"
                        id="kt_create_account_form_school_level_personal" />
                    <label
                        class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
                        for="kt_create_account_form_school_level_personal">
                        <i class="ki-duotone ki-brifecase-timer fs-3x me-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <span class="d-block fw-semibold text-start">
                            <span class="text-gray-900 fw-bold d-block fs-4 mb-2">SMP/MTs</span>
                            <span class="text-muted fw-semibold fs-6">Setingkat dengan SMP atau MTs</span>
                        </span>
                    </label>
                </div>
                <div class="col-lg-6">
                    <input type="radio" class="btn-check" name="step1_school_level"
                        value="SMA/SMK"
                        id="kt_create_account_form_school_level_corporate" />
                    <label
                        class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                        for="kt_create_account_form_school_level_corporate">
                        <i class="ki-duotone ki-briefcase fs-3x me-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <span class="d-block fw-semibold text-start">
                            <span class="text-gray-900 fw-bold d-block fs-4 mb-2">SMA/SMK</span>
                            <span class="text-muted fw-semibold fs-6">Setingkat dengan SMA atau SMK</span>
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
