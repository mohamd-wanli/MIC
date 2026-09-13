<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    @include('layouts.head')
</head>

<body>
    @include('layouts.header')

    <main id="main" class="main">
      @yield('content')
    </main><!-- End #main -->

    @include('layouts.sidebar')

    @include('layouts.footer')

    @include('layouts.footer-scripts')

</body>

</html>