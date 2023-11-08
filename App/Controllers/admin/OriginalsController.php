<?php
    use App\Core\Controller;

    class OriginalsController extends Controller{
        private $origModel;

        function __construct(){
            $this->origModel = $this->model("OriginalModel");
        }

        function Index(){
            $result = $this->origModel->all();
            if ($result != false) $data["orig"] = $result;
            
            $this->view("originals/index", $data);
        }

        function create(){
            $this->view("originals/create", []);
        }

        function store(){
            if(!isset($_POST)) header("Location: ".DOCUMENT_ROOT."/admin/originals/create");
            else{
                $data["seed"] = $_POST["seed"];
                $data["planting"] = $_POST["planting"];
                $result = $this->origModel->insert($data);
                if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/original");
                else header("Location: ".DOCUMENT_ROOT."/admin/originals/create");
            }
        }

        
        function edit($origId){
            $result = $this->origModel->getOrigById($origId);
            if ($result != false) $data["orig"] = $result;
            $this->view("originals/edit", $data);
        }

        function update($origId){
            if(!isset($_POST)) header("Location: ".DOCUMENT_ROOT."/admin/originals/edit");
            else{
                $data["id"] = $origId;
                $data["seed"] = $_POST["seed"];
                $data["planting"] = $_POST["planting"];
                $result = $this->origModel->update($data);
                if ($result == true) header("Location: ".DOCUMENT_ROOT."/admin/original");
                else header("Location: ".DOCUMENT_ROOT."/admin/originals/edit/".$data["id"]);
            }
        }

        function delete(){
            if(isset($_GET)){
                $result = $this->origModel->deleteOrig($_GET);
                echo $result;
                return;
            }
            else echo "Can not delete this orig!"; 
        }
    }
?>