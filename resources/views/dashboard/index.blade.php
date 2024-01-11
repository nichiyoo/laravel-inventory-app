@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Dashboard
                        </div>
                        <h2 class="page-title">
                            Admin Dashboard
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="col-12 mb-4">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Price</div>
                                    </div>
                                    <div class="h1 mb-3">
                                        {{ sprintf('Rp. %s', number_format($total['price'], 0, ',', '.')) }}
                                    </div>
                                </div>
                                <div id="total-asset" class="chart-sm"></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Total Stock</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-3 me-2">
                                            {{ $total['stock'] }}
                                        </div>
                                    </div>
                                    <div id="total-stock" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Count Inventory</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-3 me-2">
                                            {{ $count['assets'] }}
                                        </div>
                                    </div>
                                    <div id="count-asset" class="chart-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Count User</div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="h1 mb-3 me-2">
                                            {{ $count['users'] }}
                                        </div>
                                    </div>
                                </div>
                                <div id="count-user" class="chart-sm"></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-box icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $callout['all'] }}
                                            </div>
                                            <div class="text-muted">
                                                Total Asset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-device-desktop icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $callout['hardware'] }}
                                            </div>
                                            <div class="text-muted">
                                                Total Hardware
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-components icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $callout['software'] }}
                                            </div>
                                            <div class="text-muted">
                                                Total Software
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-primary-lt text-white avatar">
                                                <i class="ti ti-mouse icon"></i>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $callout['peripheral'] }}
                                            </div>
                                            <div class="text-muted">
                                                Total Peripheral
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="card" style="height: 28rem">
                                        <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                            <div class="divide-y">
                                                @foreach ($assets as $asset)
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <span class="avatar">{{ $asset->initial }}</span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <strong>{{ $asset->name }}</strong>
                                                                <div class="text-muted">{{ $asset->description }}</div>
                                                            </div>
                                                            <div class="text-muted">
                                                                {{ $asset->items_count }} items
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="badge bg-primary">
                                                                {{ sprintf('Rp. %s', number_format($asset->price, 0, ',', '.')) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row row-cards">
                                <div class="col-12">
                                    <div class="card" style="height: 28rem">
                                        <div class="card-header border-0">
                                            <div class="card-title">Total Inventory</div>
                                        </div>
                                        <div class="p-5">
                                            <div id="main-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('total-asset'), {
                        chart: {
                            type: 'area',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 0.16,
                            type: 'solid',
                        },
                        stroke: {
                            width: 2,
                            lineCap: 'round',
                            curve: 'smooth',
                        },
                        series: [{
                            name: 'Asset Baru',
                            data: Object.values(@json($price)),
                        }, ],
                        tooltip: {
                            theme: 'dark',
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: Object.keys(@json($price)),
                        colors: [tabler.getColor('primary')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('total-stock'), {
                        chart: {
                            type: 'bar',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: 'New Stock',
                            data: Object.values(@json($stock)),
                        }, ],
                        tooltip: {
                            theme: 'dark',
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: Object.keys(@json($stock)),
                        colors: [tabler.getColor('primary')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
            // @formatter:on
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('count-asset'), {
                        chart: {
                            type: 'bar',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 1,
                        },
                        series: [{
                            name: 'New Asset',
                            data: Object.values(@json($casset)),
                        }, ],
                        tooltip: {
                            theme: 'dark',
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: Object.keys(@json($casset)),
                        colors: [tabler.getColor('primary')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('count-user'), {
                        chart: {
                            type: 'area',
                            fontFamily: 'inherit',
                            height: 40.0,
                            sparkline: {
                                enabled: true,
                            },
                            animations: {
                                enabled: false,
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        fill: {
                            opacity: 0.16,
                            type: 'solid',
                        },
                        stroke: {
                            width: 2,
                            lineCap: 'round',
                            curve: 'smooth',
                        },
                        series: [{
                            name: 'New User',
                            data: Object.values(@json($cuser)),
                        }, ],
                        tooltip: {
                            theme: 'dark',
                        },
                        grid: {
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4,
                            },
                        },
                        labels: Object.keys(@json($cuser)),
                        colors: [tabler.getColor('primary')],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.ApexCharts &&
                    new ApexCharts(document.getElementById('main-chart'), {
                        chart: {
                            type: "line",
                            fontFamily: 'inherit',
                            height: 320,
                            parentHeightOffset: 0,
                            toolbar: {
                                show: false,
                            },
                            animations: {
                                enabled: false
                            },
                        },
                        fill: {
                            opacity: 1,
                        },
                        stroke: {
                            width: 2,
                            lineCap: "round",
                            curve: "smooth",
                        },
                        series: [{
                            name: "Total Harga",
                            data: Object.values(@json($price)),
                        }],
                        tooltip: {
                            theme: 'dark'
                        },
                        grid: {
                            padding: {
                                top: -20,
                                right: 0,
                                left: -4,
                                bottom: -4
                            },
                            strokeDashArray: 4,
                        },
                        xaxis: {
                            labels: {
                                padding: 0,
                            },
                            tooltip: {
                                enabled: false
                            },
                            type: 'datetime',
                        },
                        yaxis: {
                            labels: {
                                padding: 4
                            },
                        },
                        labels: Object.keys(@json($price)),
                        colors: [tabler.getColor("primary")],
                        legend: {
                            show: false,
                        },
                    }).render();
            });
        </script>
    @endpush
@endsection
