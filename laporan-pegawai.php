<?php
include "koneksi.php";
$judul = "Profile";
include "header.php";
?>

<div class="col">
    <div class="container">
        <div class="row">
            <div class="col">

                <h2>Profile of Employee Account</h2>
                <hr>
                <a href="cetak-laporan-pegawai.php" class="btn btn-sm btn-success text-white" target="_blank"><i class="fas fa-print"></i> Print Employee's Data</a>
                <hr>

                <table class="table table-bordered table-hover" id="laporanPegawai">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Employee's Name</th>
                            <th>Photo</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = "SELECT * FROM tbl_pegawai";
                        $query = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                            $photo          = $data['photo'];
                            $jenis_Kelamin  = $data['jenis_kelamin'];
                            if ($photo == "" && $jenis_Kelamin == "Laki-laki") {
                                $photo = "male.png";
                            } else if ($photo == "" && $jenis_Kelamin == "Perempuan") {
                                $photo = "female.png";
                            }
                        ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?>.</td>
                                <td><?= $data['nama_pegawai']; ?></td>
                                <td align="center"><img src="photo/<?= $photo; ?>" alt="photo" width="40" height="40"></td>
                                <td><?= $data['jenis_kelamin']; ?></td>
                                <td><?= $data['alamat']; ?></td>
                                <td><?= $data['telp']; ?></td>
                                <td><?= $data['jabatan']; ?></td>
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
<script>
    $(document).ready(function() {
        $('#laporanPegawai').dataTable();
        $('.form-control-chosen').chosen({
            allow_single_deselect: true,
        });
    });
</script>