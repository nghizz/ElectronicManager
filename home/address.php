<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Địa Chỉ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a89cc, #b8e994);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: all 0.3s ease;
        }
        form:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="cart.php" method="post">
        <h1>Thông Tin Địa Chỉ</h1>
        <label for="name">Họ và Tên:</label>
        <input type="text" id="name" name="name" required>

        <label for="phone">Số Điện Thoại:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="address">Địa Chỉ:</label>
        <textarea id="address" name="address" rows="4" required></textarea>

        <input type="hidden" name="confirm_order" value="1">
        <button type="submit">Xác Nhận Đặt Hàng</button>
    </form>
</body>
</html>
