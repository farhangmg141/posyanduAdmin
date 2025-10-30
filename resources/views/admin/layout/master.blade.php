<!DOCTYPE html>
<html lang="en">

@include('admin.layout.head')

<body>
    @include('admin.layout.navbar')
    @include('admin.layout.sidebar')

    <!-- 🔹 Main Content -->
    <main class="content">
        @yield('content')
    </main>

    @include('admin.layout.scripts')
</body>

</html>
