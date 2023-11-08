<!-- Banner -->
<div>
    <img src="<?= URL_ICON ?>/product-banner-Copy.jpg" alt="banner" class="img-fluid">
</div>

<div class="wrapper bg-white">
    <div class="container pt-3 border border-2 rounded-3" style="background-color: var(--body)">
        <ul class="row taikhoan-nav navbar navbar-expand-lg navbar-light  mx-auto">
            <li class="col-md-3 col-sm-12 mt-2 bg-white text-center"><a class="text-dark" href="<?= DOCUMENT_ROOT ?>/user">THÔNG TIN</a></li>
            <li class="col-md-6 col-sm-12 mt-2 bg-white text-center"><a class="text-dark" href="<?= DOCUMENT_ROOT ?>/user/history">LỊCH SỬ MUA HÀNG</a></li>
            <li class="col-md-3 col-sm-12 mt-2 bg-white text-center"><a class="text-dark" href="<?= DOCUMENT_ROOT ?>/user/password">MẬT KHẨU</a></li>
        </ul>
    </div>
</div>
<!-- User information -->
<h3 class="sub-title text-center pt-3" style="color: var(--bs-green)">Cá nhân</h3>
<h2 class="title text-center" style="color: var(--bs-primary)">THÔNG TIN CÁ NHÂN</h2>
<div class="wrapper bg-white">
    <div class="container border border-2 rounded-3" style="background-color: var(--body)">
        <div class="container">
            <div class="profile">
                <div class="user-avatar">
                    <img class="avatar-img mb-3" src="<?= URL_IMG ?>/users/<?= $data['user']['avatar'] ?>" alt="Ảnh đại diện">
                    <form action="" method="post">
                        <input type="file" name="file" id="file">
                        <label class="btn btn-primary" for="file">Tải ảnh lên</label>
                    </form>
                </div>
                <div class="user-info ">
                    <form action="<?= DOCUMENT_ROOT ?>/user/update" class="profile-form" method="post">
                        <div class="form-content">
                            <p class="input-name">Họ và tên</p>
                            <input name="name" type="text" id="username" value="<?= $data["user"]["name"] ?>">

                            <p class="input-name">Địa chỉ email</p>
                            <input name="email" type="text" id="email" value="<?= $data["user"]["email"] ?>">

                            <p class="input-name">Số điện thoại</p>
                            <input name="phone" type="text" id="phone" value="<?= $data["user"]["phone"] ?>">

                            <p class="input-name">Địa chỉ</p>
                            <input name="address" type="text" id="address" value="<?= $data["user"]["address"] ?>">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="container">
            <div class="profile">
                <div class="user-pass ">
                    <form action="<?= DOCUMENT_ROOT ?>/user/changepass" class="profile-form" method="post">
                        <div class="form-content">
                            <p class="input-name">Mật khẩu cũ</p>
                            <input name="pass_old" type="text" id="pass_old" value="">

                            <p class="input-name">Mật khẩu mới</p>
                            <input name="password" type="text" id="password" value="">

                            <p class="input-name">Xác nhận mật khẩu</p>
                            <input name="re-password" type="text" id="re-password" value="">
                        </div>
                        <input class="btn btn-primary" type="submit" value="Đỗi mật khẩu">
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>