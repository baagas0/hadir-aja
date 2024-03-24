<div class="{{ $current ? 'current' : '' }}" data-kt-stepper-element="content">
    <div class="w-100">
        <div class="pb-10 pb-lg-15">
            <h2 class="fw-bold text-gray-900">Jam masuk</h2>
            <div class="text-muted fw-semibold fs-6">Sesuaikan jam masuk pada instansi.
            </div>
        </div>

        <div class="fv-row mb-10">
            <label class="form-label required">Nama Sesi</label>
            <input name="step4_title" class="form-control form-control-lg form-control-solid" value="Reguler" />
        </div>
        <div class="fv-row mb-10">
            <label class="form-label">
                Waktu Toleransi
                <span class="required">Waktu Toleransi</span>
                <span class="ms-1" data-bs-toggle="tooltip" title="Input Waktu Toleransi, ex: 30 menit">
                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                </span>
            </label>
            <input name="step4_time_tolerance" type="number" class="form-control form-control-lg form-control-solid" value="30" />
        </div>

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th></th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Senin" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_1_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_1_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Selasa" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_2_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_2_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Rabu" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_3_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_3_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Kamis" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_4_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_4_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Jumat" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_5_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_5_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Sabtu" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_6_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_6_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Hari" name="step4_school_shift[day][]" value="Minggu" readonly>
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Masuk" name="step4_school_shift[hour_in][]" value="07:00" id="hour_7_1">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" placeholder="Waktu Pulang" name="step4_school_shift[hour_out][]" value="15:00" id="hour_7_2">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <p class="text-danger">* Kosongkan hari sabtu/minggu jika peraturan sekolah libur.</p>

    </div>
</div>
