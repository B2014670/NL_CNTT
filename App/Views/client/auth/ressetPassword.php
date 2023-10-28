<div class="container">
  <div class="row">
    <div class="col-lg-10 col-xl-9 mx-auto">
      <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
        <div class="card-img-left d-none d-md-flex">
          <!-- Background image for card set in CSS! -->
        </div>
        <div class="card-body p-4 p-sm-5">
          <h5 class="card-title text-center mb-5 fw-light fs-5">Đặt lại mật khẩu</h5>
          <form method="POST"  action="<?= DOCUMENT_ROOT ?>/accounts/updateForgetPassword" > 
            <input type="hidden" name="email" value="<?php echo $data['email'] ?>">
            <input type="hidden" name="reset_link_token" value="<?php echo $data['token']; ?>">
            <div class="form-floating mb-3">
              <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" require>
              <label for="floatingPassword">Đặt mật khẩu<b style="color: red">(*)</b></label>
              <p id="checkPassword" style="color: red"></p>
            </div>

            <div class="form-floating mb-3">
              <input name="re-password" type="password" class="form-control" id="floatingPasswordConfirm" placeholder="Confirm Password" require>
              <label for="floatingPasswordConfirm">Nhập lại mật khẩu<b style="color: red">(*)</b></label>
              <p id="checkPrePassword" style="color: red"> </p>
            </div>

            <hr>

            <div class="d-grid mb-2">
              <button class="btn btn-lg btn-primary btn-login btn-sentMail fw-bold text-uppercase">Đặt lại</button>
            </div>
            <a class="d-block text-center mt-2 small" href="<?= DOCUMENT_ROOT ?>/accounts/login">Quay lại đăng nhập</a>
            <a class="d-block text-center mt-2 small" href="<?= DOCUMENT_ROOT ?>/accounts/register">Bạn đã là thành viên chưa? Đăng ký</a>


          </form>
        </div>
      </div>
    </div>
  </div>
</div>