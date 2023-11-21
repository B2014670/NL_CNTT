<?php

use App\Core\Controller;

class OrdersController extends Controller
{
    private $orderModel;
    private $statusModel;
    private $wareModel;
    function __construct()
    {
        $this->orderModel = $this->model("OrderModel");
        $this->statusModel = $this->model("StatusModel");
        $this->wareModel = $this->model("WarehouseModel");
    }

    function Index()
    {
        $data["order"] = $this->orderModel->all();
        $data["status"] = $this->statusModel->all();
        $this->view("orders/index", $data);
    }

    function details($id)
    {
        $data["details"] = $this->orderModel->getOrderDetails($id);
        $data["id"] = $id;
        $this->view("orders/details", $data);
    }

    function update()
    {
        if (isset($_GET)) {
            $result1 = $this->orderModel->getOrderDetailNoProcess($_GET);

            if ($result1 != false) {
                // $result2 = $this->orderModel->updateStatus($_GET);
                foreach ($result1 as $i => $item) {
                    $id= $this->wareModel->nearestExpired($item["id_vege"]);
                    $data["a"] = $id;
                    $data["id_vege"] = $item["id_vege"];
                    $data["amount"] = $item["amount"];
                    $data["weight"] = $item["weight"];
                    $result3 = $this->wareModel->updateStock($data);
                    // print_r($data);
                    // if ($result3["sale_price"] == NULL) $data["price"] = $result3["price"];
                    // else $data["price"] = $result3["sale_price"];
                    // $check = $this->orderModel->addToDetails($data);
                }
            }
            // print_r($result1);
            return $result3;
        } else echo "Can not update this order!";
    }

    // function confirmOrder()
    // {
    //     if (isset($_GET)) {
    //         $check = true;
    //         $result1 = $this->orderModel->book($_GET["userId"]);
    //         $result2 = $this->cartModel->getById($_GET["userId"]);
    //         //var_dump($result2);
    //         foreach ($result2 as $i => $item) {
    //             $data["id_order"] = $result1["orderId"];
    //             $data["id_vege"] = $item["id_veg"];
    //             $data["amount"] = $item["amount"];
    //             $result3 = $this->vegeModel->getVegeById($data["id_vege"]);
    //             if ($result3["sale_price"] == NULL) $data["price"] = $result3["price"];
    //             else $data["price"] = $result3["sale_price"];
    //             $check = $this->orderModel->addToDetails($data);
    //         }
    //         $check = $this->cartModel->deleteAll($_GET["userId"]);
    //         echo $check;
    //         return;
    //     } else echo "Can not update quantity!";
    // }
}
