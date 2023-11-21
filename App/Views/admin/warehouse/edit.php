<?php
// print_r($data)
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Chỉnh sửa thông tin lô hàng</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin">Trang chủ</a></li>
          <li class="breadcrumb-item active"><a href="<?= DOCUMENT_ROOT ?>/admin/warehouse">Lô hàng</a></li>
          <li class="breadcrumb-item active">Chỉnh sửa</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <!-- general form elements -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Thông tin sản phẩm</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?php DOCUMENT_ROOT ?>/admin/warehouse/update/<?= $data['ware']['id'] ?>" method="post" enctype="multipart/form-data">
      <div class="card-body">

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="id">Sản phẩm</label>
              <select class="custom-select" id="id" name="id" required>
                <option value="" selected disabled>Chọn...</option>
                <?php foreach ($data["vege"] as $i => $vege) : ?>
                  <option value="<?= $vege["id"] ?>" <?= $vege["id"] == $data['ware']['id_vegetable'] ? "selected" : "" ?>>
                    <?= $vege["name"] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="entry_date">Ngày nhập</label>
              <input type="date" value="<?= $data['ware']['entry_date'] ?>" class="form-control" id="entry_date" name="entry_date" required>
            </div>
            <div class="form-group">
              <label for="expired_date">Hạn sử dụng</label>
              <input type="date" value="<?= $data['ware']['expired_date'] ?>" class="form-control" id="expired_date" name="expired_date" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="weight">Trọng lượng</label>
              <input type="number" min=0 step="any" value="<?= $data['ware']['quantity'] ?>" class="form-control" id="weight" name="weight" placeholder="Nhập trọng lượng" required>
            </div>
            <div class="form-group">
              <label for="stock">Tồn kho</label>
              <input type="number" min=0 step="any" value="<?= $data['ware']['stock'] ?>" class="form-control" id="stock" name="stock" placeholder="Nhập trọng lượng" required>
            </div>
            <div class="form-group">
              <label for="measure">Đơn vị</label>
              <select class="custom-select" id="measure" name="measure" required>
                <option value="1000">tấn</option>
                <option value="100">tạ</option>
                <option value="10">yến</option>
                <option value="1" selected>kg</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-info" disabled>Chỉnh sửa</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</section>