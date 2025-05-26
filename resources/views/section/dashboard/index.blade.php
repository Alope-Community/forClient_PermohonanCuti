@extends('layouts.main')

@section('content')
    <div class="main p-4 ms-3 mt-3">
        <x-header-sections />
        <hr class="text-black">

        @if (auth()->user()->role == 'karyawan')
            @include('section.dashboard.karyawan')
        @else
            @include('section.dashboard.all')

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Grafik Pengajuan Cuti per Bulan ({{ now()->year }})</h5>
                            <canvas id="cutiChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <!-- Tambahkan Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('cutiChart').getContext('2d');
        const cutiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($cutiPerBulan)) !!},
                datasets: [{
                    label: 'Jumlah Pengajuan Cuti',
                    data: {!! json_encode(array_values($cutiPerBulan)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} pengajuan`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Cuti'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });
    </script>
@endsection
