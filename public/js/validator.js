function checkEmailAddress(email) {
  //Get url of server to run 'localhost:81/accounts/checkEmail...'
  var documentRoot = document.getElementById("documentRootId").innerText;
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      //Get result from function checkEmail() in AccountsController
      var reponse = this.response;

      if (reponse == true) {//Email exist
        document.querySelector("#checkEmailExist").style.display = "block";
        document.querySelector(".btn-sign").classList.add("disabled");    
      }
      else {//Email can use 
        document.querySelector("#checkEmailExist").style.display = "none";
      }
    }
  }

  //Call funtion checkEmail() in AccountsController
  xhttp.open("GET", `${documentRoot}/accounts/checkEmail?email=${email}`, true);
  xhttp.send();
}

function checkSignUp() {
  //lay formElement
  var formElement = document.querySelector('#registerForm');
  if (formElement) {
    hoten = formElement.querySelector('#floatingInputUsername');
    email = formElement.querySelector('#floatingInputEmail');
    pass = formElement.querySelector('#floatingPassword');
    pass_laplai = formElement.querySelector('#floatingPasswordConfirm');
    phone = formElement.querySelector('#floatingInputPhone');
    address = formElement.querySelector('#floatingInputAddress');
    console.log(address);
    const regexPhoneNumber = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
    const regexEmail = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;
    if (hoten.value == "") {
      alert('Hãy nhập họ tên!');
      return false;
    }
    if (email.value == "") {
      alert('Hãy nhập email!');      
      return false;
    }
    

    if (pass.value == "") {
      alert('Mật khẩu không được bỏ trống!');
      return false;       
    }else if (pass.value.length < 6) {
      alert('Mật khẩu tối thiểu 6 ký tự');      
      return false
    } else {
      let flag1 = 0, flag2 = 0;//kiem tra ky tu: flag1 so,flag2 là ky tu
      for (let i = 0; i < pass.value.length; i++) {
        if (isFinite(pass.value[i]) == true) {// kiem tra co phai la so huu han hay khong
          flag1 = 1;
        }// danh dau co mot ky tu la so
        else {
          flag2 = 1;
        }
      }
      if (flag1 == 0 || flag2 == 0) {        
        alert('Mật khẩu phải có các ký tự và chữ số');
        return false
      }

    }

    if (pass.value != pass_laplai.value) {
      alert('Giá trị nhập vào không khớp');
      return false;
    }
    
    if (phone.value == "") {
      alert('Số điện thoại không được bỏ trống ');
      return false;
    }
    
    if (address.value == "") {
      alert('Địa chỉ không được bỏ trống ');
      return false;
    }
    if (email.match(regexEmail) == false) {
      alert('Email không hợp lệ!');      
      return false;
    }
    if (phone.match(regexPhoneNumber) == false) {
      alert('Số điện thoại không đúng');
      return false;
    }
  }
}



