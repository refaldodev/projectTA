<?= $this->extend('admintemplate/template') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Periode </h6>
        </div>
        <div class="card-body">
            <!-- <a href="#" class="btn btn-default btn-md mb-3" data-toggle="modal" data-target="#modal-default"><i class=" fas fa-plus"></i> Tambah User</a> -->
            <a href="/periode/create" class="btn btn-danger btn-icon-split mb-3">
                <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Artikel</button> <br> <br> -->
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Periode</span>

            </a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Periode</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($periode as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['periode'] ?></td>
                                <td>
                                    <a href="/periode/edit/<?= $row['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                                    <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-outline-danger deletedata" onclick="hapus(<?= $row['id'] ?>)"><i class="far fa-trash-alt "></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- data penilaian dosen -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah anda yakin ingin menghapus data ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('periode/hapus') ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                                confirmButtonColor: '#3085d6',
                            }).then(response => {
                                if (response.value) {
                                    window.location.href = '/periode';

                                } else {
                                    window.location.href = '/periode';
                                }
                            })

                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                    }
                });

            }
        })
    }
</script>
<?= $this->endSection('') ?>