@extends("layouts.app2")

@section("dashboard")
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'/>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css'/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css"/>
    {{-- add new employee modal start --}}
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="my-2">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                            <div class="col-lg">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" placeholder="tanggal_lahir"
                                       required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="my-2">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                <option value="Laki-Laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="my-2">
                            <label for="status_pernikahan">Status Pernikahan</label>
                            <select class="form-select" name="status_pernikahan" aria-label="Default select example">
                                <option value="Single">Single</option>
                                <option value="Menikah">Menikah</option>
                            </select>
                            <div class="my-2">
                                <label for="status_warga">Status Warga</label>
                                <select class="form-select" name="status_warga" aria-label="Default select example">
                                    <option value="Warga">Warga</option>
                                    <option value="Pindah">Bukan Warga</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="add_warga" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new employee modal end --}}

    {{-- edit employee modal start --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="emp_avatar" id="emp_avatar">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                       required>
                            </div>
                            <div class="my-2">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                            <div class="mt-2" id="foto">

                            </div>
                            <div class="my-2">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="col-lg">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                       placeholder="tanggal_lahir" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail"
                                   required>
                        </div>
                        <div class="my-2">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" class="form-select" name="jenis_kelamin"
                                    aria-label="Default select example">
                                <option value="Laki-Laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="my-2">
                            <label for="status_pernikahan">Status Pernikahan</label>
                            <select id="status_pernikahan" class="form-select" name="status_pernikahan"
                                    aria-label="Default select example">
                                <option value="Single">Single</option>
                                <option value="Menikah">Menikah</option>
                            </select>
                            <div class="my-2">
                                <label for="status_warga">Status Warga</label>
                                <select id="status_warga" class="form-select" name="status_warga"
                                        aria-label="Default select example">
                                    <option value="Warga">Warga</option>
                                    <option value="Pindah">Bukan Warga</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit employee modal end --}}

    <body class="bg-light">
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                        <h3 class="text-light">Data Warga</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                                class="bi-plus-circle me-2"></i>Tambah Data Warga
                        </button>
                    </div>
                    <div class="card-body" id="show_all_employees">
                        <h1 class="text-center text-secondary my-5"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push("js")
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script
            src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(function () {
                $("#add_employee_form").submit(function (e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#add_employee_btn").text('Adding...');
                    $.ajax({
                        url: '{{ route('warga.store') }}',
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 200) {
                                Swal.fire(
                                    'Added!',
                                    'Warga Data Added Successfully!',
                                    'success'
                                )
                                fetchAllWarga();
                            }
                            $("#add_employee_btn").text('Add Warga');
                            $("#add_employee_form")[0].reset();
                            $("#addEmployeeModal").modal('hide');
                        }
                    });
                });

                $(document).on('click', '.editIcon', function (e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('warga.edit') }}',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            $("#name").val(res.name);
                            $("#foto").html(`<img src="storage/warga/${res.foto}" width="100" class="img-fluid img-thumbnail" alt="image">`)
                            $("#alamat").val(res.alamat);
                            $("#tanggal_lahir").val(res.tanggal_lahir);
                            $("#email").val(res.email);
                            $("#status_pernikahan").val(res.status_pernikahan);
                            $("#status_warga").val(res.status_warga);
                            $("#jenis_kelamin").val(res.jenis_kelamin);
                            $("#emp_id").val(res.id);
                            $("#emp_avatar").val(res.foto);
                        }
                    })
                })

                $("#edit_employee_form").submit(function (e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#edit_employee_btn").text("Updating...");
                    $.ajax({
                        url: '{{route("warga.update") }}',
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 200) {
                                Swal.fire(
                                    'Updated!',
                                    'Rumah Data Updated Successfully!',
                                    'success'
                                )
                                fetchAllWarga();
                            }
                            $("#edit_employee_btn").text('Update Data');
                            $("#edit_employee_form")[0].reset();
                            $("#editEmployeeModal").modal('hide');
                        },
                    })
                });

                $(document).on('click', '.deleteIcon', function (e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    let csrf = '{{ csrf_token() }}';
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff2634',
                        cancelButtonColor: '#19be94',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('warga.delete') }}',
                                method: 'delete',
                                data: {
                                    id: id,
                                    _token: csrf
                                },
                                success: function () {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    fetchAllWarga();
                                }
                            });
                        }
                    })
                });

                fetchAllWarga();

                function fetchAllWarga() {
                    $.ajax({
                        url: "{{ route('warga.fetchAll') }}",
                        method: "GET",
                        success: function (data) {
                            $("#show_all_employees").html(data);
                            $("table").DataTable({
                                order: [0, 'desc']
                            });
                        }
                    });
                }
            });

        </script>

    @endpush
