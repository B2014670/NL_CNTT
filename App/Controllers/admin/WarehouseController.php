<?php
    use App\Core\Controller;

    class WarehouseController extends Controller{
        private $vegeModel;
        private $cateModel;
        private $origModel;
        private $wareModel;

        function __construct(){
            $this->vegeModel = $this->model("VegetablesModel");
            $this->cateModel = $this->model("CategoriesModel");
            $this->origModel = $this->model("OriginalModel");
            $this->wareModel = $this->model("WarehouseModel");
        }

        function Index(){
            $result = $this->wareModel->all();
            if ($result != false) $data["warehoue"] = $result;
            
            $this->view("warehouse/index", $data);
        }

        function create(){
            $result1 = $this->vegeModel->all();
            if ($result1 != false) $data["vege"] = $result1;

            $this->view("warehouse/create", $data);
        }

        function store(){
            if(!isset($_POST)) header("Location: ".DOCUMENT_ROOT."/admin/warehouse/create");
            else{                
                $data["id"] = $_POST["id"];
                $data["entry_date"] = $_POST["entry_date"];
                $data["expired_date"] = $_POST["expired_date"];
                $data["weight"] = $_POST["weight"];
                $data["measure"] = $_POST["measure"];     

                $result = $this->wareModel->insert($data);
                if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/warehouse");
                else header("Location: ".DOCUMENT_ROOT."/admin/warehouse/create");
            }
        }

        
        function edit($wareId){
            $result1 = $this->vegeModel->getIdName();
            if ($result1 != false) $data["vege"] = $result1;

            $result2 = $this->wareModel->getBatchById($wareId);
            if ($result2 != false) $data["ware"] = $result2;

            $this->view("warehouse/edit", $data);
        }

        function update($wareId){
            if(!isset($_POST)) header("Location: ".DOCUMENT_ROOT."/admin/products/edit");
            else{ 
                $data["id"] = $wareId;               
                $data["id_vege"] = $_POST["id"];
                $data["entry_date"] = $_POST["entry_date"];
                $data["expired_date"] = $_POST["expired_date"];
                $data["weight"] = $_POST["weight"];
                $data["stock"] = $_POST["stock"];
                $data["measure"] = $_POST["measure"];     

                $result = $this->wareModel->update($data);
                if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/warehouse");
                else header("Location: ".DOCUMENT_ROOT."/admin/warehouse/edit".$data["id"]);
            }
            // if(!isset($_POST)) header("Location: ".DOCUMENT_ROOT."/admin/products/edit");
            // else{
            //     $data["id"] = $vegeId;
            //     $data["cate"] = $_POST["cate"];
            //     $data["name"] = $_POST["name"];
            //     $data["weight"] = $_POST["weight"];
            //     $data["price"] = $_POST["price"];
            //     $data["orig"] = $_POST["orig"];


            //     $result = $this->vegeModel->update($data);
            //     if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/products");
            //     else header("Location: ".DOCUMENT_ROOT."/admin/products/edit/".$data["id"]);
            // }
        }

        
        // function delete(){
        //     if(isset($_GET)){
        //         $result = $this->vegeModel->deleteVege($_GET);
        //         echo $result;
        //         return;
        //     }
        //     else echo "Can not delete this item!"; 
        // }
    }
?>