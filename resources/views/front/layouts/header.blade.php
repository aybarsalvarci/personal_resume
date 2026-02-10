<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') {{config('settings.title')}}</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="@yield('description', config('settings.meta_description'))">
    <meta name="keywords"
        content="@yield('description', config('settings.meta_keywords'))">
    <meta name="author" content="@yield('description', config('settings.meta_author'))">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Turkish">
    <meta name="revisit-after" content="7 days">
    <meta name="rating" content="general">

    @stack('og')

    <!-- Canonical URL -->
    <link rel="canonical" href="{{request()->url()}}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(Storage::url(config('settings.favicon'))) }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(Storage::url(config('settings.favicon32x32'))) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(Storage::url(config('settings.favicon16x16'))) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(Storage::url(config('settings.apple_touch_icon'))) }}">
    <link rel="manifest" href="{{ asset(Storage::url(config('settings.manifest'))) }}">
    <link rel="mask-icon" href="{{ asset(Storage::url(config('settings.mask_icon'))) }}" color="#4f46e5">
    <meta name="msapplication-config" content="{{ asset(Storage::url(config('settings.browser_config'))) }}">

    <meta name="msapplication-TileColor" content="#1a1b26">
    <meta name="theme-color" content="#1a1b26">

    <!-- Additional SEO -->
    <meta name="theme-color" content="#6366f1">
    <meta name="msapplication-TileColor" content="#6366f1">
    <meta name="format-detection" content="telephone=no">

    <!-- Fonts & Libraries -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/aos.css')}}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">

    @stack('css')
</head>
