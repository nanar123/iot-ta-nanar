@extends('layouts.dashboard')

@section('isi content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            {{-- SensorTemperature --}}
            <div class="col-sm-12 col-xl-0">
                <div class="bg-light rounded h-100 p-4">
                    <h5 class="mb-4">Data Sensor Suhu </h5>
                    <table id="table-temp" class="table table-info table-striped table-hover" style="background-color: white;">
                        <thead>
                            <tr class="text-dark">
                                <th>No</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temps as $temp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $temp->temperature }}</td>
                                    <td>{{ $temp->humidity }}</td>
                                    <td>{{ $temp->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            const fileTitle = 'Data_Sensor_Suhu_{{ now()->format("Ymd") }}';

            $('#table-temp').DataTable({
                dom: '<"d-flex justify-content-between"<"btn-toolbar"B><"search-box"f>>rtip',
                buttons: [{
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel" style="font-size: 18px;"></i> <span style="font-size: 14px;">Unduh Excel</span>',
                        className: 'btn btn-success',
                        title: fileTitle,
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf" style="font-size: 18px;"></i> <span style="font-size: 14px;">Unduh PDF</span>',
                        className: 'btn btn-danger',
                        title: fileTitle,
                    }
                ],
                language: {
                    search: "Cari: ",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    zeroRecords: "Tidak ada data yang ditemukan",
                }
            });
        });
    </script>
@endpush
