<div class="container">
  <div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
      <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
        <div class="card-img-left d-none d-md-flex">
          <!-- Background image for card set in CSS! -->
        </div>
        <div class="card-body p-4 p-sm-5">
          <h5 class="card-title text-center mb-5 fw-light fs-5">Đặt lại mật khẩu</h5>
          <form action="<?= DOCUMENT_ROOT ?>/accounts/passwordReset" method="POST">

            <div class="form-floating mb-3">
              
              <input name="email" type="text" class="form-control" id="floatingInputEmail" placeholder="name@example.com" onblur="checkEmailSentToken(this.value)" required style="border: 1px solid #ced4da" > <!-- onblur="checkEmailSentToken(this.value)" -->
              <label for="floatingInputEmail">Tài khoản email</label>
              <p id="checkEmailExist" style="display: none; color: red; margin-bottom:0px;">Email chưa đăng ký tài khoản!</p>
              <input type="hidden" name="password-reset-token">

            </div>

            <hr>

            <div class="d-grid mb-2">
              <button class="btn btn-lg btn-primary btn-login btn-sentMail fw-bold text-uppercase">Tiếp theo</button>
            </div>
            <a class="d-block text-center mt-2 small" href="<?= DOCUMENT_ROOT ?>/accounts/login">Quay lại đăng nhập</a>
            <a class="d-block text-center mt-2 small" href="<?= DOCUMENT_ROOT ?>/accounts/register">Bạn đã là thành viên chưa? Đăng ký</a>


          </form>
        </div>
      </div>
    </div>
  </div>
</div>