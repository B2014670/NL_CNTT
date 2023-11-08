<?php
    use App\Core\Controller;
    class CustomersController extends Controller{
        private $userModel;

        function __construct(){
            $this->userModel = $this->model("UserModel");
        }
        
        function Index(){
            $result = $this->userModel->getAll();
            if ($result != false) $data["customer"] = $result;
            
            $this->view("customers/index", $data);
        }
    }
