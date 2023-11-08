<?php
    use App\Core\Controller;

    class FeedbacksController extends Controller{
        private $feedbackModel;
        function __construct(){
            $this->feedbackModel = $this->model("FeedbacksModel");
        }

        function Index(){
            $data["feedback"] = $this->feedbackModel->showAll();
            $this->view("feedbacks/index", $data);
        }

        function delete(){
            if(isset($_GET)){
                $result =  $this->feedbackModel->deleteCmt($_GET);
                echo $result;
                return;
            }
            else echo "Can not delete this comment!"; 
        }
    }
?>