<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Reset Password | {{ readConfig('site_name') }}
    </title>
    <!-- FAVICON ICON -->
    <link rel="shortcut icon" href="{{ assetImage(readconfig('site_logo')) }}" type="image/svg+xml">
    <!-- BACK-TOP CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/back-top/backToTop.css') }}">
    <!-- BOOTSTRAP CSS (5.3) -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <!-- APP-CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
</head>

<body>
    <x-simple-alert />

    <!-- AUTHENTICATION-START (LOGIN) -->
    <section class="authentications">
        <div class="left-content">
            <figure class="">
                <img src="{{ asset('assets/images/authentication/login.svg') }}" alt="register image ">
            </figure>
        </div>
        <div class="right-content">
            <form action="{{ route('password.reset') }}" method="post" class="authentication-form px-lg-5 forgot-form">
                @csrf
                <div class="authentication-form-header">
                    <a href="{{ route('frontend.home') }}" class="logo">
                        <img src="{{ assetImage(readconfig('site_logo')) }}" width="200px" alt="brand-logo">
                    </a>
                    <h3 class="form-title">Password Reset</h3>
                    <p class="form-des">Please enter the code we emailed you.</p>
                </div>
                <div class="authentication-form-content">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="otp-container">
                                <input type="text" maxlength="1" name="number_1" required />
                                <input type="text" maxlength="1" name="number_2" required />
                                <input type="text" maxlength="1" name="number_3" required />
                                <input type="text" maxlength="1" name="number_4" required />
                                <input type="text" maxlength="1" name="number_5" required />
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="create-account-btn w-100">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="authentication-form-footer">
                    <p>Didn’t receive the email? Click to <a href="{{ route('resend.otp') }}">resend </a></p>
                    <p>Back to <a href="{{ route('login') }}">Log in </a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- AUTHENTICATION-END -->


    <!-- BOOTSTRAP JS (5.3) -->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- BOOTSTRAP-TOOLTIP -->
    <script src="{{ asset('assets/js/tooltip/tooltip.js') }}"></script>
    <!-- BACK-TOP JS -->
    <script src="{{ asset('assets/js/back-top/backToTop.js') }}"></script>
    <script src="{{ asset('assets/js/back-top/backtop.js') }}"></script>
    <!-- COPYRIGHT JS -->
    <script src="{{ asset('assets/js/copyright/copyright.js') }}"></script>
    <script>
        const otpInputs = document.querySelectorAll('.otp-container input[type="text"]');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                const inputLength = event.target.value.length;

                if (inputLength === 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    } else {
                        otpInputs[index].blur();
                    }
                } else if (inputLength === 0) {
                    if (index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }

                updateInputStyles();
            });

            input.addEventListener('keydown', (event) => {
                const key = event.keyCode || event.charCode;

                if (key === 8 && input.value.length === 0 && index > 0) {
                    otpInputs[index - 1].focus();
                }

                updateInputStyles();
            });
        });

        function updateInputStyles() {
            otpInputs.forEach((input) => {
                if (input.value.length > 0) {
                    input.classList.add('filled');
                } else {
                    input.classList.remove('filled');
                }
            });
        }
    </script>

</body>

</html>
