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
    <span style="margin-left: 0px; font-size: 24px;">QRCODE</span>
    <table class="table table-bordered table-hover" style="width: 80%;">
        <thead>
            <tr class="text-center">
                <th>No.</th>
                <th>ID TABLE</th>
                <th>NAMA TABLE</th>
                <th>QRCODE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "koneksi.php";
            $getID = $_GET['id'];
            $no         = 1;
            $sql         = "SELECT * FROM tbl_table WHERE id = $getID ";
            $query     = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td align="center" width="5%"><?= $no++; ?>.</td>
                    <td><?= $data['id']; ?></td>
                    <td><?= $data['nama_table']; ?></td>
                    <td align="center">
                        <img src="data:image/jpeg;base64, <?= $data['QRCode']; ?>" width="200" height="200">
                    </td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</body>

</html>