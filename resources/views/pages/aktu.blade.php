@extends('layouts.Dashboard')

@section('isi content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i class="bi bi-lightbulb fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-3">Lampu Depan</p>
                    <button type="button" class="btn btn-outline-info ">ON</button>
                    <button type="button" class="btn btn-outline-info ">OFF</button>
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

    </div>
</div>
@endsection
