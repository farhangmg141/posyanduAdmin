@include('layout.admin.head')

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @include('layout.admin.navbar')
    @include('layout.admin.sidebar')

    <!-- 🔹 Main Content -->
    <main class="content">
        @yield('content')
    </main>

    @include('layout.admin.scripts')
    <script>
  <script>
$(document).ready(function () {

    $('#posyanduTable').DataTable({
        pageLength: 10,
        lengthMenu: [5,10,25,50],
        ordering: true,
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "‹",
                next: "›"
            },
            zeroRecords: "Data tidak ditemukan"
        }
    });

    // SweetAlert hapus
    $('.form-hapus').on('submit', function(e){
        e.preventDefault();
        let form = this;

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

});
</script>

    </script>
</body>

</html>
