<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Aybars Şalvarcı - Bilgisayar Mühendisliği öğrencisi. Backend development, clean architecture ve modern web teknolojileri üzerine çalışıyorum. Laravel, Python, Docker.">
    <meta name="keywords"
        content="Aybars Şalvarcı, Backend Developer, Bilgisayar Mühendisliği, Laravel Developer, Python Developer, Web Development, Clean Architecture, REST API, Malatya">
    <meta name="author" content="Aybars Şalvarcı">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Turkish">
    <meta name="revisit-after" content="7 days">
    <meta name="rating" content="general">


    @stack('og')

    <!-- Canonical URL -->
    <link rel="canonical" href="https://aybars.dev/">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

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
