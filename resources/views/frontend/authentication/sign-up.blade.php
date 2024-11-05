<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Sign Up | {{ readConfig('site_name') }}
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
            <figure>
                <img src="{{ asset('assets/images/authentication/register.svg') }}" alt="register image">
            </figure>
        </div>
        <div class="right-content">
            <form action="{{ route('signup') }}" method="post" class="authentication-form px-lg-5 needs-validation"
                novalidate>
                @csrf
                <div class="authentication-form-header">
                    <a href="{{ route('frontend.home') }}" class="logo">
                        <img src="{{ assetImage(readconfig('site_logo')) }}" width="200px" alt="brand-logo">
                    </a>
                    <h3 class="form-title">Create Account</h3>
                    <p class="form-des">Sign up now and explore.</p>
                </div>
                <div class="authentication-form-content">
                    <div class="row g-4">
                        <!-- name -->
                        <div class="col-sm-6 col-lg-12 col-xl-6">
                            <div class="form-group">
                                <label for="fullName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Enter full name"
                                    autocomplete="off" name="name" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">
                                    Please enter your name.
                                </div>
                            </div>
                        </div>
                        <!-- email -->
                        <div class="col-sm-6 col-lg-12 col-xl-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    autocomplete="off" name="email" value="{{ old('email') }}" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                        </div>
                        <!-- password -->
                        <div class="col-sm-6 col-lg-12 col-xl-6">
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password"
                                    autocomplete="off" name="password" required>
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
                                <div class="invalid-feedback">
                                    Please enter a password.
                                </div>
                            </div>
                        </div>
                        <!-- confirm password -->
                        <div class="col-sm-6 col-lg-12 col-xl-6">
                            <div class="form-group">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword"
                                    placeholder="Confirm password" autocomplete="off" name="password_confirmation"
                                    required>
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
                                <div class="invalid-feedback">
                                    Please confirm your password.
                                </div>
                            </div>
                        </div>
                        <!-- remember me -->
                        <div class="col-12">
                            {{-- <div class="single-row mb-2">
                                <div class="rememberbox">
                                    <div class="customcheck ">
                                        <input type="checkbox" id="rememberMe" class="customcheck-box"
                                            name="remember" hidden>
                                        <label for="rememberMe" class="customcheck-label">Remember me</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="single-row">
                                <div class="agreebox">
                                    <div class="customcheck ">
                                        <input type="checkbox" id="agree" class="customcheck-box"
                                            name="remember" hidden required>
                                        <label for="agree" class="customcheck-label">I agree to all the <a
                                                href="#">Terms </a> and <a href="">Privacy Policy</a>
                                            .</label>
                                        <div class="invalid-feedback">
                                            Please agree to our terms.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- create account  -->
                        <div class="col-sm-6 col-lg-12 col-xl-6">
                            <div class="form-group">
                                <button type="submit" class="create-account-btn w-100">Create Account</button>
                            </div>
                        </div>

                        <!-- google sign in  -->
                        <!-- <div class="col-sm-6 col-lg-12 col-xl-6">
                            <div class="form-group">
                                <a href="{{ route('auth.google') }}" class="google-btn w-100">
                                    <span class="icon">
                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_210_9152)">
                                                <path
                                                    d="M6.77127 1.09195C4.97279 1.71586 3.42178 2.90006 2.34607 4.47061C1.27035 6.04116 0.726633 7.91528 0.794767 9.81769C0.862901 11.7201 1.5393 13.5505 2.72461 15.0401C3.90992 16.5297 5.54167 17.5999 7.38018 18.0935C8.87069 18.4781 10.4323 18.495 11.9308 18.1427C13.2883 17.8378 14.5433 17.1856 15.573 16.2499C16.6447 15.2463 17.4225 13.9697 17.823 12.5571C18.2581 11.021 18.3356 9.40562 18.0494 7.83492H9.67939V11.307H14.5267C14.4299 11.8607 14.2223 12.3892 13.9164 12.8609C13.6105 13.3326 13.2125 13.7377 12.7464 14.052C12.1546 14.4436 11.4873 14.7071 10.7875 14.8254C10.0857 14.9559 9.36588 14.9559 8.66408 14.8254C7.95273 14.6785 7.27983 14.3849 6.6883 13.9634C5.73788 13.2906 5.02425 12.3348 4.64924 11.2324C4.26799 10.1094 4.26799 8.89188 4.64924 7.76883C4.91618 6.98163 5.35747 6.26489 5.94018 5.67211C6.60701 4.98128 7.45124 4.48748 8.38024 4.24487C9.30924 4.00226 10.2871 4.02023 11.2066 4.2968C11.9249 4.51719 12.5817 4.90244 13.1247 5.4218C13.6713 4.87805 14.2169 4.33289 14.7616 3.78633C15.0428 3.49242 15.3494 3.21258 15.6264 2.91164C14.7975 2.14034 13.8245 1.54013 12.7633 1.14539C10.8307 0.443657 8.71608 0.424798 6.77127 1.09195Z"
                                                    fill="white" />
                                                <path
                                                    d="M6.77102 1.09215C8.71567 0.42454 10.8303 0.442902 12.763 1.14418C13.8245 1.5416 14.797 2.1447 15.6248 2.91887C15.3435 3.2198 15.0468 3.50105 14.7599 3.79355C14.2143 4.33824 13.6691 4.88105 13.1245 5.42199C12.5815 4.90263 11.9246 4.51738 11.2063 4.29699C10.2872 4.01945 9.30932 4.00045 8.38007 4.24207C7.45083 4.48368 6.60608 4.97658 5.93852 5.66668C5.35581 6.25946 4.91452 6.9762 4.64758 7.7634L1.73242 5.50637C2.77587 3.43716 4.58254 1.85437 6.77102 1.09215Z"
                                                    fill="#E33629" />
                                                <path
                                                    d="M0.957574 7.74229C1.11415 6.96571 1.37428 6.21368 1.73101 5.50635L4.64617 7.769C4.26492 8.89206 4.26492 10.1095 4.64617 11.2326C3.67492 11.9826 2.7032 12.7363 1.73101 13.4938C0.838255 11.7168 0.565979 9.69205 0.957574 7.74229Z"
                                                    fill="#F8BD00" />
                                                <path
                                                    d="M9.67836 7.8335H18.0484C18.3345 9.40419 18.2571 11.0196 17.822 12.5557C17.4215 13.9682 16.6436 15.2449 15.572 16.2485C14.6312 15.5144 13.6862 14.786 12.7454 14.0519C13.2118 13.7373 13.6099 13.3318 13.9158 12.8596C14.2217 12.3875 14.4292 11.8584 14.5257 11.3041H9.67836C9.67695 10.1482 9.67836 8.99084 9.67836 7.8335Z"
                                                    fill="#587DBD" />
                                                <path
                                                    d="M1.73047 13.4937C2.70266 12.7437 3.67437 11.9899 4.64562 11.2324C5.02139 12.3352 5.73604 13.291 6.6875 13.9634C7.28087 14.3829 7.95523 14.6741 8.6675 14.8184C9.3693 14.9489 10.0891 14.9489 10.7909 14.8184C11.4907 14.7001 12.158 14.4366 12.7498 14.0449C13.6906 14.779 14.6356 15.5074 15.5764 16.2415C14.5469 17.1777 13.2918 17.8304 11.9342 18.1357C10.4357 18.488 8.87411 18.4711 7.38359 18.0865C6.20474 17.7717 5.10361 17.2169 4.14922 16.4566C3.13915 15.6545 2.31411 14.6439 1.73047 13.4937Z"
                                                    fill="#319F43" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_210_9152">
                                                    <rect width="18" height="18" fill="white"
                                                        transform="translate(0.5 0.5)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <span class="text">Sign up with Google</span>
                                </a>
                            </div>
                        </div> -->


                    </div>
                </div>
                <div class="authentication-form-footer">
                    <p>Already have an account ? <a href="{{ route('login') }}">Log in </a></p>
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
    <!-- VALIDATION JS  -->
    <script src="{{ asset('assets/js/validation/validation.js') }}"></script>
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
