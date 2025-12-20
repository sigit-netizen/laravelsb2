@extends('layouts.format')

@section('content1')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang!</h1>
    </div>

    <!-- Welcome Card -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard Selamat Datang</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-home fa-3x text-primary"></i>
                    </div>
                    <p class="lead">
                            Selamat datang di sistem kami. Silakan <a href="{{ route('login') }}">login</a> untuk melanjutkan.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
