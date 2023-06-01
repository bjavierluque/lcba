"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }


	////////////////////////////////// SING IN: ////////////////////////////////////////
    var _handleSignInForm = function() {
        var validation;

        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'Debe ingresar su usuario',
							},
							stringLength: {
								max: 20,
								min: 5,
								message: 'El usuario debe tener 5 caracteres como minimo y 20 como maximo',
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Debe ingresar su contraseña'
							}/*,
							stringLength: {
								max: 20,
								min: 6,
								message: 'La contraseña debe tener 6 caracteres como minimo y 20 como maximo',
							}*/
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
					/*
                    swal.fire({
		                text: "Todo correcto! Disfruta del sitio web",
		                icon: "success",
		                buttonsStyling: false,
		                confirmButtonText: "Esta bien, muchas gracias!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
					*/
				} else {
					swal.fire({
		                text: "Lo sentimos, su usuario o contraseña no son correctos, por favor intente de nuevo.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Aceptar",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }


	//////////////////////////// SING UP ////////////////////////////////////////
    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					fullname: {
						validators: {
							notEmpty: {
								message: 'Debe ingresar su nombre completo'
							},
							stringLength: {
								max: 40,
								min: 8,
								message: 'Ingrese un nombre completo valido',
							}
						}
					},
					email: {
                        validators: {
							notEmpty: {
								message: 'Debe ingresar su correo'
							},
                            emailAddress: {
								message: 'La direccion proporcionada no es valida'
							},
							stringLength: {
								max: 40,
								min: 11,
								message: 'Ingrese una direccion valida',
							}
						}
					},
                    telefono: {
                        validators: {
                            notEmpty: {
                                message: 'Debe ingresar un telefono de contacto'
                            },
							stringLength: {
								max: 10,
								min: 10,
								message: 'Ingrese un celular valido(10 Caracteres sin el 15)',
							},
							digits: {
								message: 'Solo puede contener numeros',
							}
                        }
                    },
                    detalle: {
                        validators: {
                            notEmpty: {
                                message: 'Debe ingresar el detalle del contacto'
                            },
							stringLength: {
								min: 50,
								message: 'Ingrese una descripcion mas detallada',
							}
                            }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'Debe aceptar los terminos y condiciones'
                            }
                        }
                    },
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
					
                    swal.fire({
		                text: "Todo correcto! Se ha enviado el mensaje",
		                icon: "success",
		                buttonsStyling: false,
		                confirmButtonText: "Esta bien, muchas gracias!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
						e.preventDefault();
            			_showForm('signin');
					});
					
				} else {
					swal.fire({
		                text: "Lo sentimos, alguno de los datos ingresados no son correctos, por favor intente de nuevo.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Aceptar",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();
            _showForm('signin');
        });
    }


	/////////////////////////////// FORGOT /////////////////////////////////////
    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Debe ingresar su correo'
							},
                            emailAddress: {
								message: 'Correo invalido'
							},
							stringLength: {
								max: 40,
								min: 11,
								message: 'Debe tener entre 11 y 40 caracteres)',
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
					swal.fire({
		                text: "Todo correcto! Se ha enviado el correo para restablecer la contraseña",
		                icon: "success",
		                buttonsStyling: false,
		                confirmButtonText: "Esta bien, muchas gracias!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				} else {
					swal.fire({
		                text: "Lo sentimos, la direccion de correo no es valida, por favor intente de nuevo.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Aceptar",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
						e.preventDefault();
						_showForm('signin');
						
					});
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();
            _showForm('signin');
        });

		$('#kt_login_forgot_submit').on('click', function (e) {
            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');
            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
