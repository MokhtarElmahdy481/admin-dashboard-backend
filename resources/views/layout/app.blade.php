<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    @include('layout.head')
    <body class="antialiased bg-indigo-50">
        {{ $slot }}
    </body>
</html>
