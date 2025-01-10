@extends('layouts.dashboard')

@section('isi content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            {{-- SensorRain --}}
            <div class="col-sm-12 col-xl-0">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Sensor Rain</h6>

                    <table id="table-rain" class="table table-hover" style="background-color: white;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Value</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rains->take(7) as $rain)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rain->value }}</td>
                                    <td>{{ $rain->weather }}</td>
                                    <td>{{ $rain->created_at->format('d M Y, H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>


            {{-- SensorTemperature --}}
            {{-- <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Sensor Temperature</h6>
                    <br>
                    <table class="table table-hover" style="background-color: #001f3f;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temps->take(7) as $temp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $temp->temperature }}</td>
                                    <td>{{ $temp->humidity }}</td>
                                    <td>{{ $temp->created_at->format('d M Y, H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($temps->count() > 7)
                        <div id="fullTempTable" style="display: none;">
                            <table class="table table-hover" style="background-color: #001f3f;">
                                <caption class="text-center">All Data</caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Temperature</th>
                                        <th>Humidity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($temps->skip(7) as $temp)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $temp->temperature }}</td>
                                            <td>{{ $temp->humidity }}</td>
                                            <td>{{ $temp->created_at->format('d M Y, H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="toggleTempButton" class="btn btn-primary"
                            onclick="toggleTable('fullTempTable', 'toggleTempButton')">Show All</button>
                    @endif
                </div>
            </div> --}}

            {{-- SensorMQ --}}
            {{-- <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Sensor MQ</h6>
                    <table class="table table-hover" style="background-color: #001f3f;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Value</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mqs->take(7) as $mq)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mq->value }}</td>
                                    <td>{{ $mq->status }}</td>
                                    <td>{{ $mq->created_at->format('d M Y, H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($mqs->count() > 7)
                        <div id="fullMqTable" style="display: none;">
                            <table class="table table-hover" style="background-color: #001f3f;">
                                <caption class="text-center">All Data</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mqs->skip(7) as $mq)
                                        <tr>
                                            <td>{{ $loop->iteration + 7 }}</td>
                                            <td>{{ $mq->value }}</td>
                                            <td>{{ $mq->status }}</td>
                                            <td>{{ $mq->created_at->format('d M Y, H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button id="toggleMqButton" class="btn btn-primary"
                            onclick="toggleTable('fullMqTable', 'toggleMqButton')">Show All</button>
                    @endif
                </div>
            </div> --}}
        </div>
    </div>

    {{-- <script>
        function toggleTable(tableId, buttonId) {
            var fullTable = document.getElementById(tableId);
            var toggleButton = document.getElementById(buttonId);

            if (fullTable.style.display === "none") {
                fullTable.style.display = "block";
                toggleButton.textContent = "Show Less";
            } else {
                fullTable.style.display = "none";
                toggleButton.textContent = "Show All";
            }
        }
    </script> --}}
@endsection



@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.4/css/dataTables.dateTime.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.4/js/dataTables.dateTime.min.js"></script>

    <script>
        new DataTable('#table-rain');
        let minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        DataTable.ext.search.push(function(settings, data, dataIndex) {
            let min = minDate.val();
            let max = maxDate.val();
            let date = new Date(data[4]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });

        // Create date inputs
        minDate = new DateTime('#min', {
            format: 'd M Y, H:i:s'
        });
        maxDate = new DateTime('#max', {
            format: 'd M Y, H:i:s'
        });

        // DataTables initialisation
        let table = new DataTable('#example');

        // Refilter the table
        document.querySelectorAll('#min, #max').forEach((el) => {
            el.addEventListener('change', () => table.draw());
        });
    </script>
@endpush
