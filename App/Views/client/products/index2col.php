<!-- Banner -->
<div>
    <img src="<?= URL_ICON ?>/product-banner-Copy.jpg" alt="banner" class="img-fluid">
</div>

<style>
    .prod_accordion {
        background-color: #fff;
        margin: 10px 0;
        font-size: 16px;
        color: #000c;
        cursor: pointer;
        transition: all .3s ease-in-out;
    }

    .prod_accordion-title {
        display: flex;
        border-bottom: 1px solid rgb(180, 180, 180);
        padding: 15px;
        gap: 15px;
        align-items: center;
        cursor: pointer;
    }
</style>
<!-- Menu -->
<div class=" mt-4 row g-0 d-flex justify-content-center" style="background-color: var(--body)!important;">

    <div id="filterSection" class="pl-0 col-xl-2 col-lg-3 col-md-3">
        <div class="products_filters">
            <div class="prod_accordion">
                <?php foreach ($data["cate"] as $i => $cate) : ?>
                    <a href="<?= DOCUMENT_ROOT ?>/products/categories?id=<?= $cate['id'] ?>&page=1">
                        <div class="prod_accordion-title">
                            <div style="color: green; font-size: 20px;">+</div>
                            <div><?= ucfirst($cate["name"]) ?> tươi</div>
                        </div>
                    </a>                    
                <?php endforeach; ?>              
            </div>
        </div>        
    </div>

    <div id="productSection" class="ps-2 pe-0 col-xl-10 col-lg-9 col-md-9">
        <div id="filterName" class="fw-500 fs-16 pb-10 text-capitalize"></div>
        <div class="row" id="productsDisplay">
            <?php foreach ($data["vege_to_show"] as $i => $vege) : ?>
                <div class="col col-xl-3 col-lg-4 col-md-6 col-sm-12">
                    <div class="cate-item">
                        <a href="<?= DOCUMENT_ROOT ?>/products/detail/<?= $vege['id'] ?>"><img class="item-img" src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt=""></a>
                        <h5 class="item-name"><?= ucwords($vege['name']) ?></h5>
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
                </div>
            <?php endforeach; ?>

            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                <ul class="pagination mt-3">
                    <li class="page-item ps-1 pe-1"><a class="page-link" href="<?= DOCUMENT_ROOT ?>/products/index?page=<?= $data['page'] - 1 ?>"><i class="fas fa-angle-double-left"></i></a></li>
                    <?php $num = $data["num_of_page"] ?>
                    <?php for ($i = 1; $i <= $num; $i++) : ?>
                        <li class="page-item ps-1 pe-1 <?= $i == $data['page'] ? 'active' : '' ?>"><a class="page-link" href="<?= DOCUMENT_ROOT ?>/products/index?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item ps-1 pe-1"><a class="page-link" href="<?= DOCUMENT_ROOT ?>/products/index?page=<?= $data['page'] + 1 ?>"><i class="fas fa-angle-double-right"></i></a></li>
                </ul>
            </nav>

        </div>
    </div>

</div>
<!-- End menu -->

<!-- Categories -->
<div class=" pt-3" style="background-color: var(--body)!important;">
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
<!-- End categories -->