@extends('layouts.dashboard')

@section('isi content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">User List</h4>
                <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="las la-plus ">
                    </i>Tambah</button>

                </button>

            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0"
                    style="background-color: #001f3f;">
                    <thead>
                        <tr class="text-white">
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d M Y, H:i:s') }}</td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a href="#"
                                           onclick="openEditModal({{ $user->id }})"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Edit User">
                                           <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="#"
                                           onclick="openDeleteModal({{ $user->id }})"
                                           data-bs-toggle="tooltip"
                                           data-bs-placement="top"
                                           title="Delete User"
                                           data-bs-confirm="Apakah Anda yakin ingin menghapus pengguna ini?">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- User List End -->

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark m-2" id="exampleModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="addName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="addName" aria-describedby="nameHelp">
                            <div id="nameHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="addEmail" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addUser()">Save </button>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    <script>
        let userId = null;

        // Saat buka modal, kosongkan form, hapus class is-invalid dan invalid-feedback
        $('#basicModal').on('show.bs.modal', function(e) {
            $('#addForm').trigger('reset');
            $('#addForm input').removeClass('is-invalid');
            $('#addForm .invalid-feedback').remove();
        });

        function createUser() {
            const url = "/api/users/store";

            // Ambil form data
            let data = {
                name: $('#addName').val(),
                email: $('#addEmail').val(),
                password: $('#addPassword').val(),
            };

            // Kirim data ke server POST /users
            $.post(url, data)
                .done((response) => {
                    // Tampilkan pesan sukses
                    toastr.success(response.message, 'Sukses');

                    // Reload halaman setelah 3 detik
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                })
                .fail((error) => {
                    // Ambil response error
                    let response = error.responseJSON;

                    // Tampilkan pesan error
                    toastr.error(response.message, 'Error');

                    // Tampilkan error validation
                    if (response.errors) {
                        // Loop object errors
                        for (const error in response.errors) {
                            // Cari input name yang error pada #addForm
                            let input = $(`#addForm input[name="${error}"]`);

                            // Tambahkan class is-invalid pada input
                            input.addClass('is-invalid');

                            // Buat elemen class="invalid-feedback"
                            let feedbackElement = `<div class="invalid-feedback">`;
                            feedbackElement += `<ul class="list-unstyled">`;
                            response.errors[error].forEach((message) => {
                                feedbackElement += `<li>${message}</li>`;
                            });
                            feedbackElement += `</ul>`;
                            feedbackElement += `</div>`;

                            // Tambahkan class invalid-feedback setelah input
                            input.after(feedbackElement);
                        }
                    }
                });
        }
    </script>
@endpush
