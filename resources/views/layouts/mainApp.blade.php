<!DOCTYPE html>
<html lang="en" data-theme="light" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Modern, Responsive Admin Dashboard and Web Application Template built with HTML5, Bootstrap 5, Centralized Common CSS, and Vanilla JavaScript.">
    <title>AdminHub - Responsive Web Application Template</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Master Centralized Common CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    <!-- chat Common CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/chat.css')}}">
</head>

<body>

    <!-- ====================================================================
       1. APP WRAPPER (Master Layout Container)
       ==================================================================== -->
    <div id="appWrapper">
        <!-- Mobile / Tablet Backdrop Overlay -->
        <div id="sidebarBackdrop" aria-hidden="true"></div>
        <!-- Sidebar -->
        @include('layouts.content.sidenav')
        <!-- ==================================================================
         3. MAIN LAYOUT (Header + Page Content + Footer)
         ================================================================== -->
        <div id="mainLayout">
            <!-- Header -->
            @include('layouts.content.header')

            <!-- ================================================================
           3.2 CONTENT WRAPPER (#contentWrapper)
           ================================================================ -->
            <main id="contentWrapper" role="main">
                <div class="container-fluid p-0">
                    @yield('main_content')
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.content.footer')
        </div>
    </div>

    <!-- Bootstrap 5.3.3 Bundle JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Centralized Application Core JS -->
    <script src="{{asset('assets/js/js/app.js')}}"></script>
</body>

</html>