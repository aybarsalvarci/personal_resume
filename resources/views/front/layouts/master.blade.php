@include("front.layouts.header")

<body>
<!-- Loading Screen -->
<div class="loading-screen" id="loadingScreen">
    <div class="loader"></div>
</div>

<!-- Scroll Progress -->
<div class="scroll-progress" id="scrollProgress"></div>

<!-- Custom Cursor -->
<div id="cursor"></div>

<!-- Animated Background -->
<div class="animated-bg"></div>
<div class="grid-overlay"></div>

<!-- Navigation -->
@include("front.layouts.navbar")


@yield('content')

<!-- Theme Toggle -->
<button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
    <i class="fas fa-moon icon moon"></i>
    <i class="fas fa-sun icon sun"></i>
</button>

@include("front.layouts.footer")

</body>

</html>
