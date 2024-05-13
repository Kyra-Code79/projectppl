<?php
include "koneksi.php";
$judul = "MENU";
include "header.php";
include "konfirmasi.php";
?>

<div class="col">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Table List Report</h2>
                <hr>
                <button type="button" class="badge badge-primary p-2 mb-3" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fas fa-plus"></i> Add
                </button>

                <?php konfirmasi(); ?>
                <table class="table table-bordered table-hover" id="menu">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Id Table</th>
                            <th>Name Table</th>
                            <th>QRCode</th>
                            <th>Generate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no         = 1;
                        $sql         = "SELECT * FROM tbl_table";
                        $query     = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?>.</td>
                                <td><?= $data['id']; ?></td>
                                <td><?= $data['nama_table']; ?></td>
                                <td align="center">
                                    <img src="data:image/jpeg;base64, <?= $data['QRCode']; ?>" width="200" height="200">
                                </td>
                                <td align="center">
                                    <a href="table-generate.php?id=<?= $data['id'] ?>" class="badge badge-primary p-2" title="Generate"><i class="fas fa-fw fa-cog"></i></a> |
                                    <a href="cetak-QRCode.php?id=<?= $data['id'] ?>" class="badge badge-primary p-2" title="Cetak"><i class="fas fa-print"></i></a>

                                </td>
                                <td align="center" width="25%">
                                    <a href="table-edit.php?id=<?= $data['id']; ?>" class="badge badge-primary p-2" title="Edit"><i class="fas fa-edit"></i></a> |
                                    <a href="table-delete.php?id=<?= $data['id']; ?>" onclick="return confirm('Data akan dihapus?');" class="badge badge-danger p-2" title='Delete'><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
<!-- Modal Tambah-->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Input Master Menu
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="table-simpan.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
                    <div class="input-group mb-1">
                        <span class="input-group-text lebar">Nama Table</span>
                        <input type="text" name="nama_table" required autocomplete="off" class="form-control form-control-sm" placeholder="Input Nama Table">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#menu').dataTable();
    });
</script>