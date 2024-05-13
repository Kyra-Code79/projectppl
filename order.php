<?php
session_start();
include 'koneksi.php';

if (isset($_GET['table'])) {
    $table_id = $_GET['table'];
    $_SESSION['id'] = $table_id;

    if (isset($_POST["add_to_cart"])) {
        $id_menu = $_GET["id_menu"]; // Ensure id_menu is set correctly
        $item_array_id = array_column($_SESSION["shopping_cart"], "id_menu");

        if (!in_array($id_menu, $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'id_menu'    =>    $id_menu, // Use menu ID
                'nama_menu'  =>    $_POST["hidden_name"],
                'harga'      =>    $_POST["hidden_price"],
                'quantity'   =>    $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
            echo '<script>alert("Item Added Successfully")</script>';
            echo "<script>window.location='cart.php'</script>";
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Side</title>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .menu-container {
                display: flex;
                flex-wrap: wrap;
                align-items: flex-start;
                justify-content: center;
                /* Control vertical alignment */
                margin-top: 70px;
                margin-bottom: 20px;
            }

            .food-item {
                position: relative;
                /* Ensure z-index works */
                z-index: 2;
                /* Higher than the navbar */
                margin-top: 5%;
                flex: 1 1 1;
                width: 500px;
                height: 500px;
                background-color: #CF9860;
                padding: 20px;
                border: 1px solid #ddd;
                text-align: center;
                margin-right: 20px;
                margin-bottom: 20px;
                box-sizing: border-box;
                border-radius: 5%;
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .food-item:hover {
                transform: scale(1.05);
                opacity: 0.7;
            }

            img {
                color: red;
            }

            .food-item h3 {
                color: #53371A;
            }

            .food-item p {
                color: #FFEEEE;
            }

            .food-item img {
                max-width: 100%;
                height: auto;
                border-radius: 10%;
                transition: opacity 0.3s ease;
            }

            .food-item-content {
                margin-top: 10px;
            }

            .food-item-text {
                text-align: center;
            }

            .price {
                color: #C58F2B;
            }

            .food-item:last-child {
                margin-right: 0;
            }

            /* buttons */
            .food-item .input-quantity {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                display: none;
                /* Hide buttons by default */
            }

            .buttons {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                display: none;
                /* Hide buttons by default */
            }

            .food-item:hover .input-quantity {
                display: block;
                /* Show buttons on hover */
            }

            .food-item:hover .buttons {
                top: 60%;
                transform: translateY(50%, 50%);
                display: block;
                /* Show buttons on hover */
            }

            .food-item::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                /* Dark overlay color */
                opacity: 0;
                /* Initially hidden */
                transition: opacity 0.3s ease;
            }

            .food-item:hover::before {
                opacity: 1;
                /* Show overlay on hover */
            }

            .add-button,
            .input-quantity {
                /* Style your buttons here */
                background-color: #53371A;
                color: white;
                border: 1px solid #ccc;
                padding: 5px 10px;
                margin-right: 10px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <?php include 'include/navbar.php'; ?>
        <div class="menu-container">
            <?php
            $sql = "SELECT * FROM tbl_menu a INNER JOIN tbl_jenis_menu b ON a.id_jenis_menu = b.id_jenis_menu";
            $query = mysqli_query($koneksi, $sql);
            while ($data = mysqli_fetch_array($query)) { ?>
                <form action="cart.php?action=add&id_menu=<?php echo $data['id_menu']; ?>" method="post">
                    <div class="food-item">
                        <img src="data:image/jpeg;base64, <?= htmlspecialchars($data['photo']); ?>" width="300" height="300" alt="<?= $data['nama_menu']; ?>">
                        <div class="food-item-content">
                            <h3 class="food-item-text"><?= htmlspecialchars($data['nama_menu']); ?></h3>
                            <p class="food-item-text"><?= htmlspecialchars($data['jenis_menu']); ?></p>
                            <p class="food-item-text price">Rp. <?= number_format($data['harga']); ?></p>
                            <input type="text" name="quantity" value="1" class="form-control input-quantity" />

                            <input type="hidden" name="hidden_name" value="<?php echo $data["nama_menu"]; ?>" />

                            <input type="hidden" name="hidden_price" value="<?php echo $data["harga"]; ?>" />
                            <input type="hidden" name="id_menu" value="<?php echo $data['id_menu']; ?>" />
                        </div>
                        <div class="buttons">
                            <button class="add-button" name="add_to_cart">Add</button>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
    </body>

    </html>
<?php
} else {
    echo 'Invalid Request';
    session_unset();
    session_destroy();
    exit;
}
