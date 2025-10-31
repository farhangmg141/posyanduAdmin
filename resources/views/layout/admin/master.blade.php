<!DOCTYPE html>
<html lang="en">

@include('layout.admin.head')

<body>
    @include('layout.admin.navbar')
    @include('layout.admin.sidebar')

    <!-- 🔹 Main Content -->
    <main class="content">
        @yield('content')
    </main>

    @include('layout.admin.scripts')
</body>

</html>
