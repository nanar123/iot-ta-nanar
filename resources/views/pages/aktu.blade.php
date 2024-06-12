@extends('layouts.Dashboard')

@section('isi content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="bi bi-lightbulb fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-3">Lampu Depan</p>
                    <button type="button" class="btn btn-outline-info btn-on" data-status="on">ON</button>
                    <button type="button" class="btn btn-outline-info btn-off" data-status="off">OFF</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="bi bi-lightbulb fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-3">Lampu Tengah</p>
                    <button type="button" class="btn btn-outline-info ">ON</button>
                    <button type="button" class="btn btn-outline-info ">OFF</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="bi bi-lightbulb fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-3">Lampu Dapur</p>
                    <button type="button" class="btn btn-outline-info ">ON</button>
                    <button type="button" class="btn btn-outline-info ">OFF</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="bi bi-volume-up fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-3">Buzzer</p>
                    <button type="button" class="btn btn-outline-info ">ON</button>
                    <button type="button" class="btn btn-outline-info ">OFF</button>
                </div>
            </div>
        </div>

{{-- Data Lampu --}}
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4"> Data Lampu</h6>
                <table class="table table-hover" style="background-color: #001f3f;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Value</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamps->take(7) as $lamp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lamp->name }}</td>
                            <td>{{ $lamp->value }}</td>
                            <td>{{ $lamp->status }}</td>
                            <td>{{ $lamp->created_at->format('d M Y, H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($lamps->count() > 7)
                <div id="fullLampTable" style="display: none;">
                    <table class="table table-hover" style="background-color: #001f3f;">
                        <caption class="text-center">All Data</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Value</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lamps->skip(7) as $lamp)
                            <tr>
                                <td>{{ $loop->iteration + 7 }}</td>
                                <td>{{ $lamp->name }}</td>
                                <td>{{ $lamp->value }}</td>
                                <td>{{ $lamp->status }}</td>
                                <td>{{ $lamp->created_at->format('d M Y, H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button id="toggleLampButton" class="btn btn-primary" onclick="toggleTable('fullLampTable', 'toggleLampButton')">Show All</button>
                @endif
            </div>
        </div>

{{-- Data Buzzer --}}
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Data Buzzer</h6>
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
                        @foreach ($buzzers->take(7) as $buzzer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $buzzer->value }}</td>
                            <td>{{ $buzzer->status }}</td>
                            <td>{{ $buzzer->created_at->format('d M Y, H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($buzzers->count() > 7)
                <div id="fullBuzzerTable" style="display: none;">
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
                            @foreach ($buzzers->skip(7) as $buzzer)
                            <tr>
                                <td>{{ $loop->iteration + 7 }}</td>
                                <td>{{ $buzzer->value }}</td>
                                <td>{{ $buzzer->status }}</td>
                                <td>{{ $buzzer->created_at->format('d M Y, H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button id="toggleBuzzerButton" class="btn btn-primary" onclick="toggleTable('fullBuzzerTable', 'toggleBuzzerButton')">Show All</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnOn = document.querySelector('.btn-on');
        const btnOff = document.querySelector('.btn-off');

        btnOn.addEventListener('click', function() {
            // Send request to turn on the lamp
            sendRequest('on');
        });

        btnOff.addEventListener('click', function() {
            // Send request to turn off the lamp
            sendRequest('off');
        });

        function sendRequest(status) {
            // You can send an AJAX request to your backend here to control the lamp
            // Example AJAX request with Fetch API:
            fetch('/lamp-control', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Add any necessary headers here
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                // Handle the response
                if (response.ok) {
                    console.log('Lamp control successful');
                } else {
                    console.error('Error controlling lamp');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
</script>
@endpush
