<!-- Conttroller khách hàng -->
<?php
ob_start();
session_start();
require_once "./global.php";
require_once "./model/pdo.php";
require_once "./model/model-user.php";

// Ai làm bên này có giao diện người dùng thì tự động thêm vào
// Làm cái gì thì cứ comment tên người làm lại ở đầu và cuối chức năng
// Comment thêm tên chức năng nữa nhé
require_once "view/header.php";
if (isset($_GET['act'])) {
    $actAdmin = $_GET['act'];
    switch ($actAdmin) {
        case 'showProducts':
            require_once "";
            break;
        case 'showCategoriess':
            require_once "";
            break;
            // Đức làm đăng ký đăng nhập quên mật khẩu
        case 'dangnhap':
            if (isset($_POST['dangnhap'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                CheckUser($email, $password);
                $checkuser_success = CheckUser($email, $password);
                if (!is_array($checkuser_success)) {
                    $thongbao[0] = "Đăng nhập thất bại (kiểm tra lại email hoặc mật khẩu) !";
                } else {
                    $thongbao[0] = "Đăng nhập thành công !";
                    header("Location: index.php");
                    ob_end_flush();
                    //echo "<script>window.location.href='target.php';</script>";
                }
            }
            if (isset($_POST['quenmatkhau'])) {
                $email = $_POST['email'];
                if ($email == "") {
                    $thongbao[1] = "Vui lòng nhập email";
                } else {
                    $check_email = CheckEmail($email);
                    if (is_array($check_email)) {
                        $thongbao[1] = 'Mật khẩu của bạn là: ' . $check_email['password'];
                    } else {
                        $thongbao[1] = 'Email ' . $email . ' không tồn tại';
                    }
                }
            }
            require_once "./view/dangnhap.php";
            break;
        case 'dangky':
            if (isset($_POST['dangky'])) {
                $ho = $_POST['ho'];
                $ten = $_POST['ten'];
                $name = $ho . ' ' . $ten;
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = '';
                $address = '';
                $image = 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/512px-User_font_awesome.svg.png?20160212005950';
                $role = 0;
                InsertUser($name, $email, $password, $phone, $address, $image, $role);
                $thongbao[0] = "Đăng ký thành công !";
            }
            require_once "view/dangky.php";
            break;
        default:
            require_once "";
            break;
    }
} else {
    require_once "view/home.php"; // Show giao diện người dùng ( Trang chủ  )
}
//  Show giao diện người dùng ( Footer )
require_once "view/footer.php";
?>