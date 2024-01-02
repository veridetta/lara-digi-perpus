<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="shortcut icon" href="https://via.placeholder.com/50" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css"  />
</head>
<body>
    <main>
        @auth
        @if (auth()->user()->role == 'admin')
            @include('layouts.templates.navbar-auth')
            <div class="row w-100" style="min-height: 90vh;">
                <div class="col-md-3 col-lg-3">
                    @include('layouts.templates.sidebar-admin')
                </div>
                <div class="col-md-9 col-lg-9 row justify-content-center">
                    <div class="mt-2">
                        @include('layouts.templates.message')
                    </div>
                    @yield('content')
                    @include('layouts.templates.footer')
                </div>
            </div>
        @elseif (auth()->user()->role == 'user')
            @include('layouts.templates.navbar-auth')
            <div class="row w-100" style="min-height: 90vh;">
                <div class="col-md-3 col-lg-3">
                    @include('layouts.templates.sidebar')
                </div>
                <div class="col-md-9 col-lg-9 row justify-content-center">
                    <div class="mt-2">
                        @include('layouts.templates.message')
                    </div>
                    @yield('content')
                    @include('layouts.templates.footer')
                </div>
            </div>
        @else
            @include('layouts.templates.navbar')
            <div class="row w-100 justify-content-center" style="min-height: 90vh;">
                <div class="mt-2">
                    @include('layouts.templates.message')
                </div>
                @yield('content')
                @include('layouts.templates.footer')
            </div>
        @endif
    @endauth

    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html>
