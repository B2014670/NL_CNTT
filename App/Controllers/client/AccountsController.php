<?php
use App\Core\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';

class AccountsController extends Controller
{
    private $userModel;

    function __construct()
    {
        $this->userModel = $this->model("UserModel");
    }

    function Index()
    {
        $this->view("auth/login", []);
    }

    function register()
    {
        $this->view("auth/register", []);
    }

    function forget()
    {
        $this->view("auth/forgetPassword", []);
    }

    //Process register
    function signup()
    {
        $result = $this->userModel->register($_POST);
        if ($result == true) $this->view("auth/login", []);
        else $this->view("auth/register", []);
    }

    //Process login
    function signin()
    {
        $result = $this->userModel->authenticate($_POST);
        if ($result[0] === true) {
            $_SESSION["user"] = $result[1];
            header("Location: " . DOCUMENT_ROOT);
        } else {
            print_r($result);
            $this->view("auth/login", []);
        }
    }

    function passwordReset()
    {
        if (isset($_POST['password-reset-token']) && $_POST['email']) {
            $result = $this->userModel->checkEmailExist($_POST['email']);
            if ($result[0] === true) {

                $emailId = $_POST['email'];
                $token = md5($emailId) . rand(10, 9999);
                $expFormat = mktime(
                    date("H"),
                    date("i"),
                    date("s"),
                    date("m"),
                    date("d") + 1,
                    date("Y")
                );
                $expDate = date("Y-m-d H:i:s", $expFormat);

                $data['token'] =  $token;
                $data['expDate'] = $expDate;
                $data['email'] = $emailId;
                $result1 = $this->userModel->ressetPass($data);
                $href = "http://localhost/accounts/resset?key=" . $emailId . "&token=" . $token . "";
                //Create an instance; passing `true` enables exceptions

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = 0; //0,1,2: chế độ debug
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->CharSet  = "utf-8";
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

                    // $mail->Host       = 'smtp.mail.yahoo.com';                  //Set the SMTP server to send through
                    // $mail->Username   = "thanhluan3161@yahoo.com" ;             //SMTP username
                    // $mail->Password   = "hkdcfezplpumfimv" ;                    //SMTP yahoo app password

                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server 
                    $mail->Username   = "luanb2014670@student.ctu.edu.vn" ;   //SMTP username
                    $mail->Password   = "8x2Lg7QH" ;                          //SMTP  app password

    
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('thanhluan3161@yahoo.com', 'Fazzo.store');
                    $mail->addAddress($result[1]['email'], $result[1]['name']);     //Add a recipient
                    // $mail->addAddress('ellen@example.com');               //Name is optional
                    $mail->addReplyTo('thanhluan3161@yahoo.com', 'Fazzo.store');

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Yêu cầu đặt lại mật khẩu';
                    $mail->Body = '
                        <div style="max-width:640px;margin:0 auto;border-radius:4px;overflow:hidden">
                            <div style="margin:0px auto;max-width:640px;background:#ffffff">
                            <table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;background:#ffffff" align="center" border="0">
                                <tbody>
                                <tr>
                                    <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:40px 50px">
                                    <div aria-labelledby="mj-column-per-100" class="m_-4968140515328076627mj-column-per-100" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%">
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="word-break:break-word;font-size:0px;padding:0px" align="left">
                                                    <div style="color:#737f8d;font-family:Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;font-size:16px;line-height:24px;text-align:left">
            
                                                    <h2 style="font-family:Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;font-weight:500;font-size:20px;color:#4f545c;letter-spacing:0.27px"> Chào' . $result[1]['name'] . ',</h2>
                                                    <p>Mật khẩu Fazzo.store của bạn có thể được reset bằng nút bên dưới. Nếu bạn không yêu cầu mật khẩu mới, hãy bỏ qua email này.</p>
            
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="word-break:break-word;font-size:0px;padding:10px 25px;padding-top:20px" align="center">
                                                    <table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate" align="center" border="0">
                                                    <tbody>
                                                        <tr>
                                                        <td style="border:none;border-radius:3px;color:white;padding:15px 19px" align="center" valign="middle" bgcolor="#5865f2"><a href="' . $href . '" style="text-decoration:none;line-height:100%;background:#5865f2;color:white;font-family:Ubuntu,Helvetica,Arial,sans-serif;font-size:15px;font-weight:normal;text-transform:none;margin:0px" target="_blank" >
                                                            Reset Mật Khẩu
                                                            </a></td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="word-break:break-word;font-size:0px;padding:30px 0px">
                                                    <p style="font-size:1px;margin:0px auto;border-top:1px solid #dcddde;width:100%"></p>
                                                </td>
                                            </tr>                                
                                        </tbody>
                                        </table>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        ';

                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if ($mail->send()) {
                        print_r('Yêu cầu resset mật khẩu đã gửi, vui lòng kiểm tra email!');
                        $this->view("auth/login", []);
                    }
                } catch (Exception $e) {
                    print_r('Yêu cầu chưa được gửi đi, vui lòng kiểm tra lại email bạn đã nhập!');
                    $this->view("auth/resentMail", $data);
                    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Mail chưa đăng ký thành viên";
            }
        }
    }

    function resset()
    {
        if (isset($_GET['key']) && isset($_GET['token'])) {
            $data['token'] = $_GET['token'];
            $data['email'] = $_GET['key'];
            $result = $this->userModel->checkLinkExpired($data);
            // print_r($result);
            if ($result[0] == true) {
                $this->view("auth/ressetPassword", $data);
            } else {
                print_r($result[1]);
                $this->view("auth/resentMail", $data);
            }
        } else {
            echo '<p>Liên kết quên mật khẩu này không tồn tại</p>';
        }
    }
    function updateForgetPassword()
    {
        if (isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email']) {
            if ($_POST['password'] == $_POST['re-password']) {
                $data['emailId'] = $_POST['email'];
                $data['token'] = $_POST['reset_link_token'];
                $data['password'] = $_POST['password'];
                $result = $this->userModel->updateForgetPassword($data);
                print_r('Mật khẩu đã đươc thay đỗi');
                $this->view("auth/login", []);
            } else {                
                print_r('Giá trị không khớp');
                header($_SERVER['HTTP_REFERER']);
            }
        }
    }

    function logout()
    {
        session_destroy();
        header("Location: " . DOCUMENT_ROOT . "/accounts");
    }

    //Check email register
    function checkEmail()
    {
        $result = $this->userModel->checkEmailExist($_GET["email"]);
        print_r($result[0]);
    }
}
