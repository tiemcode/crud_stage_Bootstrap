<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div>
        @include('layouts.navigation')
        <x-slot name="header">
            <div class="d-flex justify-content-between">
                <h1 class="font-semibold text-xl text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h1>
                @if (route('dashboard'))
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('addpost') }}">
                        <button type="button" class="btn btn-primary">
                            Artikel Toevoegen
                        </button>
                    </a>
                </div>
                @endif
            </div>
        </x-slot>

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-light shadow">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
        @endif
        <!-- Page Content -->
        <main class="container">
            @if (session()->has('success'))
            <div class="pt-4">
                <div class="alert alert-success">
                    <div class="d-flex align-items-center">
                        <svg class="text-success" style="width: 50px;" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        <div class="ms-3">
                            <p class="text-success">{{ session()->get('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="pt-4 d-flex justify-content-between">
                <ul class="list-unstyled  bg-tertiary h-50   shadow-lg rounded ">
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-link  p-3">Artikelen</a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}" class="nav-link  p-3">Categorieën</a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index') }}" class="nav-link  p-3">Projecten</a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}" class="nav-link  p-3">Rollen</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="nav-link  p-3">Producten </a>
                    </li>
                    <li>
                        <a href="{{ route('attributes.index') }}" class="nav-link  p-3">Attributen</a>
                    </li>
                    <?php

                    use App\Models\User;
                    ?>
                    @can('isAdmin', User::class)
                    <li>
                        <a href="{{ route('orders.index') }}" class="nav-link  p-3">Bestellingen</a>
                    </li>
                    @endcan
                    <!-- Add more navigation links as needed -->
                </ul>
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    @yield('scripts')
    <style>
        .ck {
            height: 150px;
            color: black;
        }
    </style>
</body>

</html>
