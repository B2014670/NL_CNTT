<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Nhập hàng</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin">Trang chủ</a></li>
          <li class="breadcrumb-item active"><a href="<?= DOCUMENT_ROOT ?>/admin/warehouse">Kho hàng</a></li>
          <li class="breadcrumb-item active">Nhập hàng</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <!-- general form elements -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Thông tin lô hàng</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?php DOCUMENT_ROOT ?>/admin/warehouse/store" method="post" enctype="multipart/form-data">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="id">Sản phẩm</label>
              <select class="custom-select" id="id" name="id" required>
                <option value="" selected disabled>Chọn...</option>
                <?php foreach ($data["vege"] as $i => $vege) : ?>
                  <option value="<?= $vege["id"] ?>"><?= $vege["name"] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="entry_date">Ngày nhập</label>
              <input type="date" data-date-format="d m YYYY" class="form-control" id="entry_date" name="entry_date" required>
            </div>
            <div class="form-group">
              <label for="expired_date">Hạn sử dụng</label>
              <input type="date" class="form-control" id="expired_date" name="expired_date" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="weight">Trọng lượng</label>
              <input type="number" min=0 step="any" class="form-control" id="weight" name="weight" placeholder="Nhập trọng lượng" required>
            </div>
            <div class="form-group">
              <label for="measure">Đơn vị</label>
              <select class="custom-select" id="measure" name="measure" required>
                <option value="" selected disabled>Chọn...</option>
                <option value="1000">tấn</option>
                <option value="100">tạ</option>
                <option value="10">yến</option>
                <option value="1">kg</option>                
              </select>
            </div>          
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-info">Thêm</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</section>