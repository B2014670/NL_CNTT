<?php

use App\Core\Database;

class UserModel extends Database
{

    //Add new user into database
    function register($data)
    {
        $name = $data["name"];
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $email = $data["email"];
        $phone = $data["phone"];
        $role = 1;
        $address = $data["address"];
        $avatar = "default.jpg";

        $stmt = $this->conn->prepare("INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", $name, $phone, $address, $password, $email, $role, $avatar);
        $stmt->execute();

        $result = $stmt->affected_rows;

        if ($result < 1) return false;
        else return true;
    }

    //Authenticate when user login
    function authenticate($data)
    {
        $email = $data["email"];
        $password = $data["password"];

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            if (password_verify($password, $result["password"]) == true) return [true, $result];
            else return "Email hoặc mật khẩu không chính xác!";
            // if ($password === $result["password"]) return [true, $result];
            // else return "Password incorrect!";

        } else return 'Email hoặc mật khẩu không chính xác!';
    }

    //Authenticate when admin login
    function adminAuthenticate($data)
    {
        $email = $data["email"];
        $password = $data["password"];
        $role = 0;
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=? AND role=?");
        $stmt->bind_param("si", $email, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            if (password_verify($password, $result["password"]) == true) return [true, $result];
            // else return "Password incorrect!";
            // if ($password === $result["password"])
            //     return [true, $result];
            else return "Email hoặc mật khẩu không chính xác!";
        } else return "Email hoặc mật khẩu không chính xác!";
    }

    //Check email exist
    function checkEmailExist($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            return [true, $result];
        } else return [false, $result];
    }

    //Update user information
    function updateInfor($id_user, $data)
    {
        $stmt = $this->conn->prepare("UPDATE users SET name=?, email=?, phone=?, address=? WHERE id=?");
        $stmt->bind_param("ssssi", $data["name"], $data["email"], $data["phone"], $data["address"], $id_user);
        $stmt->execute();
        $row = $stmt->affected_rows;
        ///Return du lieu de cap nhat sesstion
        if ($row == 1 || $row == 0) {
            $stmt1 = $this->conn->prepare("SELECT * FROM users WHERE id=?");
            $stmt1->bind_param("s", $id_user);
            $stmt1->execute();
            $result = $stmt1->get_result();
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                return [true, $result];
            } else
                return [false, ''];
        } else return [false, ''];
        // $result = $stmt->affected_rows;

        // if ($result==1 || $result==0){
        //     return true;
        // }
        // else return false;
    }

    //Change password
    function changePass($id_user, $data)
    {
        //check password old
        $password = $data["pass_old"];
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            if (password_verify($password, $result["password"]) == true) {
                //updata password
                $password = password_hash($data["password"], PASSWORD_DEFAULT);
                $stmt = $this->conn->prepare("UPDATE users SET password=? WHERE id=?");
                $stmt->bind_param("si", $password, $id_user);
                $stmt->execute();
                $result = $stmt->affected_rows;

                if ($result == 1 || $result == 0) {
                    return true;
                } else return [false, "Cập nhật mật khẩu mới thất bại"];
            } else return [false, "Mật khẩu cũ chưa đúng"];
        } else {
            return [false, "Không tìm thấy tài khoản của bạn"];
        }
    }
    function ressetPass($data)
    {
        $stmt = $this->conn->prepare("UPDATE users SET reset_link_token=?, exp_date=? WHERE email=?");
        $stmt->bind_param("sss",  $data['token'], $data['expDate'], $data['email']);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result == 1 || $result == 0) {
            return [true, $result];
        } else return false;
    }

    function updateForgetPassword($data)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE reset_link_token=? and email=? ");
        $stmt->bind_param("ss", $data['token'], $data['emailId']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE users SET password=?, reset_link_token=NULL, exp_date=NULL  WHERE email=?");
            $stmt->bind_param("ss", $password, $data['emailId']);
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result == 1 || $result == 0) {
                return true;
            } else return false;
        } else {
            return false;
        }



        // $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `email`='" . $emailId . "'");
        // $row = mysqli_num_rows($query);
        // if ($row) {
        //     mysqli_query($conn, "UPDATE users set  password='" . $password . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
        //     echo '<p>Congratulations! Your password has been updated successfully.</p>';
        // } else {
        //     echo "<p>Something goes wrong. Please try again</p>";
        // }
    }

    function checkLinkExpired($data)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE reset_link_token=? and email=? ");
        $stmt->bind_param("ss", $data['token'], $data['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        $curDate = date("Y-m-d H:i:s");
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            if ($result['exp_date'] >= $curDate)
                return [true, $result];
            else
                return [false, 'Liên kết quên mật khẩu này đã hết hạn'];
        } else return [false, 'Liên kết quên mật khẩu này không tồn tại'];
    }




    //Get user information
    function getInfor($id_user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param("s", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else return false;
    }

    //Upload avatar
    function uploadAvatar($id_user, $data)
    {
        $url = $data["file"]["name"];
        move_uploaded_file($data["file"]["tmp_name"], IMG . DS . "users" . DS . $data["file"]["name"]);
        $stmt = $this->conn->prepare("UPDATE users SET avatar=? WHERE id=?");
        $stmt->bind_param("ss", $url, $id_user);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if ($result > 0) {
            return true;
        } else return false;
    }

    function getAll()
    {
        $sql = "SELECT name, phone, address, email FROM users WHERE role=1";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    function countAll()
    {
        $sql = "SELECT id FROM users WHERE role=1";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->num_rows;
        } else {
            return false;
        }
    }

}
