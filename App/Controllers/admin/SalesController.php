<?php
    use App\Core\Controller;

    class SalesController extends Controller{
        private $vegeModel;
        function __construct(){
            $this->vegeModel = $this->model("VegetablesModel");
        }

        function Index(){
            $result = $this->vegeModel->getSale();
            if ($result != false) $data["vege"] = $result;
            
            $this->view("sales/index", $data);
        }

        function create(){
            $result = $this->vegeModel->all();
            if ($result != false) $data["vege"] = $result;
            $this->view("sales/create", $data);
        }

        function getPrice(){
            if(isset($_GET)){
                $result = $this->vegeModel->getPrice($_GET);
            }
            if ($result != 0){
                echo $result["price"];
                return;
            }
            else echo "Can not get price!";
        }

        function store(){
            if(!isset($_POST)) header("Location: ".DOCUMENT_ROOT."/admin/sales/create");
            else{
                $data["id_vege"] = $_POST["sale_product"];
                $data["price"] = $_POST["sale_price"];
                $result = $this->vegeModel->createSale($data);
                if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/sale");
                else header("Location: ".DOCUMENT_ROOT."/admin/sales/create");
            }
        }

        function edit($id){
            $data["vege"] = $this->vegeModel->getVegeById($id);
            $this->view("sales/edit", $data);
        }

        function update($id){
            if(isset($_POST)){
                $data["id"] = $id;
                $data["price"] = $_POST["sale_price"];
                $result = $this->vegeModel->updateSalePrice($data);
                if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/sale");
                else header("Location: ".DOCUMENT_ROOT."/admin/sales/edit/".$data["id"]);
            }
            else echo "Can not update this sale!"; 
        }

        function delete(){
            if(isset($_GET)){
                $result = $this->vegeModel->deleteSale($_GET);
                echo $result;
                return;
            }
            else echo "Can not delete this sale!"; 
        }
    }
?>