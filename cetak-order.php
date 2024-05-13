<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Cetak Rekapitulasi Menu</title>
    <link rel="shorcut icon" type="text/css" href="photo/favicon.png">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap-4_4_1.min.css" />

    <style>
        .box-header {
            margin-left: 30px;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        tr>th {
            text-align: center;
            height: 35px;
            border: 2px solid;
        }

        tr>td {
            padding-left: 5px;
            vertical-align: middle !important;
        }

        tr>td>img {
            margin-top: 3px;
            margin-bottom: 3px;
        }

        #cetak {
            margin-left: 30px;
            margin-right: 30px;
        }
    </style>
</head>

<body onload="window.print(); window.onafterprint = window.close; ">
    <span style="margin-left: 0px; font-size: 24px;">REKAPITULASI DAFTAR MENU</span>
    <table class="table table-bordered table-hover" style="width: 80%;">
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
            include "koneksi.php";
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
</body>

</html>