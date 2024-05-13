<?php
include "koneksi.php";
$judul = "Transaction Report";
include "header.php";
?>

<div class="col">
    <div class="container">
        <div class="row">
            <div class="col">

                <h2>Transactions Report</h2>
                <hr>
                <form action="cetak-transaksi.php" method="post" target="_blank">
                    <div class="input-group mb-1">
                        <span class="input-group-text lebar">From</span>
                        <input type="date" name="periodeDari" id="periodeDari" class="form-control form-control-sm" value="<?= $tglHariIni; ?>">

                        <span class="input-group-text lebar">Until</span>
                        <input type="date" name="periodeSampai" id="periodeSampai" class="form-control form-control-sm" value="<?= $tglHariIni; ?>">

                        <?php
                        if ($jabatan != "Kasir") { ?>
                            <select name="id_pegawai" class="form-control form-control-sm form-control-chosen">
                                <option value="" selected>~ Choose Employees ~</option>
                                <?php
                                $sql         = "SELECT * FROM tbl_pegawai WHERE jabatan = 'Kasir' ORDER BY nama_pegawai";
                                $query     = mysqli_query($koneksi, $sql);
                                while ($k = mysqli_fetch_array($query)) {
                                    $id_pegawai    = $k['id_pegawai'];
                                    $nama_pegawai  = $k['nama_pegawai']; ?>
                                    <option value="<?= $id_pegawai; ?>"><?= $nama_pegawai; ?></option>
                                <?php
                                } ?>
                            </select>
                        <?php
                        } else { ?>
                            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
                        <?php
                        } ?>

                        <a class="btn btn-sm btn-primary text-white" id="periodeCari"><i class="fas fa-search"></i></a>

                        <button class="btn btn-sm btn-success text-white" type="submit" id="periodePrint" name="cetak"><i class="fas fa-print"></i></button>
                </form>
            </div>
            <hr>
            <div id="tampilkanTransaksiPeriode">
                <table class="table table-bordered table-hover table-sm" id="tblTransaksi">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No.</th>
                            <th>Date</th>
                            <th>No Transaction</th>
                            <th>Detail</th>
                            <th>Total</th>
                            <th>No. Table</th>
                            <?php
                            if ($jabatan != "Kasir") { ?>
                                <th>Cashier</th>
                            <?php
                            } ?>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        if ($jabatan == "Kasir") {
                            $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai WHERE a.id_pegawai = '$id_pegawai' ORDER BY tgl_transaksi DESC, no_transaksi DESC";
                        } else {
                            $sql = "SELECT * FROM tbl_transaksi a INNER JOIN tbl_pegawai b ON a.id_pegawai = b.id_pegawai ORDER BY tgl_transaksi DESC, no_transaksi DESC";
                        }
                        $query = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                            $no_transaksi = $data['no_transaksi'];
                            $nm_pegawai   = $data['nama_pegawai'];
                            $tanggal      = date_create($data['tgl_transaksi']);
                        ?>
                            <tr>
                                <td align="center"><?= $no++; ?>.</td>
                                <td align="center"><?= date_format($tanggal, "d-m-Y"); ?></td>
                                <td><?= $no_transaksi; ?></td>
                                <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">No.</th>
                                                <th>Name Menu</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                                <?php
                                                if ($jabatan == "Manajer") { ?>
                                                    <th>Action</th>
                                                <?php
                                                } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $nomer = 1;
                                            $sql1 = "SELECT * FROM tbl_transaksi_detail a INNER JOIN tbl_menu b ON a.id_menu = b.id_menu WHERE a.no_transaksi = '$no_transaksi' ORDER BY a.id_detail";
                                            $query1 = mysqli_query($koneksi, $sql1);
                                            while ($data1 = mysqli_fetch_array($query1)) { ?>
                                                <tr>
                                                    <td align="center"><?= $nomer++; ?>.</td>
                                                    <td><?= $data1['nama_menu']; ?></td>
                                                    <td align="right"><?= number_format($data1['harga']); ?></td>
                                                    <td align="right"><?= number_format($data1['qty']); ?></td>
                                                    <td align="right"><?= number_format($data1['harga'] * $data1['qty']); ?>
                                                    </td>
                                                    <?php
                                                    if ($jabatan == "Manajer") { ?>
                                                        <td align="center"><i class="fas fa-trash text-danger transaksiAksi2" id=<?= $data1['id_detail']; ?> title="hapus"></i></td>
                                                    <?php
                                                    } ?>
                                                </tr>
                                            <?php
                                            } ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td align="right"><?= number_format($data['total_transaksi']); ?></td>
                                <td align="center"><?= $data['no_meja']; ?></td>
                                <?php
                                if ($jabatan != "Kasir") { ?>
                                    <td><?= $nm_pegawai; ?></td>
                                <?php
                                } ?>
                                <td align="center">
                                    <a href="cetak_struk.php?no_transaksi=<?= $no_transaksi; ?>" class="btn btn-success btn-sm" target="_blank">
                                        <i class="fa fa-print"></i>&nbsp;Print</a>
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
</div>

<?php include "footer.php"; ?>

<script>
    $(document).ready(function() {
        $('#tblTransaksi').dataTable();
        // Menampilkan Tabel Transaksi Per Periode

        $(document).on('click', '#periodeCari', function() {
            var periodeDari = $('#periodeDari').val();
            var periodeSampai = $('#periodeSampai').val();
            var idPegawai = $('[name="id_pegawai"]').val();
            $.ajax({
                method: 'POST',
                data: {
                    periodeDari: periodeDari,
                    periodeSampai: periodeSampai,
                    idPegawai: idPegawai
                },
                url: 'transaksi-cari-periode.php',
                cache: false,
                success: function() {
                    $('#tampilkanTransaksiPeriode').load('transaksi-cari-periode.php', {
                        periodeDari: periodeDari,
                        periodeSampai: periodeSampai,
                        idPegawai: idPegawai
                    });
                }
            });
        });

        // Hapus
        $(document).on('click', '.transaksiAksi2', function() {
            var a = confirm('Data akan dihapus?');
            if (a == false) {
                return false;
            }
            var id_detail = $(this).attr('id');
            var periodeDari = "";
            var periodeSampai = "";
            var idPegawai = "";

            $.ajax({
                method: 'POST',
                data: {
                    id_detail: id_detail
                },
                url: 'transaksi-delete-ajax.php',
                cache: false,
                success: function() {
                    $('#tampilkanTransaksiPeriode').load('transaksi-cari-periode.php', {
                        periodeDari: periodeDari,
                        periodeSampai: periodeSampai,
                        idPegawai: idPegawai
                    });
                }
            });
        });

        $('.form-control-chosen').chosen({
            allow_single_deselect: true,
        });
    });
</script>