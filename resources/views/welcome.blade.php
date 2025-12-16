@extends('base.index')
@section('content')
    <h1>daftar users</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                DataTables Users
            </h6>
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#tambahUserModal">
                tambah User
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableUsers" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>id</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="text-center">
                            <th>id</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('update', $user->id) }} " method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit User</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $user->name }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $user->email }}" required>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Update
                                                </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <form action="{{ route('hapus', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">hapus</button>
                                    </form>
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $user->id }}">
                                        Edit
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah User Modal -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js-in')
    <script src="{{ asset('sb2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('sb2/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#dataTableUsers').DataTable({
            paging: true,
            ordering: true,
            info: true,
            pageLength: 3,
            lengthMenu: [2, 3, 5, 10, 25, 50]
        });
    </script>
@endsection
