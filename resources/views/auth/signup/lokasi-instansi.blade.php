<div class="{{ $current ? 'current' : '' }}" data-kt-stepper-element="content">
    <div class="w-100">
        <div class="pb-10 pb-lg-12">
            <h2 class="fw-bold text-gray-900">Lokasi Instansi</h2>
            <div class="text-muted fw-semibold fs-6">Pin lokasi untuk menggunakan fitur geolation.</div>
        </div>
        <div class="fv-row mb-10">
            <label class="form-label required">Nama Lokasi</label>
            <input name="step3_title" class="form-control form-control-lg form-control-solid" value="Lokasi Utama" />
        </div>
        <div class="fv-row mb-10">
            <label class="form-label">Alamat Lengkap</label>
            <textarea name="step3_address" class="form-control form-control-lg form-control-solid"></textarea>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="fv-row mb-10">
                    <label class="form-label required">Lokasi</label>
                    <input id="location" name="step3_location" class="form-control form-control-lg form-control-solid" value="" />
                </div>
            </div>
            <div class="col-6">
                <div class="fv-row mb-10">
                    <label class="form-label required">Radius Presensi</label>
                    <input id="radius_distance" name="step3_radius_distance" class="form-control form-control-lg form-control-solid" value="" />
                </div>
            </div>
        </div>
        <div class="row d-none">
            <div class="col-6">
                <div class="fv-row mb-10">
                    <label class="form-label required">Lat</label>
                    <input id="lat" name="step3_lat" class="form-control form-control-lg form-control-solid" value="" readonly />
                </div>
            </div>
            <div class="col-6">
                <div class="fv-row mb-10">
                    <label class="form-label required">Long</label>
                    <input id="long" name="step3_long" class="form-control form-control-lg form-control-solid" value="" readonly />
                </div>
            </div>
        </div>
        <div class="fv-row mb-10">
            <div id="maps" style="width: 100%; height: 300px"></div>
            <small class="text-danger">Pindahkan pin untuk mengatur lokasi</small>
        </div>

    </div>
</div>
