<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        New Password | {{ readConfig('site_name') }}
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
                <img src="{{ asset('assets/images/authentication/register.svg') }}" alt="register image ">
            </figure>
        </div>
        <div class="right-content">
            <form action="{{ route('new.password') }}" method="post" class="authentication-form px-lg-5"
                id="resetPasswordForm needs-validation" novalidate>
                @csrf
                <div class="authentication-form-header">
                    <a href="{{ route('frontend.home') }}" class="logo">
                        <img src="{{ assetImage(readconfig('site_logo')) }}" width="200px" alt="brand-logo">
                    </a>
                    <h3 class="form-title">Reset Password</h3>
                    <p class="form-des">Please enter your new password.</p>
                </div>
                <div class="authentication-form-content">
                    <div class="row g-4">
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password"
                                    autocomplete="off" name="password" required>
                                <div class="invalid-feedback" id="passwordValidationText">Enter password</div>
                                <div class="show-hide toggle-password" id="toggleIcon">

                                    <span class="eye-icon">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.75 9C0.75 9 3.75 3 9 3C14.25 3 17.25 9 17.25 9C17.25 9 14.25 15 9 15C3.75 15 0.75 9 0.75 9Z"
                                                stroke="#E2E8F0" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z"
                                                stroke="#E2E8F0" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </span>
                                    <span class="eye-off d-none">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_157_8998)">
                                                <path
                                                    d="M13.455 13.455C12.1729 14.4323 10.6118 14.9737 9 15C3.75 15 0.75 9.00002 0.75 9.00002C1.68292 7.26144 2.97685 5.74247 4.545 4.54502M7.425 3.18002C7.94125 3.05918 8.4698 2.99877 9 3.00002C14.25 3.00002 17.25 9.00002 17.25 9.00002C16.7947 9.85172 16.2518 10.6536 15.63 11.3925M10.59 10.59C10.384 10.8111 10.1356 10.9884 9.85962 11.1114C9.58362 11.2343 9.28568 11.3005 8.98357 11.3058C8.68146 11.3111 8.38137 11.2555 8.10121 11.1424C7.82104 11.0292 7.56654 10.8608 7.35289 10.6471C7.13923 10.4335 6.9708 10.179 6.85763 9.89881C6.74447 9.61865 6.6889 9.31856 6.69423 9.01645C6.69956 8.71434 6.76568 8.4164 6.88866 8.1404C7.01163 7.86441 7.18894 7.616 7.41 7.41002"
                                                    stroke="#E2E8F0" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M0.75 0.75L17.25 17.25" stroke="#E2E8F0" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_157_8998">
                                                    <rect width="18" height="18" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword"
                                    placeholder="Confirm password" autocomplete="off" name="password_confirmation"
                                    required>
                                <div class="invalid-feedback" id="confirmPasswordValidationText"></div>
                                <div class="show-hide toggle-password" id="toggleIcon">

                                    <span class="eye-icon">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.75 9C0.75 9 3.75 3 9 3C14.25 3 17.25 9 17.25 9C17.25 9 14.25 15 9 15C3.75 15 0.75 9 0.75 9Z"
                                                stroke="#E2E8F0" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                            <path
                                                d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z"
                                                stroke="#E2E8F0" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </span>
                                    <span class="eye-off d-none">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_157_8998)">
                                                <path
                                                    d="M13.455 13.455C12.1729 14.4323 10.6118 14.9737 9 15C3.75 15 0.75 9.00002 0.75 9.00002C1.68292 7.26144 2.97685 5.74247 4.545 4.54502M7.425 3.18002C7.94125 3.05918 8.4698 2.99877 9 3.00002C14.25 3.00002 17.25 9.00002 17.25 9.00002C16.7947 9.85172 16.2518 10.6536 15.63 11.3925M10.59 10.59C10.384 10.8111 10.1356 10.9884 9.85962 11.1114C9.58362 11.2343 9.28568 11.3005 8.98357 11.3058C8.68146 11.3111 8.38137 11.2555 8.10121 11.1424C7.82104 11.0292 7.56654 10.8608 7.35289 10.6471C7.13923 10.4335 6.9708 10.179 6.85763 9.89881C6.74447 9.61865 6.6889 9.31856 6.69423 9.01645C6.69956 8.71434 6.76568 8.4164 6.88866 8.1404C7.01163 7.86441 7.18894 7.616 7.41 7.41002"
                                                    stroke="#E2E8F0" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M0.75 0.75L17.25 17.25" stroke="#E2E8F0" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_157_8998">
                                                    <rect width="18" height="18" fill="white"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <button type="submit" class="create-account-btn w-100" onclick="validateForm()">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="authentication-form-footer">
                                <p>Back to <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </div>
                    </div>
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
        // Get all password input elements and toggle icons
        const passwordInputs = document.querySelectorAll('.form-control[type="password"]');
        const toggleIcons = document.querySelectorAll('.toggle-password');

        // Add click event listeners to toggle icons
        toggleIcons.forEach((toggleIcon, index) => {
            toggleIcon.addEventListener('click', () => {
                // Toggle the visibility of the respective password field
                if (passwordInputs[index].type === 'password') {
                    passwordInputs[index].type = 'text';
                    toggleIcon.querySelector('.eye-icon').classList.add('d-none');
                    toggleIcon.querySelector('.eye-off').classList.remove('d-none');
                } else {
                    passwordInputs[index].type = 'password';
                    toggleIcon.querySelector('.eye-icon').classList.remove('d-none');
                    toggleIcon.querySelector('.eye-off').classList.add('d-none');
                }
            });
        });
    </script>

</body>

</html>
