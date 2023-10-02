<!-- Banner -->
<div>
    <img src="<?= URL_ICON ?>/product-banner-Copy.jpg" alt="banner" class="img-fluid">
</div>


<style>
    #heroDiv {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
        margin-right: 2rem !important;
        margin-left: 2rem !important;
    }

    #heroCarousel>ol {
        position: relative;
    }

    #heroCarousel>ol>li {
        margin-left: 10px;
        margin-right: 10px;
        color: black;
        background-color: #abe1cf;
        border-radius: 50%;
        width: 10px;
        height: 10px;
    }

    #heroCarousel>ol>li.active {
        background-color: #27ba89;
    }

    /* end slide */

    /* slick */
    .lead {
        font-size: 1.5rem;
        font-weight: 300;
    }

    .slider {
        width: 100%;
        margin: 0 auto;

    }

    .slick-slide {
        margin: 0px 20px;
    }

    .slick-slide img {
        width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }


    .slick-slide {
        transition: all ease-in-out .3s;
    }

    /* end slick */
</style>
<div style="background-color: var(--body)!important;">
    <div id="heroDiv" class="row">
        <div class="col-md-8 p-0 m-0">
        
            <div id="heroCarousel" class="carousel slide mt-3 mx-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="public\img\home\banner1.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner1.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner1.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner1.png" class="d-block w-100"></div>
                    <div class="carousel-item"><img src="public\img\home\banner1.png" class="d-block w-100"></div>
                </div>
                <ol class="carousel-indicators p-0 m-0">
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="1" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="2" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="3" class=""></li>
                    <li data-bs-target="#heroCarousel" data-bs-slide-to="4" class=""></li>
                </ol>

            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="row my-3 mr-3"><img src="public\img\home\advertise11.png" alt="12hrs" class="img-responsive"></div>
            <div class="row my-3 mr-3"><img src="public\img\home\advertise22.png" alt="farm-fresh" class="img-responsive"></div>
            <div class="row my-3 mr-3"><img src="public\img\home\advertise33.png" alt="express-delivery" class="img-responsive"></div>
        </div>
        <h3 class="sub-title">Sản Phẩm</h2>
            <h2 class="title">GIÁ TỐT</h2>
            <section class="responsive slider">
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
                        <div class="price-button">
                            <p style="color: var(--green); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 38px"><?= number_format($vege["sale_price"] == NULL ? $vege["price"] : $vege["sale_price"], 0, ',', '.') ?>đ</p>
                            <button onclick="addToCart(<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?> , <?= $vege['id'] ?>)" class="btn btn-primary" style="font-size: 14px; font-weight: 700;">Thêm vào giỏ</button>
                        </div>
                    </div>
                <?php endforeach; ?>

            </section>
    </div>
</div>

<!-- End banner -->



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
                        <div class="price-button">
                            <p style="color: var(--green); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 38px"><?= number_format($vege["sale_price"] == NULL ? $vege["price"] : $vege["sale_price"], 0, ',', '.') ?>đ</p>
                            <button onclick="addToCart(<?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?> , <?= $vege['id'] ?>)" class="btn btn-primary" style="font-size: 14px; font-weight: 700;">Thêm vào giỏ</button>
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