<?php
// print_r($data["warehoue"])
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Kho hàng</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin">Trang chủ</a></li>
          <li class="breadcrumb-item active">Kho hàng</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h4>Danh sách sản phẩm</h4>
              <a class="btn btn-primary" href="<?= DOCUMENT_ROOT ?>/admin/warehouse/create">Nhập hàng</a>
            </div>
          </div>
          <div class="card-body">
            <table id="cakeTable" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Lô</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>                  
                  <th>Số lượng(kg)</th>
                  <th>Còn lại(kg)</th>
                  <th>Ngày nhập</th>
                  <th>Hạn sử dụng</th>                  
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data["warehoue"] as $key => $vege) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $vege["name"] ?></td>
                    <td>
                      <img src="<?= URL_IMG ?>/vegetables/<?= $vege["image"] ?>" class="rounded" alt="..." style="width: 100px">
                    </td>                    
                    <td><?=number_format($vege["quantity"], 0, ',', ' ') ?></td>
                    <td><?= $vege["stock"] ?></td>
                    <td><?= date("d/m/Y", strtotime($vege["entry_date"]));?></td>
                    <td><?= date("d/m/Y", strtotime($vege["expired_date"]));?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="<?= DOCUMENT_ROOT ?>/admin/warehouse/edit/<?= $vege["id"] ?>" class="btn btn-info">Chỉnh sửa</a>
                        <!-- <button onclick="deleteVege(<?= $vege['id'] ?>)" class="btn btn-danger">Xóa</button> -->
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
</section>