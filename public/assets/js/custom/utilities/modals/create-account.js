"use strict";
var KTCreateAccount = function() {
    var e, t, i, o, a, r, s = [];

    return {
        init: function() {
            (
                e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e),
                (t = document.querySelector("#kt_create_account_stepper")) && (i = t.querySelector("#kt_create_account_form"),
                o = t.querySelector('[data-kt-stepper-action="submit"]'),
                a = t.querySelector('[data-kt-stepper-action="next"]'),
                (r = new KTStepper(t))

                .on("kt.stepper.changed", (function(e) {
                    console.log("kt.stepper.changed", r.getCurrentStepIndex())
                    4 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), o.classList.remove("d-inline-block"), a.classList.remove("d-none")) : 5 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), a.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), a.classList.remove("d-none"))
                })),

                r.on("kt.stepper.next", (function(e) {
                    console.log("stepper.next");
                    var t = s[e.getCurrentStepIndex() - 1];
                    t ? t.validate().then((function(t) {
                        console.log("validated!"), "Valid" == t ? (e.goNext(), KTUtil.scrollTop()) : Swal.fire({
                            text: "Formulir tidak valid, harap perbaiki formulir anda.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-light"
                            }
                        }).then((function() {
                            KTUtil.scrollTop()
                        }))
                    })) : (e.goNext(), KTUtil.scrollTop())
                })),

                r.on("kt.stepper.previous", (function(e) {
                    console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
                })),

                s.push(FormValidation.formValidation(i, {
                    fields: {
                        step1_school_level: {
                            validators: {
                                notEmpty: {
                                    message: "Anda harus memilih tipe instansi."
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                })),

                s.push(FormValidation.formValidation(i, {
                    fields: {
                        step2_school_name: {
                            validators: {
                                notEmpty: {
                                    message: "Nama instansi wajib diisi."
                                }
                            }
                        },
                        step2_school_address: {
                            validators: {
                                // notEmpty: {
                                //     message: "Alamat instansi wajib diisi."
                                // }
                            }
                        },
                        step2_pic_name: {
                            validators: {
                                notEmpty: {
                                    message: "Nama penanggung jawab wajib diisi."
                                }
                            }
                        },
                        step2_pic_email: {
                            validators: {
                                notEmpty: {
                                    message: "Email penanggung jawab wajib diisi."
                                },
                                emailAddress: {
                                    message: "Format email tidak valid."
                                }
                            }
                        },
                        step2_pic_phone_number: {
                            validators: {
                                notEmpty: {
                                    message: "Whatsapp penanggung jawab wajib diisi."
                                }
                            }
                        },
                        step2_pic_password: {
                            validators: {
                                notEmpty: {
                                    message: "Kata sandi wajib diisi."
                                },
                                callback: {
                                    callback: function (input) {
                                        const value = input.value;
                                        if (value === '') {
                                            return { valid: true };
                                        }

                                        if (value.length < 8) {
                                            return {
                                                valid: false,
                                                message: 'Kata sandi minimal 8 karakter',
                                            };
                                        }

                                        if (value === value.toLowerCase()) {
                                            return {
                                                valid: false,
                                                message: 'Kata sandi harus memiliki minimal 1 huruf besar',
                                            };
                                        }

                                        if (value === value.toUpperCase()) {
                                            return {
                                                valid: false,
                                                message: 'Kata sandi harus memiliki minimal 1 huruf kecil',
                                            };
                                        }

                                        if (value.search(/[0-9]/) < 0) {
                                            return {
                                                valid: false,
                                                message: 'Kata sandi  harus memiliki minimal 1 angka',
                                            };
                                        }

                                        return { valid: true };
                                    }
                                }
                            }
                        },
                        step2_pic_address: {
                            validators: {
                                // notEmpty: {
                                //     message: "wajib diisi."
                                // }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                })),

                s.push(FormValidation.formValidation(i, {
                    fields: {
                        step3_title: {
                            validators: {
                                notEmpty: {
                                    message: "Nama lokasi wajib diisi."
                                }
                            }
                        },
                        step3_address: {
                            validators: {
                                // notEmpty: {
                                //     message: "Alamat wajib diisi."
                                // }
                            }
                        },
                        step3_location: {
                            validators: {
                                notEmpty: {
                                    message: "Lokasi wajib diisi."
                                }
                            }
                        },
                        step3_radius_distance: {
                            validators: {
                                notEmpty: {
                                    message: "Radius wajib diisi."
                                }
                            }
                        },
                        step3_lat: {
                            validators: {
                                notEmpty: {
                                    message: "Lat wajib diisi."
                                }
                            }
                        },
                        step3_long: {
                            validators: {
                                notEmpty: {
                                    message: "Long wajib diisi."
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                })),

                s.push(FormValidation.formValidation(i, {
                    fields: {
                        card_name: {
                            validators: {
                                notEmpty: {
                                    message: "Name on card is required"
                                }
                            }
                        },
                        card_number: {
                            validators: {
                                notEmpty: {
                                    message: "Card member is required"
                                },
                                creditCard: {
                                    message: "Card number is not valid"
                                }
                            }
                        },
                        card_expiry_month: {
                            validators: {
                                notEmpty: {
                                    message: "Month is required"
                                }
                            }
                        },
                        card_expiry_year: {
                            validators: {
                                notEmpty: {
                                    message: "Year is required"
                                }
                            }
                        },
                        card_cvv: {
                            validators: {
                                notEmpty: {
                                    message: "CVV is required"
                                },
                                digits: {
                                    message: "CVV must contain only digits"
                                },
                                stringLength: {
                                    min: 3,
                                    max: 4,
                                    message: "CVV must contain 3 to 4 digits only"
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                })),

                o.addEventListener("click", (function(e) {
                    s[3].validate().then((function(t) {

                        // console.log('s[3] validate')
                        // console.info('Submit here', t, $('#kt_create_account_form').serializeArray())

                        console.log("validated!"),
                        "Valid" == t
                            ?   (
                                    e.preventDefault(),
                                    o.disabled = !0,
                                    o.setAttribute("data-kt-indicator", "on"),
                                    setTimeout((function() {
                                        $('#kt_create_account_form').submit();
                                        o.removeAttribute("data-kt-indicator"), o.disabled = !1, r.goNext()
                                    })
                                , 2e3))
                            :   Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-light"
                                    }
                                }).then((function() {
                                    KTUtil.scrollTop()
                                }))
                    }))
                })),

                $(i.querySelector('[name="card_expiry_month"]')).on("change", (function() {
                    s[3].revalidateField("card_expiry_month")
                })),

                $(i.querySelector('[name="card_expiry_year"]')).on("change", (function() {
                    s[3].revalidateField("card_expiry_year")
                })),

                // $(i.querySelector('[name="step1_school_level"]')).on("change", (function(e) {
                //     console.log('step1_school_level change', e, this.value)
                // })),

                $(i.querySelector('[name="business_type"]')).on("change", (function() {
                    s[2].revalidateField("business_type")
                }))
            )


        },
        domManipulation: function() {
            const hour_out = {
                'SMA/SMK': '17:00',
                'SMP/MTs': '14:00',
            }

            $('input[name="step1_school_level"]').on('change', function() {
                for (let i = 1; i < 8; i++) {
                    $(`#hour_${i}_2`).val(hour_out[this.value])
                }
            })

            const step1_school_level = $('input[name="step1_school_level"]').val()
            console.log('cekkkk', step1_school_level)
            for (let i = 1; i < 8; i++) {
                console.log(hour_out[step1_school_level]);
                $(`#hour_${i}_2`).val(hour_out[step1_school_level])
            }
        },
        maps: function() {
            var handleMaps = function () {
                console.info('handleMaps')
                $('#maps').locationpicker({
                    location: {latitude: -6.990275700949499, longitude: 110.42294344386147},
                    radius: 300,
                    inputBinding: {
                        latitudeInput: $('#lat'),
                        longitudeInput: $('#long'),
                        radiusInput: $('#radius_distance'),
                        locationNameInput: $('#location')
                    },
                    enableAutocomplete: true,
                    autocompleteOptions: {
                        types: ['(cities)'],
                        componentRestrictions: {country: 'id'}
                    },
                    oninitialized: function(component) {
                        console.log("Maps initialized");
                        maps = component;
                        if ("geolocation" in navigator) {
                            navigator.geolocation.getCurrentPosition(function(position){
                                component.locationpicker('location', {
                                    // radius: 3000,
                                    latitude: position.coords.latitude,
                                    longitude: position.coords.longitude
                                });
                            });
                        }
                    }
                });
            }

            handleMaps()
        },
        fixingForm: function() {
            $('#fixingButton').on('click', function() {
                document.getElementById('errorsContainer').classList.add('d-none');
                document.getElementById('kt_create_account_form').classList.remove('d-none');
            });
        }
    }
}();
KTUtil.onDOMContentLoaded((function() {
    KTCreateAccount.init();
    KTCreateAccount.domManipulation();
    KTCreateAccount.maps();
    KTCreateAccount.fixingForm();
}));
