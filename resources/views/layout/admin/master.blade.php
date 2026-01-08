@include('layout.admin.head')

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @include('layout.admin.navbar')
    @include('layout.admin.sidebar')

    <!-- 🔹 Main Content -->
    <main class="content">
        @yield('content')
    </main>

    @include('layout.admin.scripts')
</body>

</html>
