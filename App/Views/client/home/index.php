<!-- Banner -->
<div>
    <img src="<?= URL_ICON ?>/product-banner-Copy.jpg" alt="banner" class="img-fluid">
</div>
<div style="background-color: var(--body)!important;">
    <div id="heroDiv" class="row">
        <div class="col-md-8 p-0 m-0">
            <div id="heroCarousel" style="background-color: var(--body)!important;" class="carousel slide mt-2 mx-2" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="public\img\home\banner10.png" class="d-block w-100"></div>
                    <div class="carousel-item "><img src="public\img\home\banner1.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner2.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner3.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner4.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner6.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner5.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner7.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner8.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner9.png" class="d-block w-100"></div>

                </div>
                <ol class="carousel-indicators p-0 m-0">
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="1" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="2" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="3" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="4" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="5" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="6" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="7" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="8" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="9" class=""></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="advertise row mt-2 mr-2"><img src="public\img\home\advertise11.png" alt="12hrs" class="img-responsive"></div>
            <div class="advertise row mt-2 mr-2"><img src="public\img\home\advertise22.png" alt="farm-fresh" class="img-responsive"></div>
            <div class="advertise row mt-2 mr-2"><img src="public\img\home\advertise33.png" alt="express-delivery" class="img-responsive"></div>
        </div>

    </div>
</div>

<!-- End banner -->
<div style="background-color: var(--body)!important;">
    <div class="row salediv">
        <h3 class="sub-title">Sản Phẩm</h3>
        <h2 class="title">GIÁ TỐT</h2>
        <section class="responsive slider">
            <?php foreach ($data["sale"] as $i => $vege) : ?>
                <div class="cate-item">
                    <div class="ribbon">
                        <span class="ribbon4 text-white">Giảm <?= round(($vege["price"] - $vege["sale_price"]) / $vege["price"] * 100); ?>%</span>
                    </div>
                    <a href="<?= DOCUMENT_ROOT ?>/products/detail/<?= $vege['id'] ?>"><img class="item-img" src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt=""></a>
                    <h3 class="item-name"><?= ucwords($vege['name']) ?></h3>

                    <div class="price-button row">
                        <div class="col">
                            <?php if (($vege["sale_price"])) : ?>
                                <p style="color: var(--black); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 25px" class="text-decoration-line-through"><?= number_format($vege["sale_price"] != NULL ? $vege["price"] : $vege["sale_price"], 0, ',', '.') ?>đ</p>
                            <?php endif; ?>
                            <p style="color: var(--green); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 38px"><?= number_format($vege["sale_price"] == NULL ? $vege["price"] : $vege["sale_price"], 0, ',', '.') ?>đ</p>
                        </div>
                        <!-- <div class="col align-items-center">
                            <button onclick="addToCart(<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?> , <?= $vege['id'] ?>)" class="btn btn-primary" style="font-size: 14px; font-weight: 700;">Thêm</button>
                        </div> -->
                        <div class="col align-items-center">
                            <button onclick="addToCart(<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?> , <?= $vege['id'] ?>)" class="btn btn-primary" style="font-size: 14px; font-weight: 700; "><i class="fas fa-shopping-cart" aria-hidden="true"></i>Thêm</button>
                        </div>
                    </div>

                </div>

            <?php endforeach; ?>
        </section>
    </div>
</div>


<!-- Menu -->
<div class="wrapper pt-3" style="background-color: var(--body)!important;">
    <div class="container d-flex flex-column align-items-center">
        <h3 class="sub-title">Sản Phẩm</h2>
            <h2 class="title">CÁC LOẠI SẢN PHẨM CỦA TÈO</h2>

            <div class="cate-content container categories">
                <?php foreach ($data["cate"] as $i => $cate) : ?>
                    <a href="<?= DOCUMENT_ROOT ?>/products/categories?id=<?= $cate['id'] ?>&page=1">
                        <div class="cate-item">
                            <img class="item-img" src="<?= URL_IMG ?>/categories/<?= $cate["image"] ?>" alt="">
                            <h5 class="item-name"><?= ucfirst($cate["name"]) ?></h5>
                            <p class="item-des">Các loại <?= strtolower($cate["name"]) ?> tươi</p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
    </div>
</div>
<div class="wrapper pt-3" style="background-color: var(--body)!important;">
    <div class="container d-flex flex-column align-items-center">
        <h3 class="sub-title">Menu</h2>
            <h2 class="title">RAU HÔM NAY TẠI NHÀ TÈO</h2>

            <div class="cate-content container menu">
                <?php foreach ($data["vege_to_show"] as $i => $vege) : ?>
                    <div class="cate-item">
                        <a href="<?= DOCUMENT_ROOT ?>/products/detail/<?= $vege['id'] ?>"><img class="item-img" src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt=""></a>
                        <h3 class="item-name"><?= ucwords($vege['name']) ?></h3>
                        <div class="star-vote mt-1">
                            <?php
                            $rate = $data[$vege['id']]["rating"];
                            $vote = floor($rate);
                            $no_vote = floor(5 - $rate);
                            $half_vote = 5 - ($vote + $no_vote);
                            ?>
                            <?php for ($i = 1; $i <= $vote; $i++) : ?>
                                <i class="fas fa-star" style="color: #FFCC33; margin-left:1px; margin-right:1px; font-size: 16px;"></i>
                            <?php endfor; ?>
                            <?php for ($i = 1; $i <= $half_vote; $i++) : ?>
                                <i class="fas fa-star-half-alt" style="color: #FFCC33; margin-left:1px; margin-right:1px; font-size: 16px;"></i>
                            <?php endfor; ?>
                            <?php for ($i = 1; $i <= $no_vote; $i++) : ?>
                                <i class="far fa-star" style="color: #FFCC33; margin-left:1px; margin-right:1px; font-size: 16px;"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="price-button row">
                            <div class="col">
                                <?php if (($vege["sale_price"])) : ?>
                                    <p style="color: var(--black); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 25px" class="text-decoration-line-through"><?= number_format($vege["sale_price"] != NULL ? $vege["price"] : $vege["sale_price"], 0, ',', '.') ?>đ</p>
                                <?php endif; ?>
                                <p style="color: var(--green); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 38px"><?= number_format($vege["sale_price"] == NULL ? $vege["price"] : $vege["sale_price"], 0, ',', '.') ?>đ</p>
                            </div>
                            <div class="col align-items-center">
                                <button onclick="addToCart(<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?> , <?= $vege['id'] ?>)" class="btn btn-primary" style="font-size: 14px; font-weight: 700; "><i class="fas fa-shopping-cart" aria-hidden="true"></i>Thêm</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-3">
                    <li class="page-item ps-1 pe-1"><a class="page-link" href="<?= DOCUMENT_ROOT ?>/products/index?page=1"><i class="fas fa-angle-double-left"></i></a></li>
                    <?php $num = ceil($data["num_of_vege"] / NUM_OF_VEGE_ON_PAGE); ?>
                    <?php for ($i = 1; $i <= $num; $i++) : ?>
                        <li class="page-item ps-1 pe-1 <?= $i == 1 ? 'active' : '' ?>"><a class="page-link" href="<?= DOCUMENT_ROOT ?>/products/index?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item ps-1 pe-1"><a class="page-link" href="<?= DOCUMENT_ROOT ?>/products/index?page=2"><i class="fas fa-angle-double-right"></i></a></li>
                </ul>
            </nav>
    </div>
</div>
<!-- End menu -->
<!-- Guarranty -->
<?php require_once VIEW . "/client/shared/guarantee.php"; ?>
<!-- End guarranty -->