<?php

use App\Core\Controller;

class CartController extends Controller
{
    private $cartModel;
    private $orderModel;
    private $vegeModel;
    function __construct()
    {
        $this->cartModel = $this->model("CartModel");
        $this->orderModel = $this->model("OrderModel");
        $this->vegeModel = $this->model("VegetablesModel");
    }

    function Index()
    {
        $data["cart"] = $this->cartModel->getVegeFromCart($_SESSION["user"]["id"]);
        if (!isset($data["cart"]) || $data["cart"] == 0) $data["cart"] = [];
        $this->view("cart/index", $data);
    }

    function add()
    {
        if (isset($_GET)) {
            $result = $this->cartModel->addToCart($_GET);
            echo json_encode($result);
            return;
        } else echo "Can not add to cart!";
    }

    function amountInCart()
    {
        if (isset($_SESSION["user"])) {
            echo $result = $this->cartModel->countVegeInCart($_SESSION["user"]["id"]);
            return;
        } else {
            echo "0";
        }
    }

    function delete()
    {
        if (isset($_GET)) {
            $result = $this->cartModel->deleteItemInCart($_GET);
            echo $result;
            return;
        } else echo "Can not delete this item!";
    }

    function quantity()
    {
        if (isset($_GET)) {
            $result = $this->cartModel->updateQuantity($_GET);
            echo $result;
            return;
        } else echo "Can not update quantity!";
    }

    function order()
    {
        if (isset($_GET)) {
            $check = true;
            $result1 = $this->orderModel->book($_GET["userId"]);
            $result2 = $this->cartModel->getById($_GET["userId"]);
            //var_dump($result2);
            foreach ($result2 as $i => $item) {
                $data["id_order"] = $result1["orderId"];
                $data["id_vege"] = $item["id_veg"];
                $data["amount"] = $item["amount"];
                $result3 = $this->vegeModel->getVegeById($data["id_vege"]);
                if ($result3["sale_price"] == NULL) $data["price"] = $result3["price"];
                else $data["price"] = $result3["sale_price"];
                $check = $this->orderModel->addToDetails($data);
            }
            $check = $this->cartModel->deleteAll($_GET["userId"]);
            echo $check;
            return;
        } else echo "Can not update quantity!";
    }

    function vnpay_payment()
    {
        if (isset($_POST["redirect"])) {
            $result = $this->orderModel->getMaxOrderid($_POST["id_user"]);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost/cart/vnpay_order";

            $vnp_TmnCode = "WH0IW3XY"; //Mã website tại VNPAY 
            $vnp_HashSecret = "OGDODEHWKYXOTNTJDPFWPIBFZLIDSCWA"; //Chuỗi bí mật

            //$vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_TxnRef = 2; //$result["orderId"]+1
            $vnp_OrderInfo = 'thanh toan don hang nong san';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $_POST["cost"] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
    }


    function thank123()
    {
        $this->view("cart/success");
        // if (isset($_GET["vnp_ResponseCode"]) && (strcmp($_GET["vnp_ResponseCode"], "00") != 0)) {
        //     print_r('Thanh toán thất bại! Vui lòng kiểm tra thông tin và thử lại!');
        // } else {
        //     // order(); 

        //     $id_user = $_SESSION['user']['id'];
        //     $check = true;
        //     $this->orderModel->book($_SESSION['user']['id']);
        //     // $result1 = $this->orderModel->book($id_user);
        //     // $result2 = $this->cartModel->getById($id_user);
        //     // //var_dump($result2);
        //     // foreach ($result2 as $i => $item) { //them vao detail
        //     //     $data["id_order"] = $result1["orderId"];
        //     //     $data["id_vege"] = $item["id_veg"];
        //     //     $data["amount"] = $item["amount"];
        //     //     $result3 = $this->vegeModel->getVegeById($data["id_vege"]);
        //     //     if ($result3["sale_price"] == NULL) $data["price"] = $result3["price"];
        //     //     else $data["price"] = $result3["sale_price"];
        //     //     $check = $this->orderModel->addToDetails($data);
        //     // }
        //     // //xoa cart
        //     // $check = $this->cartModel->deleteAll($id_user);
        //     // echo $check;
        //     // return;            
        // }
    }
    function vnpay_order()
    {
        if (isset($_GET["vnp_ResponseCode"]) && (strcmp($_GET["vnp_ResponseCode"], "00") == 0)) {
            $result1 = $this->orderModel->book($_SESSION["user"]["id"]);
            $result2 = $this->cartModel->getById($_SESSION["user"]["id"]);
            //var_dump($result2);
            foreach ($result2 as $i => $item) {
                $data["id_order"] = $result1["orderId"];
                $data["id_vege"] = $item["id_veg"];
                $data["amount"] = $item["amount"];
                $result3 = $this->vegeModel->getVegeById($data["id_vege"]);
                if ($result3["sale_price"] == NULL) $data["price"] = $result3["price"];
                else $data["price"] = $result3["sale_price"];
                $check = $this->orderModel->addToDetails($data);
            }
            $check = $this->cartModel->deleteAll($_SESSION["user"]["id"]);
            echo ("<script>
                    if (window.confirm('Đặt hàng thành công! Giỏ hàng của bạn đã được làm mới.'))
                    {
                        window.location.href = '/cart'
                    }
                    else
                    {
                        // They clicked no
                    }
                </script>");
            // $data["cart"] = $this->cartModel->getVegeFromCart($_SESSION["user"]["id"]);
            // if (!isset($data["cart"]) || $data["cart"] == 0) $data["cart"] = [];
            // $this->view("cart/index", $data);
        } else echo "Thanh toán thất bại! Vui lòng kiểm tra thông tin và thử lại!";
    }
}
