@if(Auth::user()->role != 'admin')
    @php
        header("Location: " . URL::to('usershome') );
        exit();
    @endphp
@else
@extends('layouts.index')
@section('content')
    <h1>Daftar Users</h1>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
            <button type="button" class="btn btn-primary btn-md rounded-" data-toggle="modal"
                data-target="#tambahUserModal">
                Tambah User
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                {{-- tabel --}}
                <table class="table table-bordered" id="dataTableUsers" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>rule</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>rule</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($users as $row_user)
                            <tr>
                                <td class="text-center">{{ $row_user->id }}</td>
                                <td>{{ $row_user->name }}</td>
                                <td>{{ $row_user->email }}</td>
                                <td class="text-center">{{ $row_user->role }}</td>
                                <td class="text-center">
                                    <form action="{{ route('user.destroy', $row_user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $row_user->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- tabel --}}
            </div>
        </div>
    </div>

    <!-- ============ MODAL EDIT (ditempatkan di luar loop tbody) ============ -->
    @foreach ($users as $row_user)
        <div class="modal fade" id="editModal{{ $row_user->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.update', $row_user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Penanda asal form -->
                        <input type="hidden" name="_from_modal" value="edit_{{ $row_user->id }}">

                        <div class="modal-header">
                            <h5 class="modal-title">Edit row_user</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            @if ($errors->any() && old('_from_modal') === "edit_{$row_user->id}")
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $row_user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $row_user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Opsional: password hanya jika ingin ubah -->
                            <div class="form-group">
                                <label>Password (kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" class="form-control">
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
    @endforeach

    <!-- ============ MODAL TAMBAH ============ -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tambah_user') }}" method="POST">
                    @csrf
                    <!-- Penanda asal form -->
                    <input type="hidden" name="_from_modal" value="tambah">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @if ($errors->any() && old('_from_modal') === 'tambah')
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="">-- Pilih Role --</option>
                                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>superAdmin</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
    <script src="{{ asset('sb2/js/demo/datatables-demo.js') }}"></script>

    <script>
        $('#dataTableUsers').DataTable({
            paging: true,
            ordering: true,
            info: true,
            pageLength: 3,
            lengthMenu: [2, 3, 5, 10, 25, 50]
        });
        @if ($errors->any())
            $(document).ready(function() {
                var fromModal = "{{ old('_from_modal') }}";

                if (fromModal.startsWith('edit_')) {
                    var userId = fromModal.split('_')[1];
                    $('#editModal' + userId).modal('show');
                } else if (fromModal === 'tambah') {
                    $('#tambahUserModal').modal('show');
                }
            });
        @endif
    </script>
@endsection
@endif
