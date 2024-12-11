<?php
session_start();

// Kết nối tới cơ sở dữ liệu MySQL
$conn=mysqli_connect("localhost","root","","webapp") or die("không thể kết nối");
mysqli_query($conn,"SET NAMES 'utf8'");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_GET["action"]) && $_GET["action"] == "add" && isset($_GET["id"])) {
    $product_id = intval($_GET["id"]);
    if ($product_id > 0) {
        if (isset($_SESSION["cart"][$product_id])) {
            $_SESSION["cart"][$product_id]++;
        } else {
            $_SESSION["cart"][$product_id] = 1;
        }
    }
}

// Lấy thông tin sản phẩm từ database
$searchTerm = "pk";

// Truy vấn dữ liệu từ cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE image LIKE '%$searchTerm%'";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>L2N SHOP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a89cc, #b8e994);
            margin: 0;
            padding: 0;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .product-card {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div class="hbot">
        <div class="container">
            <nav class="navbar navbar-full navbar-dark bg-inverse">
                <button class="navbar-toggler light float-xs-right hidden-sm-up" type="button" data-toggle="collapse" data-target="#nvbar"></button>
                <div id="nvbar" class="collapse navbar-toggleable-xs">
                    <ul class="nav navbar-nav float-sm-right">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li>
                            <form action="search.php" method="get">
                                <input type="text" name="search" placeholder="Tìm kiếm...">
                                <button type="submit">Tìm</button>
                            </form>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="phone.php">Điện thoại</a></li>
                        <li class="nav-item"><a class="nav-link" href="mac.php">Laptop</a></li>
                        <li class="nav-item"><a class="nav-link" href="phukien.php">Phụ kiện</a></li>
                        <li>
                            <div class="col-md-6 text-xs-right">
                                <a href="cart.php" class="btn btn-primary">Giỏ hàng</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>";
                        echo "<a href='details.php?id=" . $row["id"] . "' class='product-card' style='text-decoration: none; color: inherit;'>";
                        echo "<div class='card'>";
                        echo "<div class='card-block'>";
                        echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' class='card-img-top'>";
                        echo "<div class='card-body'>";
                        echo "<h2 class='card-title'>" . $row["name"] . "</h2>";
                        echo "<p class='card-text'>Giá: " . $row["price"] . " VND</p>";
                        echo "<a href='?action=add&id=" . $row["id"] . "' class='btn btn-success'>Mua ngay</a>";
                        echo "<a href='?action=add&id=" . $row["id"] . "' class='btn btn-info'>Thêm vào giỏ hàng</a>";
                        echo "</div>";  // Close card-body
                        echo "</div>";  // Close card-block
                        echo "</div>";  // Close card
                        echo "</a>";
                        echo "</div>";  // Close col-md-4
                    }
                } else {
                    echo "<div class='col-12'>Không có sản phẩm nào.</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-xs-center">©Dự án web K44E</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0Tmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47B7iAn2C0C2Bo5g5Y1Ge6fa" crossorigin="anonymous"></script>
</body>

</html>
