@extends('layout.admin.master')

@section('title', 'Kelola User')

@section('content')

{{-- ===================== CSS ADMIN DARK ===================== --}}
<style>
    html, body {
        background: #0f1f1b;
        overflow-x: hidden;
    }

    .container-fluid {
        padding: 26px;
    }

    /* HEADER */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .page-header h3 {
        color: #eaf5f1;
        font-weight: 700;
        margin: 0;
    }

    .btn-add {
        background: #7da58c;
        color: #10201b;
        font-weight: 700;
        border-radius: 8px;
        padding: 8px 14px;
    }

    /* CARD */
    .admin-card {
        background: linear-gradient(180deg, #1e342e, #172722);
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,.3);
        overflow: hidden;
    }

    /* TABLE */
    table {
        width: 100%;
        color: #ecf7f3;
        font-size: 14px;
    }

    thead {
        background: #4b6459;
    }

    thead th {
        padding: 14px;
        font-size: 12px;
        text-transform: uppercase;
        color: #f1fbf7;
        border-bottom: none;
        text-align: center;
    }

    tbody tr {
        background: #223b33;
    }

    tbody tr:nth-child(even) {
        background: #1d322b;
    }

    tbody tr:hover {
        background: #2f5046;
    }

    tbody td {
        padding: 12px 14px;
        border-top: 1px solid rgba(255,255,255,.05);
        vertical-align: middle;
        text-align: center;
    }

    /* BADGE ROLE */
    .badge-role {
        background: #4da3ff;
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    /* AKSI */
    .aksi {
        white-space: nowrap;
    }

    .aksi .btn {
        font-size: 11px;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 6px;
    }

    /* PAGINATION */
    .pagination .page-link {
        background: #223b33;
        color: #ecf7f3;
        border: none;
        margin: 0 2px;
    }

    .pagination .active .page-link {
        background: #d6bd98;
        color: #1f2f2a;
        font-weight: 700;
    }

    .pagination .disabled .page-link {
        opacity: .4;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        table {
            font-size: 12px;
        }

        .aksi .btn {
            display: block;
            margin-bottom: 4px;
        }
    }
</style>

{{-- ===================== HEADER ===================== --}}
<div class="page-header">
    <h3>
        <i class="bi bi-people-fill me-2"></i> Kelola User
    </h3>

    <a href="{{ route('useradmin.create') }}" class="btn btn-add">
        <i class="bi bi-plus-circle me-1"></i> Tambah User
    </a>
</div>

{{-- ===================== TABLE ===================== --}}
<div class="admin-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td class="fw-bold">
                        {{ $index + $users->firstItem() }}
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge-role">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="aksi">
                        <a href="{{ route('useradmin.edit', $user->id) }}"
                           class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('useradmin.destroy', $user->id) }}"
                              method="POST"
                              class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    class="btn btn-danger btn-delete">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people display-6 d-block mb-2"></i>
                        Belum ada data user.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if ($users->hasPages())
        <div class="mt-3 px-3 pb-3 d-flex justify-content-center">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@include('layout.admin.footer')

{{-- ===================== SWEETALERT ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // DELETE CONFIRM
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data user akan dihapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });

    // SUCCESS ALERT
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif
</script>

@endsection
