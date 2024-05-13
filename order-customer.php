<?php
include "koneksi.php";
$judul = "Order Customer";
include "header.php";
?>
<div class="col">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Order Customer</h2>
                <hr>
                <a href="cetak-order.php" class="btn btn-sm btn-success text-white" target="_blank"><i class="fas fa-print"></i> Print Order Customer</a>
                <hr>

                <table class="table table-bordered table-hover" id="laporanMenu">
                    <thead>
                        <tr class="text-center">
                            <th>NO.</th>
                            <th>ID ORDER PER ITEM.</th>
                            <th>Menu Name</th>
                            <th>PRICE</th>
                            <th>QTY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no         = 1;
                        $sql         = "SELECT * FROM tbl_cart_order";
                        $query     = mysqli_query($koneksi, $sql);
                        while ($data = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?>.</td>
                                <td><?= $data['id_cart_order']; ?></td>
                                <td><?= $data['nama_menu']; ?></td>
                                <td align="right"><?= number_format($data['price']); ?></td>
                                <td><?= $data['qty']; ?></td>
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
        $('#laporanMenu').dataTable();
        $('.form-control-chosen').chosen({
            allow_single_deselect: true,
        });
    });
</script>