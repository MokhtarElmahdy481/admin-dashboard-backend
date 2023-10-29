<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    @include('layout.head')
    <body class="antialiased bg-indigo-50">
        <x-sidebar />
        <div class="px-4 sm:ms-64">
            <x-navbar />
            {{ $slot }}
        </div>
    </body>
</html>
