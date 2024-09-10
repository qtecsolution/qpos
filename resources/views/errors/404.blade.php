<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    <!-- FAVICON ICON -->
    <link rel="shortcut icon" href="{{ assetImage(readconfig('site_logo')) }}" type="image/svg+xml">
    <style>
        .content {
            display: flex;
            justify-content: center;
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="content">
        <img class="img-fluid" src="{{ asset('assets/images/404-error.jpg') }}" alt="">

        <svg viewBox="0 0 500 500" version="1.1" id="svg_null">
            <defs>
                <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="linearGradient-1">
                    <stop stop-color="#00ECE8" offset="0%"></stop>
                    <stop stop-color="#00D5CC" offset="100%"></stop>
                </linearGradient>
            </defs>
            <g id="root" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect id="background" fill="#FFF" x="0" y="0" width="500" height="500"></rect>
                <path
                    d="M97 307l181.895 0l-90.947 -205.066l-90.948 205.066zm212.977 -212l94.023 212l-188.046 0l94.023 -212z"
                    id="shape.secondary" fill="#4d6de3" fill-rule="nonzero" opacity=".8"></path>
                <g id="Group" transform="translate(40.000000, 361.000000)">
                    <rect id="Rectangle-51" x="0" y="0" width="420" height="60"></rect><text
                        id="headerText.primary" font-family="Source Code Pro" font-size="60" font-weight="900"
                        line-spacing="60" fill="#393737" data-text-alignment="C" font-style="normal">
                        <tspan x="12.022354125976562" y="52.5">QPOS</tspan>
                    </text>
                </g>
            </g>
        </svg>
    </div>
</body>

</html>
