@extends('layouts.dashboard')

@section('isi content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-secondary text-center rounded p-4">
                    <h4 class="card-title">Monitoring Temperature </h4>
                    <br>
                    <div id="chartsContainer" style="display: flex; justify-content: space-between;">
                        <div id="monitoringSuhu" style="width: 48%; height: 400px;"></div>
                        <div id="monitoringHum" style="width: 48%; height: 400px;"></div>
                    </div>
                    <br>
                    <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                </div>
            </div>

            <div class="col-sm-6 col-4">
                <div class="col-sm-12">
                    <div class="bg-secondary text-center rounded p-4">
                        <h4 class="card-title">Monitoring Gass </h4>
                        <br>
                        <div id="chartsContainer">
                            <div id="monitoringGas" style="width: %; height: px;"></div>
                        </div>
                        <br>
                        <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-4">
                <div class="col-sm-12">
                    <div class="bg-secondary text-center rounded p-4">
                        <h4 class="card-title">Monitoring Hujan </h4>
                        <br>
                        <div id="chartsContainer">
                            <div id="monitoringRain" style="width: %; height: px;"></div>
                        </div>
                        <br>
                        <p class="card-text"><small class="text-muted">Terakhir diubah 3 menit lalu</small></p>
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
        const updateInterval = 3000;

        async function requestSuhu() {
            // load data
            const result = await fetch("{{ route('api.sensors.temps.index') }}");
            // const result = await fetch("{{ route('api.sensors.rains.index') }}");
            // const result = await fetch("{{ route('api.sensors.temps.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const date = sensorData[0].created_at;
                const value = sensorData[0].temperature;

                // membuat point
                const point = [new Date(date).getTime(), Number(value)];

                // menambahkan point ke chart
                const series = chartSuhu.series[0],
                    shift = series.data.length > 20;
                // shift if the series is
                // longer than 20

                // add the point
                chartSuhu.series[0].addPoint(point, true, shift);

                setTimeout(requestSuhu, 3000); // 1000ms = 1 detik
            }
        }

        async function requestHum() {
            // load data
            const result = await fetch("{{ route('api.sensors.temps.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const date = sensorData[0].created_at;
                const value = sensorData[0].humidity;

                // membuat point
                const point = [new Date(date).getTime(), Number(value)];

                // menambahkan point ke chart
                const series = chartHum.series[0],
                    shift = series.data.length > 20;
                // shift if the series is
                // longer than 20

                // add the point
                chartHum.series[0].addPoint(point, true, shift);

                // refresh data setiap x detik
                setTimeout(requestHum, 3000); //1000ms = 1 detik
            }
        }

        async function requestGas() {
            // load data
            const result = await fetch("{{ route('api.sensors.mqs.index') }}");

            if (result.ok) {
                // cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const value = sensorData[0].value;

                if (chartGas && !chartGas.renderer.forExport) {
                    const point = chartGas.series[0].points[0];
                    point.update(Number(value));
                }

                setTimeout(requestGas, updateInterval);
            }
        }

        async function requestRain() {
            // load data
            const result = await fetch("{{ route('api.sensors.rains.index') }}");

             if (result.ok) {
                //cek jika berhasil
                const data = await result.json();
                const sensorData = data.data;

                // parse data
                const value = sensorData[0].value;

                if (chartRain && !chartRain.renderer.forExport) {
                    const point = chartRain.series[0].points[0];
                    point.update(Number(value));
                }

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
                        from: 120,
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
                    max: 1,
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
                        to: 1,
                        color: 'Blue',
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
