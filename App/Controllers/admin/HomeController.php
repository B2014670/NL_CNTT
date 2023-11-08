<?php
    use App\Core\Controller;
    class HomeController extends Controller{
        private $vegeModel;

        function __construct(){
            $this->vegeModel = $this->model("VegetablesModel");
        }
        
        function Index(){
            $this->view("home/index", []);
        }
    }
?>