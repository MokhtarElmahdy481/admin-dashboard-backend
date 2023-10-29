<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    @include('layout.head')
    <body class="antialiased bg-indigo-50">
        <div class="flex flex-col min-h-screen">
            <x-navbar />
            {{ $slot }}
        </div>
    </body>
</html>
