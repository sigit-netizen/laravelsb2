@extends('base.index')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Charts</h1>
    <p class="mb-4">Chart laporan hasil panen berdasarkan tahun dan jenis tanaman</p>

    <!-- FILTER -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label>Tahun</label>
            <select id="filterTahun" class="form-control">
                <option value="2024">2024</option>
                <option value="2025" selected>2025</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Jenis Tanaman</label>
            <select id="filterTanaman" class="form-control">
                <option value="padi" selected>Padi</option>
                <option value="jagung">Jagung</option>
            </select>
        </div>
    </div>

    <!-- CHART -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chart Hasil Panen</h6>
        </div>
        <div class="card-body">
            <div class="chart-area" style="height:300px">
                <canvas id="chartpanen"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js-in')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ============================
            // DATA DUMMY TERSTRUKTUR
            // ============================
            const dataPanen = {
                2024: {
                    padi:   [80, 100, 120, 160, 180, 200],
                    jagung: [60, 90, 110, 140, 160, 180]
                },
                2025: {
                    padi:   [100, 150, 200, 280, 300, 470],
                    jagung: [90, 130, 170, 220, 260, 300]
                }
            };

            const bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"];

            const ctx = document.getElementById("chartpanen").getContext("2d");

            // ============================
            // INIT CHART
            // ============================
            const chartPanen = new Chart(ctx, {
                type: "line",
                data: {
                    labels: bulan,
                    datasets: [{
                        label: "Padi - 2025",
                        data: dataPanen[2025].padi,
                        backgroundColor: "rgba(40, 167, 69, 0.2)",
                        borderColor: "rgba(40, 167, 69, 1)",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Hasil Panen (Kg)"
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    return ctx.parsed.y + " Kg";
                                }
                            }
                        }
                    }
                }
            });

            // ============================
            // UPDATE CHART FUNCTION
            // ============================
            function updateChart() {
                const tahun   = document.getElementById("filterTahun").value;
                const tanaman = document.getElementById("filterTanaman").value;

                chartPanen.data.datasets[0].data =
                    dataPanen[tahun][tanaman];

                chartPanen.data.datasets[0].label =
                    tanaman.charAt(0).toUpperCase() + tanaman.slice(1) +
                    " - " + tahun;

                // WARNA DINAMIS
                if (tanaman === "padi") {
                    chartPanen.data.datasets[0].borderColor = "rgba(40, 167, 69, 1)";
                    chartPanen.data.datasets[0].backgroundColor = "rgba(40, 167, 69, 0.2)";
                } else {
                    chartPanen.data.datasets[0].borderColor = "rgba(255, 193, 7, 1)";
                    chartPanen.data.datasets[0].backgroundColor = "rgba(255, 193, 7, 0.2)";
                }

                chartPanen.update();
            }

            // ============================
            // EVENT LISTENER
            // ============================
            document.getElementById("filterTahun").addEventListener("change", updateChart);
            document.getElementById("filterTanaman").addEventListener("change", updateChart);

        });
    </script>
@endsection
