@extends('layouts.index')

@section('content1')

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Topbar -->
                    @include('layouts.topbar')

                    <!-- Main Content -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 mx-auto">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                                        <button type="button" class="btn-close border-0"
                                            onclick="window.history.length > 1 ? window.history.back() : window.location.href='{{ route('usershome') }}'"
                                            aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-4">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=128"
                                                alt="Profile Picture" class="rounded-circle img-fluid"
                                                style="width: 128px; height: 128px;">
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label fw-bold">Full Name</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext mb-0">: {{ Auth::user()->name }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label fw-bold">Email Address</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext mb-0">: {{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label fw-bold">Role</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext mb-0">: {{ Auth::user()->role ?? 'User' }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                                data-target="#changeprofilModal">
                                                Edit Profile
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                                data-target="#changePasswordModal">
                                                Change Password
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                data-target="#deleteAccountModal">
                                                Delete Account
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website {{ date('Y') }}</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Modal: Change Profil -->
        <div class="modal fade" id="changeprofilModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="changeprofilModalLabel">Change profil</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">rename</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password(opsional)</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal: Change Password -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" required>
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal: Delete Account -->
        <div class="modal fade" id="deleteAccountModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteAccountModalLabel">Delete Account</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                        <p class="text-danger fw-bold">All your data will be permanently deleted.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{ route('profile.destroy') }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
@endsection

@section('scripts')
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. AJAX: Edit Profile
            document.getElementById('editProfileForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const url = "{{ route('profile.update') }}";

                // Reset error messages
                document.querySelectorAll('#error-name, #error-email').forEach(el => el.textContent = '');

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success!', data.message, 'success').then(() => {
                                location.reload(); // atau update UI tanpa reload
                            });
                        } else {
                            if (data.errors?.name) document.getElementById('error-name').textContent =
                                data.errors.name[0];
                            if (data.errors?.email) document.getElementById('error-email').textContent =
                                data.errors.email[0];
                            if (data.message) Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                        console.error('Error:', error);
                    });
            });

            // 2. AJAX: Change Password
            document.getElementById('changePasswordForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const url = "{{ route('profile.update') }}";

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success!', data.message, 'success').then(() => {
                                $('#changePasswordModal').modal('hide');
                                this.reset();
                            });
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to update password.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                        console.error('Error:', error);
                    });
            });

            // 3. AJAX: Delete Account
            document.getElementById('deleteAccountForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const url = "{{ route('profile.destroy') }}";

                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', data.message, 'success').then(() => {
                                window.location.href = "{{ url('/') }}";
                            });
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to delete account.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'Invalid password or something went wrong.', 'error');
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
