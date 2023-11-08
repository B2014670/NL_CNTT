<?php

use App\Core\Controller;

class UserController extends Controller
{
    private $userModel;
    private $orderModel;

    function __construct()
    {
        $this->userModel = $this->model("UserModel");
        $this->orderModel = $this->model("OrderModel");
    }
    function Index()
    {
        $data["user"] = $this->userModel->getInfor($_SESSION["user"]["id"]);
        $_SESSION['user']['avatar'] = $data["user"]["avatar"];

        //Delivered Orders
        $data["deliveredOrders"] = $this->orderModel->getDeliveredOrders($_SESSION["user"]["id"]);
        if ($data["deliveredOrders"] == 0) $data["deliveredOrders"] = [];
        else {
            foreach ($data["deliveredOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        //Delivering Orders
        $data["deliveringOrders"] = $this->orderModel->getDeliveringOrders($_SESSION["user"]["id"]);
        if ($data["deliveringOrders"] == 0) $data["deliveringOrders"] = [];
        else {
            foreach ($data["deliveringOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        //Prepairing Orders
        $data["preparingOrders"] = $this->orderModel->getPreparingOrders($_SESSION["user"]["id"]);
        if ($data["preparingOrders"] == 0) $data["preparingOrders"] = [];
        else {
            foreach ($data["preparingOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        //No processed Orders
        $data["noProcessedOrders"] = $this->orderModel->getNoProcessedOrders($_SESSION["user"]["id"]);
        if ($data["noProcessedOrders"] == 0) $data["noProcessedOrders"] = [];
        else {
            foreach ($data["noProcessedOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        $this->view("user/index", $data);
    }

    function history()
    {
        //Delivered Orders
        $data["deliveredOrders"] = $this->orderModel->getDeliveredOrders($_SESSION["user"]["id"]);
        if ($data["deliveredOrders"] == 0) $data["deliveredOrders"] = [];
        else {
            foreach ($data["deliveredOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        //Delivering Orders
        $data["deliveringOrders"] = $this->orderModel->getDeliveringOrders($_SESSION["user"]["id"]);
        if ($data["deliveringOrders"] == 0) $data["deliveringOrders"] = [];
        else {
            foreach ($data["deliveringOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        //Prepairing Orders
        $data["preparingOrders"] = $this->orderModel->getPreparingOrders($_SESSION["user"]["id"]);
        if ($data["preparingOrders"] == 0) $data["preparingOrders"] = [];
        else {
            foreach ($data["preparingOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }

        //No processed Orders
        $data["noProcessedOrders"] = $this->orderModel->getNoProcessedOrders($_SESSION["user"]["id"]);
        if ($data["noProcessedOrders"] == 0) $data["noProcessedOrders"] = [];
        else {
            foreach ($data["noProcessedOrders"] as $index => $order) {
                $data[$order["id"]]["vege"] = $this->orderModel->getVegeInOrder($order["id"]);
            }
        }
        $this->view("user/history_purchase", $data);
    }

    function password(){
        $data["user"] = $this->userModel->getInfor($_SESSION["user"]["id"]);
        $_SESSION['user']['avatar'] = $data["user"]["avatar"];
        $this->view("user/update_password",$data);
    }

    function update()
    {
        $result = $this->userModel->updateInfor($_SESSION["user"]["id"], $_POST);
        if ($result[0] === true) {
            session_destroy();
            session_start();
            $_SESSION["user"] = $result[1];
            header("Location: " . DOCUMENT_ROOT . "/user");
        } else echo "Update fail!";
    }

    function changepass()
    {
        if ($_POST['password'] == $_POST['re-password']) {
            $result = $this->userModel->changePass($_SESSION["user"]["id"], $_POST);
            if ($result === true || $result[0] ===true) {
                echo '<script>if(confirm("Đỗi mật khẩu thành công!")) 
                                    window.location.href = "/user/password"
                        </script>';
                
                // header("Location: " . DOCUMENT_ROOT . "/user");
            } else echo '<script>if(confirm("'.$result[1].'")) 
                                    window.location.href = "/user/password"
                        </script>';
        } else echo '<script>
                        if(confirm("Giá trị không khớp! Quay lại trang trước?")) 
                            window.location.href = "/user/password"
                    </script>';
    }

    function upload()
    {
        $result = $this->userModel->uploadAvatar($_SESSION["user"]["id"], $_FILES);
        if ($result == true) header("Location: " . DOCUMENT_ROOT . "/user");
        else echo "Update fail!";
    }
}
