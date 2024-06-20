@extends('layouts.dashboard')

@section('isi content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
{{-- SensorRain --}}
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Sensor Rain</h6>
                    <br>
                    <table class="table table-hover" style="background-color: #001f3f;">
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

                    @if ($rains->count() > 7)
                        <div id="fullRainTable" style="display: none;">
                            <table class="table table-hover" style="background-color: #001f3f;">
                                <caption class="text-center">All Data</caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rains->skip(7) as $rain)
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
                        <button id="toggleRainButton" class="btn btn-primary"
                            onclick="toggleTable('fullRainTable', 'toggleRainButton')">Show All</button>
                    @endif
                </div>
            </div>


{{-- SensorTemperature --}}
            <div class="col-sm-12 col-xl-6">
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
            </div>

{{-- SensorMQ --}}
            <div class="col-sm-12 col-xl-6">
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
            </div>
        </div>
    </div>

    <script>
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
    </script>
@endsection
