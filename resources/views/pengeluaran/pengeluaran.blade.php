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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengeluaran Rumah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <div class="my-2">
                            <div class="my-2">
                                <label for="nama_pemilik">Nama</label>
                                <select class="form-select" id="nama_pemilik" name="nama_pemilik"
                                        aria-label="Default select example">
                                    @foreach($wargas as $warga)
                                        <option value="{{$warga->name}}">{{$warga->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="nama_pengeluaran">Nama Pengeluaran</label>
                                <input type="text" name="nama_pengeluaran" class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                                <input type="number" name="jumlah_pengeluaran" class="form-control" required>
                            </div>
                            <div class="my-2">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" class="form-select" name="kategori"
                                        aria-label="Default select example">
                                    <option value="barang">Barang</option>
                                    <option value="jasa">Jasa</option>
                                    <option value="lainya">lainya</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="my-2">
                                <label for="foto">Foto Pengeluaran</label>
                                <input type="file" name="foto" class="form-control" required>
                            </div>
                            <div class="col-lg">
                                <label for="tanggal_pengeluaran">Tanggal Pengeluaran</label>
                                <input type="date" name="tanggal_pengeluaran" class="form-control"
                                       placeholder="tanggal_pengeluaran"
                                       required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="add_warga" class="btn btn-primary">Simpan</button>
                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="emp_avatar" id="emp_avatar">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="my-2">
                                <label for="nama_pemilik">Nama</label>
                                <select id="nama_pemilik" class="form-select" name="nama_pemilik"
                                        aria-label="Default select example">
                                    @foreach($wargas as $warga)
                                        <option value="{{$warga->name}}">{{$warga->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-2">
                                <label for="nama_pengeluaran">Nama Pengeluaran</label>
                                <input type="text" name="nama_pengeluaran" id="nama_pengeluaran" class="form-control"
                                       required>
                            </div>
                            <div class="my-2">
                                <label for="jumlah_pengeluaran">Jumlah Pengeluaran</label>
                                <input type="number" name="jumlah_pengeluaran" id="jumlah_pengeluaran"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="kategori">Kategori</label>
                            <select id="kategori" class="form-select" name="kategori"
                                    aria-label="Default select example">
                                <option value="barang">Barang</option>
                                <option value="jasa">Jasa</option>
                                <option value="lainya">lainya</option>
                            </select>
                        </div>
                        <div class="my-2">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" class="form-control" required>
                        </div>
                        <div class="mt-2" id="foto">

                        </div>
                        <div class="my-2">
                            <label for="tanggal_pengeluaran">Tanggal Pengeluaran</label>
                            <input type="date" id="tanggal_pengeluaran" name="tanggal_pengeluaran" class="form-control"
                                   placeholder="tanggal_pemasukan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Data Pengeluaran
                        </button>
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
                        <h3 class="text-light">Data Pengeluaran</h3>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                                class="bi-plus-circle me-2"></i>Tambah Data Pengeluaran
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
                        url: '{{ route('pengeluaran.store') }}',
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
                                    'Pengeluaran Added Successfully!',
                                    'success'
                                )
                                fetchAllPengeluaran();
                            }
                            $("#add_employee_btn").text('Add Pengeluaran');
                            $("#add_employee_form")[0].reset();
                            $("#addEmployeeModal").modal('hide');
                        }
                    });
                });

                $(document).on('click', '.editIcon', function (e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '{{ route('pengeluaran.edit') }}',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (res) {
                            $("#nama_pengeluaran").val(res.nama_pengeluaran);
                            $("#jumlah_pengeluaran").val(res.jumlah_pengeluaran);
                            $("#foto").html(`<img src="storage/pengeluaran/${res.foto}" width="100" class="img-fluid img-thumbnail" alt="image">`)
                            $("#nama_pemilik").val(res.nama_pemilik);
                            $("#kategori").val(res.kategori);
                            $("#tanggal_pengeluaran").val(res.tanggal_pengeluaran);
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
                        url: '{{route("pengeluaran.update") }}',
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
                                    'Pengeluaran Data Updated Successfully!',
                                    'success'
                                )
                                fetchAllPengeluaran();
                            }
                            $("#edit_employee_btn").text('Update Data Pengeluaran');
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
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('pengeluaran.delete') }}',
                                method: 'delete',
                                data: {
                                    id: id,
                                    _token: csrf
                                },
                                success: function () {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your Data has been deleted.',
                                        'success'
                                    )
                                    fetchAllPengeluaran();
                                }
                            });
                        }
                    })
                });

                fetchAllPengeluaran();

                function fetchAllPengeluaran() {
                    $.ajax({
                        url: "{{ route('pengeluaran.fetchAll') }}",
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
