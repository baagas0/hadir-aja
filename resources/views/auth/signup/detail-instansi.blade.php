<div class="{{ $current ? 'current' : '' }}" data-kt-stepper-element="content">
    <div class="w-100">
        <div class="pb-5 pb-lg-10">
            <h2 class="fw-bold text-gray-900" style="text-decoration: underline;">Detail Instansi</h2>
            {{-- <div class="text-muted fw-semibold fs-6">Isi informasi sesuai dengan instansi anda</div> --}}
        </div>
        <div class="mb-10 fv-row">
            <label class="form-label required mb-3">Nama Sekolah</label>
            <input type="text" class="form-control form-control-lg form-control-solid"
                name="step2_school_name" placeholder="" value="" />
        </div>
        <div class="mb-10 fv-row">
            <label class="form-label mb-3">Alamat Sekolah</label>
            <textarea type="text" class="form-control form-control-lg form-control-solid"
                name="step2_school_address" placeholder="" value=""></textarea>
        </div>

        <div class="pb-5 pb-lg-10">
            <h2 class="fw-bold text-gray-900" style="text-decoration: underline;">Detail Penanggung Jawab</h2>
            <div class="text-muted fw-semibold fs-6">Isi dengan informasi kepala sekolah atau staff yang bertanggung jawab</div>
        </div>
        <div class="mb-10 fv-row">
            <label class="form-label required mb-3">Nama Penanggung Jawab</label>
            <input type="text" class="form-control form-control-lg form-control-solid"
                name="step2_pic_name" placeholder="" value="" />
        </div>
        <div class="mb-10 fv-row">
            <div class="row">
                <div class="col-6">
                    <label class="form-label required mb-3">Email</label>
                    <input type="email" class="form-control form-control-lg form-control-solid"
                        name="step2_pic_email" placeholder="" value="" />
                </div>
                <div class="col-6">
                    <label class="form-label required mb-3">No. Whatsapp</label>
                    <input type="number" class="form-control form-control-lg form-control-solid"
                        name="step2_pic_phone_number" placeholder="" value="" />
                </div>
            </div>
        </div>
        <div class="mb-10 fv-row">
            <label class="form-label required mb-3">Kata Sandi</label>
            <input type="password" class="form-control form-control-lg form-control-solid"
                name="step2_pic_password" placeholder="" value="" />
        </div>

        <div class="mb-10 fv-row">
            <label class="form-label mb-3">Alamat</label>
            <textarea type="text" class="form-control form-control-lg form-control-solid"
                name="step2_pic_address" placeholder="" value=""></textarea>
        </div>
    </div>
</div>
