@extends('layouts.Dashboard')

@section('isi content')

    <!-- Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"> Monitoring Gas </h6>
                    <canvas id="monigas"></canvas>
                </div>
            </div>

            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Sensor Suhu</h6>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- Chart End -->
@endsection

@push('name')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        let chargas; // global

        /**
         * Request data from the server, add it to the graph and set a timeout to
         * request again
         */
        async function requestData() {
            const result = await fetch('https://demo-live-data.highcharts.com/time-rows.json');
            if (result.ok) {
                const data = await result.json();

                const [date, value] = data[0];
                const point = [new Date(date).getTime(), value * 10];
                const series = chartgas.series[0],
                    shift = series.data.length > 20; // shift if the series is
                // longer than 20

                // add the point
                chartgas.series[0].addPoint(point, true, shift);
                // call it again after one second
                setTimeout(requestData, 1000);
            }
        }

        window.addEventListener('load', function() {
            chartgas = new Highcharts.Chart({
                chartgas: {
                    renderTo: 'monigas',
                    defaultSeriesType: 'spline',
                    events: {
                        load: requestData
                    }
                },
                title: {
                    text: 'Live random data'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Value',
                        margin: 80
                    }
                },
                series: [{
                    name: 'Random data',
                    data: []
                }]
            });
        });
    </script>
@endpush
