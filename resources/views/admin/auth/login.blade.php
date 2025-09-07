<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../" />
    <title>{{ 'Login | ' . env('APP_NAME') ?? 'Laravel Admin 12.x' }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="{{ 'Login | ' . env('APP_NAME') ?? 'Laravel Admin 12.x' }}" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <script src="{{ asset('common/js/jQuery/jquery.min.js') }}"></script>
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" />
    <script>
        if (window.top != window.self) window.top.location.replace(window.self.location.href);
    </script>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <script>
        var themeMode = document.documentElement.getAttribute("data-bs-theme-mode") ||
            localStorage.getItem("data-bs-theme") ||
            "light";
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    </script>

    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url("{{ asset('admin/assets/media/auth/bg10.jpeg') }}");
            }

            [data-bs-theme="dark"] body {
                background-image: url("{{ asset('admin/assets/media/auth/bg10-dark.jpeg') }}");
            }
        </style>

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('admin/assets/media/auth/agency.png') }}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('admin/assets/media/auth/agency-dark.png') }}" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">🔒 Authorized Access Only</h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        A fast, secure, and versatile admin panel built for seamless management and control.
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!-- form -->
                            <form class="form w-100" id="admin_login_form" method="POST"
                                action="{{ route('admin.login') }}">
                                @csrf
                                @method('POST')
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Multi Functional Admin Panel</div>
                                </div>

                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-8">Harshit Chavda</span>
                                </div>

                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" name="email"
                                        class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="password" placeholder="Password" name="password"
                                        class="form-control bg-transparent" />
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Sign In</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                                <div class="text-gray-500 text-center fw-semibold fs-6">
                                    Secure Admin Panel
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Validation -->
    <script src="{{ asset('common/js/jQuery/jquery.validate.min.js') }}"></script>
    <script>
        // custom rules
        jQuery.validator.addMethod("not_empty", function(value, element) {
            return $.trim(value).length > 0;
        }, "This field cannot be empty");

        jQuery.validator.addMethod("valid_email", function(value, element) {
            return this.optional(element) || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }, "Please enter a valid email address");

        $(document).ready(function() {
            $("#admin_login_form").validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 80,
                        email: true,
                        valid_email: true,
                    },
                    password: {
                        required: true,
                        not_empty: true,
                        minlength: 8,
                        maxlength: 16
                    },
                },
                messages: {
                    email: {
                        required: "Email address is required",
                        maxlength: "Email address cannot exceed 80 characters",
                        email: "Please enter a valid email address",
                        valid_email: "Please enter a valid email address",
                    },
                    password: {
                        required: "Password is required",
                        not_empty: "Password cannot be just spaces",
                        minlength: "Password must be at least 8 characters",
                        maxlength: "Password cannot exceed 16 characters",
                    },
                },
                errorClass: 'invalid-feedback',
                errorElement: 'span',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });

            $("#admin_login_form").on("submit", function(e) {
                if (!$(this).valid()) {
                    e.preventDefault(); // stop submission
                } else {
                    $("#kt_sign_in_submit").prop("disabled", true);
                }
            });
        });
    </script>
</body>

</html>
