<?php

use App\Core\Database;

class WarehouseModel extends Database
{

    function all()
    {
        $sql = "SELECT * FROM vegetables JOIN warehouse ON warehouse.id_vegetable = vegetables.id ORDER BY expired_date ASC";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    //chon id cua san pham gan het date nhat
    function nearestExpired($id_vege)
    {
        $stmt = $this->conn->prepare("SELECT id FROM warehouse WHERE id_vegetable = ?
                                    ORDER BY expired_date ASC
                                    LIMIT 1;");
        $stmt->bind_param("i", $id_vege);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // //get vegetables by id
    function getBatchById($idWare)
    {
        $stmt = $this->conn->prepare("SELECT * FROM warehouse WHERE id = ?");
        $stmt->bind_param("i", $idWare);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    function insert($data)
    {
        $id_vege = $data["id"];
        $entry_date = $data["entry_date"];
        $expired_date = $data["expired_date"];
        $weight = $data["weight"] * $data["measure"];

        $stmt = $this->conn->prepare("INSERT INTO warehouse VALUES (NULL, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdd", $id_vege, $entry_date, $expired_date, $weight, $weight);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($data)
    {
        $id = $data["id"];
        $id_vege = $data["id_vege"];
        $entry_date = $data["entry_date"];
        $expired_date = $data["expired_date"];
        $quantity = $data["weight"] * $data["measure"];
        $stock = $data["stock"] * $data["measure"];

        $stmt = $this->conn->prepare("UPDATE warehouse SET id_vegetable =?, entry_date=?, expired_date=?, quantity=?, stock=? WHERE id=?");
        $stmt->bind_param("issddi", $id_vege, $entry_date, $expired_date, $quantity, $stock, $id);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Cap nhat so luong trong kho khi admin duyet don
    function updateStock($data)
    {
        $id = $data["a"]["id"];
        $id_vege = $data["id_vege"];
        $amount = $data["amount"];
        $weight = $data["weight"];
        $weightKg = $amount*$weight/1000;      

        $stmt = $this->conn->prepare("UPDATE warehouse SET stock= stock-? WHERE id=? AND id_vegetable=?");
        $stmt->bind_param("dii",$weightKg, $id, $id_vege);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }


    //  //Count all vegetables on DB
    //  function count(){
    //     $sql = "SELECT id FROM vegetables";
    //     $result = $this->conn->query($sql);

    //     if($result->num_rows >0){
    //         return $result->num_rows;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // //Get vegetables to show on page (Pagination)
    // function getVege($limit, $num){
    //     $stmt = $this->conn->prepare("SELECT * FROM vegetables LIMIT ?, ?");
    //     $stmt->bind_param("ii", $limit, $num);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // //Search vegetables by key
    // function getVegeByKey($key){
    //     $key = "%".$key."%";
    //     $stmt = $this->conn->prepare("SELECT * FROM vegetables WHERE name LIKE ?");
    //     $stmt->bind_param("s", $key);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         $cakes = $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     else{
    //         $cakes =[];
    //     }

    //     return $cakes;
    // }

    // //Get vegetables by categories to show on page
    // function getVegeByCategories($idCate, $limit, $num){
    //     $stmt = $this->conn->prepare("SELECT * FROM vegetables WHERE id_veg_type = ? LIMIT ?, ?");
    //     $stmt->bind_param("iii", $idCate, $limit, $num);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     else{
    //         return false;
    //     }
    // }

    //  //Get vegetables by categories to show on page
    // function getVegeByCate($idCate){
    //     $stmt = $this->conn->prepare("SELECT * FROM vegetables WHERE id_veg_type = ?");
    //     $stmt->bind_param("i", $idCate);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // //Count vegetables by categories
    // function countVegeByCategories($idCate){
    //     $stmt = $this->conn->prepare("SELECT id FROM vegetables WHERE id_veg_type = ?");
    //     $stmt->bind_param("i", $idCate);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         return $result->num_rows;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // //get vegetables by id
    // function getVegeById($idVege){
    //     $stmt = $this->conn->prepare("SELECT * FROM vegetables WHERE id = ?");
    //     $stmt->bind_param("i", $idVege);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         return $result->fetch_assoc();
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // //get vegetables details by id
    // function getVegeDetail($idVege){
    //     $stmt = $this->conn->prepare("CALL sp_getVegeDetail(?)");
    //     $stmt->bind_param("i", $idVege);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         return $result->fetch_assoc();
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // //Search vegetables by key
    // function getByKey($key){
    //     $key = "%".$key."%";
    //     $stmt = $this->conn->prepare("SELECT * FROM vegetables WHERE name LIKE ?");
    //     $stmt->bind_param("s", $key);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         $veges = $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     else{
    //         $veges =[];
    //     }

    //     return $veges;
    // }

    // // Admin
    // //Create new vege processing
    // function insert($data){
    //     $cate = $data["cate"];
    //     $name = $data["name"];
    //     $weight = $data["weight"];
    //     $price = $data["price"];
    //     $orig = $data["orig"];
    //     $image = $data["image"];

    //     $stmt = $this->conn->prepare("INSERT INTO vegetables VALUES (NULL, ?, ?, ?, ?, ?, ?, 0 ,NULL)");
    //     $stmt->bind_param("siiiis",$name, $weight, $price, $orig, $cate, $image);
    //     $stmt->execute();
    //     $result = $stmt->affected_rows;

    //     if($result>0){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }


    // //Edit vege processing
    // function update($data){
    //     $id = $data["id"];
    //     $cate = $data["cate"];
    //     $name = $data["name"];
    //     $weight = $data["weight"];
    //     $price = $data["price"];
    //     $orig = $data["orig"];
    //     $image = $data["image"];

    //     $stmt = $this->conn->prepare("UPDATE vegetables SET name=?, price=?, weight=?, id_orig=?, id_veg_type=?, image=? WHERE id=?");
    //     $stmt->bind_param("siiiisi",$name, $price, $weight, $orig, $cate, $image, $id);
    //     $stmt->execute();
    //     $result = $stmt->affected_rows;

    //     if($result>0){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // function deleteVege($data){
    //     $id = $data["vegeId"];
    //     $stmt = $this->conn->prepare("DELETE FROM vegetables WHERE id=?");
    //     $stmt->bind_param("i",$id);
    //     $stmt->execute();
    //     $result = $stmt->affected_rows;

    //     if($result<1){
    //         return false;
    //     }
    //     else{
    //         return true;
    //     }
    // }

    // //Get sale vege
    // function getSale(){
    //     $sql = "SELECT * FROM vegetables WHERE sale=1";
    //     $result = $this->conn->query($sql);

    //     if($result->num_rows >0){
    //         return $result->fetch_all(MYSQLI_ASSOC);
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // function countSale(){
    //     $sql = "SELECT id FROM vegetables WHERE sale=1";
    //     $result = $this->conn->query($sql);

    //     if($result->num_rows >0){
    //         return $result->num_rows;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    // function createSale($data){
    //     $id = $data["id_vege"];
    //     $sale_price= $data["price"];
    //     $sale = 1;
    //     $stmt = $this->conn->prepare("UPDATE vegetables SET sale_price=?, sale=? WHERE id=?");
    //     $stmt->bind_param("sii", $sale_price, $sale, $id);
    //     $stmt->execute();
    //     $result = $stmt->affected_rows;

    //     if($result<1){
    //         return false;
    //     }
    //     else{
    //         return true;
    //     }
    // }

    // function updateSalePrice($data){
    //     $id = $data["id"];
    //     $sale_price= $data["price"];
    //     $stmt = $this->conn->prepare("UPDATE vegetables SET sale_price=? WHERE id=?");
    //     $stmt->bind_param("ii", $sale_price, $id);
    //     $stmt->execute();
    //     $result = $stmt->affected_rows;

    //     if($result<1){
    //         return false;
    //     }
    //     else{
    //         return true;
    //     }
    // }

    // function getPrice($data){
    //     $id = $data["vegeId"];
    //     $stmt = $this->conn->prepare("SELECT price FROM vegetables WHERE id=?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if($result->num_rows >0){
    //         $veges = $result->fetch_assoc();
    //     }
    //     else{
    //         $veges =[];
    //     }

    //     return $veges;
    // }

    // function deleteSale($data){
    //     $id = $data["vegeId"];
    //     $sale_price= NULL;
    //     $sale = 0;
    //     $stmt = $this->conn->prepare("UPDATE vegetables SET sale_price=?, sale=? WHERE id=?");
    //     $stmt->bind_param("sii", $sale_price, $sale, $id);
    //     $stmt->execute();
    //     $result = $stmt->affected_rows;

    //     if($result<1){
    //         return false;
    //     }
    //     else{
    //         return true;
    //     }
    // }
}
