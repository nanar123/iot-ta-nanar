@extends('layouts.dashboard')

@section('isi content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">User List</h4>
                <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-person-plus"></i>
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
                            <th>No Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Join Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if ($user->phone_number == null)
                                        <span class="badge badge-secondary">
                                            <i class="bi bi-telephone"></i></span>
                                    @else
                                        {{ $user->phone_number }}
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <span class="badge badge-primary">
                                            <i class="bi bi-person-gear" style="color: white; font-size: 1.5em;"></i>
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="bi bi-person" style="font-size: 1.5em;"></i>
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $user->created_at->format('d M Y, H:i:s') }}</td>
                                <td>
                                    <div class="flex align-items-center list-user-action">
                                        <a href="#" onclick="openEditModal('{{ $user->id }}')"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="#" onclick="deleteUser('{{ $user->id }}')"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User"
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

    <!-- Modal -->
    {{-- addUser --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark m-2" id="addModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="addName" class="form-label">Nama</label>
                            <input required type="text" class="form-control" id="addName" aria-describedby="nameHelp">
                            <div id="nameHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addNoPhone" class="form-label">No Phone</label>
                            <input required type="text" class="form-control" id="addNoPhone"
                                aria-describedby="nomorHelp">
                            <div id="NoPhoneHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email address</label>
                            <input required type="email" class="form-control" id="addEmail" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="addRole" class="form-label">Role</label>
                            <select class="form-control" id="addRole" name="role">
                                <option value="admin">Admin</option>
                                <option value="user" selected>User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addPassword" class="form-label">Password</label>
                            <input required type="password" class="form-control" id="addPassword">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="createUser()">Save </button>
                </div>
            </div>
        </div>
    </div>

    {{-- //editUser --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark m-2" id="editModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama</label>
                            <input required type="text" class="form-control" id="editName"
                                aria-describedby="nameHelp">
                            <div id="nameHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editNoPhone" class="form-label">No Phone</label>
                            <input required type="text" class="form-control" id="editNoPhone"
                                aria-describedby="nomorHelp">
                            <div id="NoPhoneHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email address</label>
                            <input required type="email" class="form-control" id="editEmail"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-control" id="editRole" name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editPassword" class="form-label">Password</label>
                            <input required type="password" class="form-control" id="editPassword">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editUser()">Save </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let userId = null;

        // Saat buka modal, kosongkan form, hapus class is-invalid dan invalid-feedback
        $('#addModal').on('show.bs.modal', function(e) {
            $('#addForm').trigger('reset');
            $('#addForm input').removeClass('is-invalid');
            $('#addForm .invalid-feedback').remove();
        });

        $('#editModal').on('show.bs.modal', function(e) {
            $('#addForm').trigger('reset');
            $('#editForm input').removeClass('is-invalid');
            $('#editForm .invalid-feedback').remove();
        });

        function createUser() {
            const url = "{{ route('api.users.store') }}";

            // Ambil form data
            let data = {
                name: $('#addName').val(),
                email: $('#addEmail').val(),
                password: $('#addPassword').val(),
                role: $('#addRole').val(),
                phone_number: $('#addNoPhone').val(),
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
                });
        }

        function editUser() {
            let url = "{{ route('api.users.update', ':userId') }}";
            url = url.replace(':userId', userId);

            // Ambil form data
            let data = {
                name: $('#editName').val(),
                email: $('#editEmail').val(),
                password: $('#editPassword').val(),
                role: $('#editRole').val(),
                phone_number: $('#editNoPhone').val(),
                _method: 'PUT'

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
                });

            if (response.errors) {
                // loop object errors
                for (const error in response.errors) {
                    // cari input name yang error pada #editForm
                    let input = $(`#editForm input[name="${error}"]`)

                    // tambahkan class is-invalid pada input
                    input.addClass('is-invalid');

                    // buat elemen class="invalid-feedback"
                    let feedbackElement = `<div class="invalid-feedback">`
                    feedbackElement += `<ul class="list-unstyled">`
                    response.errors[error].forEach((message) => {
                        feedbackElement += `<li>${message}</li>`
                    })
                    feedbackElement += `</ul>`
                    feedbackElement += `</div>`

                    // tambahkan class invalid-feedback setelah input
                    input.after(feedbackElement)
                }
            }

        }

        function deleteUser(userId) {

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'User akan dihapus, kamu tidak bisa mengembalikannya lagi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    let url = "{{ route('api.users.destroy', ':userId') }}";
                    url = url.replace(':userId', userId);

                    $.post(url, {
                            _method: 'DELETE'
                        })
                        .done((response) => {
                            toastr.success(response.message, 'Sukses')

                            setTimeout(() => {
                                location.reload()
                            }, 1000);
                        })
                        .fail((error) => {
                            toastr.error('Gagal menghapus user', 'Error')
                        })
                }
            })
        }

        function openEditModal(id) {
            userId = id;

            let url = '{{ route('api.users.show', ':userId') }}';
            url = url.replace(':userId', userId);

            $.get(url)
                .done((response) => {
                    // isi form editModal dengan data user
                    $('#editName').val(response.data.name);
                    $('#editEmail').val(response.data.email);
                    $('#editRole').val(response.data.role);
                    $('#editNoPhone').val(response.data.phone_number);

                    // tampilkan modal editModal
                    $('#editModal').modal('show');
                })
                .fail((error) => {
                    // tampilkan pesan error
                    toastr.error('Gagal mengambil data user', 'Error')
                })


        }
    </script>
@endpush
