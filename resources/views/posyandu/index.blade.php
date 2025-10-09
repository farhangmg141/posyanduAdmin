<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin | Data Peserta Posyandu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background: #0d6efd;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
        }
        .sidebar h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .sidebar .nav-link {
            color: white;
            margin: 8px 0;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .content {
            margin-left: 270px;
            padding: 30px;
        }
        h1 { color: #0d6efd; font-weight: bold; }
        table { background: white; border-radius: 10px; overflow: hidden; }
        thead { background: #0d6efd; color: white; }
        tbody tr:hover { background: #f1f1f1; }
        .navbar {
            margin-left: 250px;
            background: white;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Peserta Posyandu</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Laporan</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Pengaturan</a></li>
        </ul>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm px-3">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold text-primary">Admin Posyandu</span>
            <div class="d-flex">
                <span class="me-3">Halo, Admin</span>
                <button class="btn btn-outline-danger btn-sm">Logout</button>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <div class="container">
            <h1 class="mb-4 text-center">Daftar Peserta Posyandu</h1>
            <table class="table table-bordered table-striped text-center shadow">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Usia</th>
                        <th>Kategori</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPosyandu as $i => $p)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $p['nama'] }}</td>
                        <td>{{ $p['nik'] }}</td>
                        <td>{{ $p['usia'] }} Tahun</td>
                        <td>
                            @if($p['kategori'] == 'Balita')
                                <span class="badge bg-success">Balita</span>
                            @else
                                <span class="badge bg-warning text-dark">Ibu Hamil</span>
                            @endif
                        </td>
                        <td>{{ $p['alamat'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
