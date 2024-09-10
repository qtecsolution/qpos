<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>500</title>
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
        <img class="img-fluid" src="{{ asset('assets/images/500-error.png') }}" alt="">
    </div>
</body>

</html>
