<?php

    use App\Core\Database;

    class OrderModel extends Database{

        //Get id-order of delivered orders by id-user
        function getDeliveredOrders($userId){
            $status = 4;
            $stmt = $this->conn->prepare("SELECT id, order_time FROM orders WHERE id_user=? AND id_status=?");

            $stmt->bind_param("ii", $userId, $status);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        //Get id-order of delivering orders by id-user
        function getDeliveringOrders($userId){
            $status = 3;
            $stmt = $this->conn->prepare("SELECT id, order_time FROM orders WHERE id_user=? AND id_status=?");

            $stmt->bind_param("ii", $userId, $status);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return 0;
        }

        //Get id-order of prepairing orders by id-user
        function getPreparingOrders($userId){
            $status = 2;
            $stmt = $this->conn->prepare("SELECT id, order_time FROM orders WHERE id_user=? AND id_status=?");

            $stmt->bind_param("ii", $userId, $status);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        //Get id-order of no-processed orders by id-user
        function getNoProcessedOrders($userId){
            $status = 1;
            $stmt = $this->conn->prepare("SELECT id, order_time FROM orders WHERE id_user=? AND id_status=?");

            $stmt->bind_param("ii", $userId, $status);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        //Get cakes of every order
        function getVegeInOrder($orderId){
            $stmt = $this->conn->prepare("CALL sp_getVegeInOrder(?)");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        function book($userId){
            $stmt = $this->conn->prepare("CALL sp_book(?)");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_assoc();
            }
            else return false;
        }

        function unbook($userId){
            $stmt = $this->conn->prepare("CALL delete_sp_book(?)");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_assoc();
            }
            else return false;
        }

        function getMaxOrderid($userId){
            $stmt = $this->conn->prepare("SELECT max(id) as orderId FROM orders WHERE id_user = ?;");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_assoc();
            }
            else return false;
        }

        function addToDetails($data){
            $orderId = $data["id_order"];
            $vegeId = $data["id_vege"];
            $amount = $data["amount"];
            $price = $data["price"];
            $stmt = $this->conn->prepare("INSERT INTO order_details VALUES (?,?,?,?)");
            $stmt->bind_param("iiii", $orderId, $vegeId, $amount, $price);
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result>0){
                return true;
            }
            else return false;
        }

        function checkVegeDelivered($id_vege, $dataSession){
            $userID = $dataSession["user"]["id"];
            $status = 4;
            $stmt = $this->conn->prepare("SELECT id, id_veg 
                                        FROM orders JOIN order_details ON orders.id=order_details.id_order
                                        WHERE id_user=? AND id_veg=? AND id_status=?");
            $stmt->bind_param("iii", $userID, $id_vege, $status);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows >0){
                return $result->num_rows;
            }
            else{
                return 0;
            }
        }


        // Admin
        function all(){
            $sql = "SELECT O.id as id, O.order_time as order_time, O.delivery_time as deli_time, S.id as status, U.name as username, U.address as address 
                    FROM orders O JOIN status S ON O.id_status = S.id JOIN users U ON O.id_user = U.id
                    ORDER BY  O.order_time DESC";
            $result = $this->conn->query($sql);

            if($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else{
                return false;
            }
        }

        function finishedOrders(){
            $sql = "SELECT id  FROM orders WHERE id_status <> 5";
            $result = $this->conn->query($sql);

            if($result->num_rows >0){
                return $result->num_rows;
            }
            else{
                return false;
            }
        }

        function getOrderDetails($orderId){
            $stmt = $this->conn->prepare("CALL sp_getOrderDetails(?)");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        //Get number of no-processed orders by admin for minus warehouse
        function getOrderDetailNoProcess($data){
            $orderId = $data["orderId"];
            $stmt = $this->conn->prepare("SELECT V.id as id_vege, OD.amount as amount, V.weight                                                
                                        FROM orders O 
                                        JOIN order_details OD on O.id = OD.id_order 
                                        JOIN vegetables V on OD.id_veg = V.id                                 
                                        WHERE O.id = ? AND O.id_status=1");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        //check status NoProcess
        function checkOrderDetailNoProcess($data){
            $orderId = $data["orderId"];
            $stmt = $this->conn->prepare("SELECT V.id as id_vege, OD.amount as amount, V.weight                                                
                                        FROM orders O 
                                        JOIN order_details OD on O.id = OD.id_order 
                                        JOIN vegetables V on OD.id_veg = V.id                                 
                                        WHERE O.id = ? AND O.id_status=1");
            $stmt->bind_param("i", $orderId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return true;
            }
            else return false;
        }

        function updateStatus($data){
            $orderId = $data["orderId"];
            $statusId = $data["statusId"];
            $stmt = $this->conn->prepare("UPDATE orders SET id_status=? WHERE id=?");
            $stmt->bind_param("ii", $statusId, $orderId);
            $stmt->execute();
            $result = $stmt->affected_rows;
            if ($result>0){
                return true;
            }
            else return false;
        }

        function costOrderMonthlyOfYear($year){
            $stmt = $this->conn->prepare("SELECT EXTRACT(MONTH FROM o.order_time) AS month,                                                  
                                                SUM(od.price*od.amount) AS cost
                                        FROM orders o
                                        JOIN order_details od ON o.id = od.id_order
                                        WHERE EXTRACT(YEAR FROM o.order_time) = ?
                                        GROUP BY  EXTRACT(MONTH FROM o.order_time);");
            $stmt->bind_param("i", $year);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        function costOrderMonthOfYear($year, $month){
            $stmt = $this->conn->prepare("SELECT EXTRACT(MONTH FROM o.order_time) AS month,
                                                EXTRACT(YEAR FROM o.order_time) AS year,                                                  
                                                SUM(od.price*od.amount) AS cost
                                        FROM orders o
                                        JOIN order_details od ON o.id = od.id_order
                                        WHERE EXTRACT(YEAR FROM o.order_time) = ?
                                        AND EXTRACT(MONTH FROM o.order_time) = ?
                                        GROUP BY  EXTRACT(MONTH FROM o.order_time);");
            $stmt->bind_param("ii", $year, $month);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        function numVegeOfYear($year){
            $stmt = $this->conn->prepare("SELECT v.name, v.weight*SUM(od.amount) AS gram
                                            FROM orders o
                                            JOIN order_details od ON o.id = od.id_order
                                            JOIN vegetables v ON od.id_veg= v.id
                                            WHERE EXTRACT(YEAR FROM o.order_time) = ?
                                            GROUP BY  v.name;");
            $stmt->bind_param("i", $year);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        function numVegeMonthOfYear($year, $month){
            $stmt = $this->conn->prepare("SELECT v.name, v.weight*SUM(od.amount) AS gram
                                            FROM orders o
                                            JOIN order_details od ON o.id = od.id_order
                                            JOIN vegetables v ON od.id_veg= v.id
                                            WHERE EXTRACT(YEAR FROM o.order_time) = ?
                                            AND EXTRACT(MONTH FROM o.order_time) = ?
                                            GROUP BY  v.name;");
            $stmt->bind_param("ii", $year, $month);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }

        function year(){
            $stmt = $this->conn->prepare("SELECT DISTINCT EXTRACT(year FROM orders.order_time) AS year FROM orders ORDER BY EXTRACT(year FROM orders.order_time) DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows >0){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else return false;
        }
    }
