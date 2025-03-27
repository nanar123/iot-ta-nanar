@extends('layouts.dashboard')

@section('isi content')
    <!--Card Start -->
    {{-- <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
       <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-cloud-rain fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Jumlah Hujan</p>
                    <h6 class="mb-0">{{ $jumlahData }}</h6> <!-- Menampilkan total jumlah hujan -->
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Sale</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Today Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Revenue</p>
                    <h6 class="mb-0">$1234</h6>
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <!-- Card End -->


    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light text-dark text-center rounded p-4">
                    <h4 class="card-title">Monitoring Temperature</h4>
                    <br>
                    <div id="monitoringSuhu" style="width: 100%; height: 300px;"></div>
                    <br>
                    <p class="card-text"><small class="text-muted">Terakhir diubah Chart Suhu</small></p>
                </div>

                <br>
                <div class="bg-light text-center rounded p-4">
                    <h4 class="card-title">Monitoring Humidity</h4>
                    <br>
                    <div id="monitoringHum" style="width: 100%; height: 300px;"></div>
                    <br>
                    <p class="card-text"><small class="text-muted">Terakhir diubah Chart Kelembaban</small></p>
                </div>
            </div>

            <div class="col-sm-6 col-4">
                <div class="col-sm-12">
                    <div class="bg-light text-center rounded p-4">
                        <h4 class="card-title">Monitoring Gass </h4>
                        <br>
                        <div id="chartsContainer">
                            <div id="monitoringGas" style="width: %; height: px;"></div>
                        </div>
                        <br>
                        <p class="card-text"><small class="text-muted">Terakhir diubah Gauge Gas</small></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-4">
                <div class="col-sm-12">
                    <div class="bg-light text-center rounded p-4">
                        <h4 class="card-title">Monitoring Hujan </h4>
                        <br>
                        <div id="chartsContainer">
                            <div id="monitoringRain" style="width: %; height: px;"></div>
                        </div>
                        <br>
                        <p class="card-text"><small class="text-muted">Terakhir diubah Gauge Hujan</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        let chartSuhu;
        let chartHum;
        let chartGas;
        let chartRain;
        const updateInterval = 5000;

        async function requestSuhu() {
            try {
                const result = await fetch("{{ route('temps.index') }}");

                if (!result.ok) throw new Error("Gagal mengambil data");

                const data = await result.json();
                const sensorData = data.data;

                if (!sensorData || sensorData.length === 0) return;

                const date = sensorData[0].created_at;
                const value = sensorData[0].temperature;

                if (!date || isNaN(value)) return;

                const point = [new Date(date).getTime(), Number(value)];

                // Ambil data lama dari localStorage
                let storedData = JSON.parse(localStorage.getItem("chartData")) || [];
                storedData.push(point);

                // Batasi jumlah data agar tidak terlalu besar
                if (storedData.length > 25) storedData.shift();

                // Simpan kembali ke localStorage
                localStorage.setItem("chartData", JSON.stringify(storedData));

                // Pastikan chart sudah ada sebelum update
                if (chartSuhu && chartSuhu.series.length > 0) {
                    chartSuhu.series[0].setData(storedData, true);
                }

                setTimeout(requestSuhu, 5000);
            } catch (error) {
                console.error("Error mengambil data suhu:", error);
                setTimeout(requestSuhu, 5000);
            }
        }


        async function requestHum() {
            try {
                const result = await fetch("{{ route('temps.index') }}");

                if (!result.ok) throw new Error("Gagal mengambil data");

                const data = await result.json();
                const sensorData = data.data;

                if (!sensorData || sensorData.length === 0) return;

                const date = sensorData[0].created_at;
                const value = sensorData[0].humidity;

                if (!date || isNaN(value)) return;

                const point = [new Date(date).getTime(), Number(value)];

                // Ambil data lama dari localStorage
                let storedData = JSON.parse(localStorage.getItem("chartHumData")) || [];
                storedData.push(point);

                // Batasi jumlah data agar tidak terlalu besar
                if (storedData.length > 25) storedData.shift();

                // Simpan kembali ke localStorage
                localStorage.setItem("chartHumData", JSON.stringify(storedData));

                // Pastikan chart sudah ada sebelum update
                if (chartHum && chartHum.series.length > 0) {
                    chartHum.series[0].setData(storedData, true);
                }

                setTimeout(requestHum, 5000);
            } catch (error) {
                console.error("Error mengambil data humidity:", error);
                setTimeout(requestHum, 5000);
            }
        }


        async function requestGas() {
            try {
                const result = await fetch("{{ route('mqs.index') }}");

                if (!result.ok) throw new Error("Gagal mengambil data");

                const data = await result.json();
                const sensorData = data.data;

                if (!sensorData || sensorData.length === 0) return;

                const value = sensorData[0].value;
                if (isNaN(value)) return;

                // Simpan nilai terbaru di localStorage
                localStorage.setItem("lastGasValue", value);

                // Perbarui chart jika tersedia
                if (chartGas && chartGas.series.length > 0) {
                    const point = chartGas.series[0].points[0];
                    if (point) point.update(Number(value));
                }

                setTimeout(requestGas, updateInterval);
            } catch (error) {
                console.error("Error mengambil data gas:", error);
                setTimeout(requestGas, updateInterval);
            }
        }


        async function requestRain() {
            try {
                const result = await fetch("{{ route('rains.index') }}");

                if (!result.ok) throw new Error("Gagal mengambil data");

                const data = await result.json();
                const sensorData = data.data;

                if (!sensorData || sensorData.length === 0) return;

                const value = sensorData[0].value;
                if (isNaN(value)) return;

                // Simpan nilai terbaru di localStorage
                localStorage.setItem("lastRainValue", value);

                // Perbarui chart jika tersedia
                if (chartRain && chartRain.series.length > 0) {
                    const point = chartRain.series[0].points[0];
                    if (point) point.update(Number(value));
                }

                setTimeout(requestRain, updateInterval);
            } catch (error) {
                console.error("Error mengambil data hujan:", error);
                setTimeout(requestRain, updateInterval);
            }
        }








        window.addEventListener('load', function() {
            chartSuhu = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringSuhu',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestSuhu
                    }
                },
                title: {
                    text: 'Live Suhu'
                },
                time: {
                    timezone: 'Asia/Jakarta', // Atur timezone Jakarta
                    useUTC: false // Nonaktifkan UTC
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 100,
                    maxZoom: 10 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value Suhu',
                        margin: 10
                    }
                },
                series: [{
                    name: 'Suhu',
                    data: []
                }]
            });


            chartHum = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringHum',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestHum
                    }
                },
                time: {
                    timezone: 'Asia/Jakarta', // Atur timezone Jakarta
                    useUTC: false // Nonaktifkan UTC
                },
                title: {
                    text: 'Live Kelembaban'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 100,
                    maxZoom: 10 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value Kelembaban',
                        margin: 10
                    }
                },
                series: [{
                    name: 'Kelembaban',
                    data: []
                }]
            });


            chartGas = new Highcharts.Chart({

                chart: {
                    renderTo: 'monitoringGas',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestGas
                    }
                },

                title: {
                    text: 'MqGass'
                },

                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },

                // the value axis
                yAxis: {
                    min: 0,
                    max: 300,
                    tickPixelInterval: 72,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [{
                        from: 0,
                        to: 130,
                        color: '#55BF3B', // green
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 130,
                        to: 250,
                        color: '#DDDF0D', // yellow
                        thickness: 20
                    }, {
                        from: 250,
                        to: 300,
                        color: '#DF5353', // red
                        thickness: 20,
                        borderRadius: '50%'
                    }]
                },

                series: [{
                    name: 'monitoringGas',
                    data: [0],
                    tooltip: {
                        valueSuffix: 'ppm'
                    },
                    dataLabels: {
                        format: '{y} PPM',
                        borderWidth: 0,
                        color: (
                            Highcharts.defaultOptions.title &&
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }

                }]

            });


            chartRain = new Highcharts.Chart({

                chart: {
                    renderTo: 'monitoringRain',
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%',
                    events: {
                        load: requestRain
                    }
                },

                title: {
                    text: 'Rain'
                },

                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },

                // the value axis
                yAxis: {
                    min: 0,
                    max: 100,
                    tickPixelInterval: 72,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [{
                        from: 0,
                        to: 35,
                        color: '#FFFF00', // yelloow
                        thickness: 20,
                        borderRadius: '50%'
                    }, {
                        from: 35,
                        to: 65,
                        color: '#00FFFF', // blue
                        thickness: 20
                    }, {
                        from: 65,
                        to: 100,
                        color: '#0000FF', // blue
                        thickness: 20,
                        borderRadius: '50%'
                    }]
                },

                series: [{
                    name: 'monitoringRain',
                    data: [0],
                    tooltip: {
                        valueSuffix: 'mm'
                    },
                    dataLabels: {
                        format: '{y} MM',
                        borderWidth: 0,
                        color: (
                            Highcharts.defaultOptions.title &&
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }
                }]
            });
        });
    </script>
@endpush
