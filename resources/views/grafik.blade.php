@extends('base.index')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Charts</h1>
    <p class="mb-4">Chart laporan hasil panen yang telah diinput</p>
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
@endsection
@section('js-in')
    <!-- Page level custom scripts -->
    <script src="{{ asset('sb2/js/demo/chart-area-demo.js') }}"></script>
@endsection
