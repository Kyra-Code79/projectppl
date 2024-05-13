<?php
include 'koneksi.php';
session_start();
if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "id_menu");
        if (!in_array($_GET["id_menu"], $item_array_id)) { // Changed to id_menu
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'id_menu'    =>    $_GET["id_menu"], // Changed to id_menu
                'nama_menu'  =>    htmlspecialchars($_POST["hidden_name"]),
                'harga'      =>    htmlspecialchars($_POST["hidden_price"]),
                'quantity'   =>    htmlspecialchars($_POST["quantity"])
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'id_menu'    =>    $_GET["id_menu"], // Changed to id_menu
            'nama_menu'  =>    htmlspecialchars($_POST["hidden_name"]),
            'harga'      =>    htmlspecialchars($_POST["hidden_price"]),
            'quantity'   =>    htmlspecialchars($_POST["quantity"])
        );
        $_SESSION["shopping_cart"][0] = $item_array;
        echo '<script>alert("Item Added Successfully")</script>';
        echo "<script>window.location='cart.php'</script>";
    }
}

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["kirim"])) {
    try {
        // Check for existing records before insertion
        foreach ($_POST["id_menu"] as $key => $id_menu) {
            $id_cart_order;/* generate or retrieve a unique ID */;

            // Check if the ID already exists
            $check_stmt = $koneksi->prepare("SELECT COUNT(*) FROM tbl_cart_order WHERE id_cart_order = ?");
            $check_stmt->bind_param('i', $id_cart_order);
            $check_stmt->execute();
            $check_stmt->bind_result($count);
            $check_stmt->fetch();
            $check_stmt->close();

            if ($count == 0) {
                // Proceed with insertion since the ID is unique
                $stmt = $koneksi->prepare("INSERT INTO tbl_cart_order (id_cart_order, nama_menu, price, qty) VALUES (?, ?, ?, ?)");
                $stmt->bind_param('isss', $id_cart_order, $_POST["hidden_name"][$key], $_POST["hidden_price"][$key], $_POST["quantity"][$key]);
                $stmt->execute();
            } else {
                // Handle duplicate ID, perhaps generate a new ID or update existing record
                // Example: $id_cart_order = /* generate or retrieve a new ID */;
                // Then proceed with insertion or update
            }
        }

        echo '<script>alert("Order(s) stored successfully")</script>';
        echo "<script>window.location='cart.php'</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_order = htmlspecialchars($_GET['id_order']); // Sanitize input
    foreach ($_SESSION["shopping_cart"] as $keys => $data) {
        if ($data['id_menu'] == $id_order) {
            unset($_SESSION["shopping_cart"][$keys]);
            echo '<script>alert("Item Removed")</script>';
            echo '<script>window.location="cart.php"</script>';
        } else {
            echo '<script>window.location="order.php"</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <h3>
        <center>Order Details</center>
    </h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name Menu</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <form method="post" action="">
                <?php
                if (!empty($_SESSION["shopping_cart"])) {
                    $total = 0;
                    $nom = 0;
                    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                ?>
                        <tr>
                            <td><?php echo $nom++ ?></td>
                            <td><?php echo $values['nama_menu'] ?></td>
                            <td><?php echo $values['harga'] ?></td>
                            <td><?php echo $values['quantity'] ?></td>
                            <td><?php echo number_format($values['quantity'] * $values['harga'], 2) ?></td>
                            <td><a href="cart.php?action=delete&id_order=<?php echo $values['id_menu']; ?>">
                                    <span class="text-danger">Remove</span>
                                </a></td>
                        </tr>
                        <!-- Hidden input fields -->
                        <input type="hidden" name="id_menu[]" value="<?php echo $values['id_menu']; ?>">
                        <input type="hidden" name="hidden_name[]" value="<?php echo $values['nama_menu']; ?>">
                        <input type="hidden" name="hidden_price[]" value="<?php echo $values['harga']; ?>">
                        <input type="hidden" name="quantity[]" value="<?php echo $values['quantity']; ?>">
                <?php
                        $total = $total + ($values['quantity'] * $values['harga']);
                    }
                }
                ?>
                <tr>
                    <td colspan="4" align="right">Total</td>
                    <td align="right"><?php echo number_format($total, 3); ?></td>
                    <td><button type="submit" name="kirim">KIRIM PESANAN</button></td>
                </tr>
            </form>
        </table>
    </div>
    <script>
        function callOrder() {
            window.location.href = 'order.php';
        }
    </script>
</body>

</html>