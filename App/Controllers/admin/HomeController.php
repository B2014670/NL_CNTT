<?php
    use App\Core\Controller;
    class HomeController extends Controller{
        private $vegeModel;
        private $orderModel;
        private $userModel;
        function __construct(){
            $this->vegeModel = $this->model("VegetablesModel");
            $this->orderModel = $this->model("OrderModel");
            $this->userModel = $this->model("UserModel");
        }
        
        function Index(){             
            $data["finishedOrders"] = $this->orderModel->finishedOrders();
            $data["countProduct"] = $this->vegeModel->count();
            $data["countSale"] = $this->vegeModel->countSale();
            $data["countUser"] = $this->userModel->countAll();

            //data for chart
            $data["yearOrder"] = $this->orderModel->year();
            $data["yearOrder"] = $this->orderModel->year();
            if (isset($_GET["year"]) && !isset($_GET["month"])){
                $data["saleChart"] = $this->orderModel->costOrderMonthlyOfYear($_GET["year"]);
                $data["productChart"] = $this->orderModel->numVegeOfYear($_GET["year"]);
            }
            else if (isset($_GET["year"]) && isset($_GET["month"])){
                $data["saleChart"] = $this->orderModel->costOrderMonthOfYear($_GET["year"], $_GET["month"]);
                $data["productChart"] = $this->orderModel->numVegeMonthOfYear($_GET["year"], $_GET["month"]);
            }else if (!isset($_GET["year"]) && !isset($_GET["month"])){
                $data["saleChart"] = $this->orderModel->costOrderMonthlyOfYear(2023);
                $data["productChart"] = $this->orderModel->numVegeOfYear(2023);
            }
            $this->view("home/dashboard", $data);
        }
    }
?>