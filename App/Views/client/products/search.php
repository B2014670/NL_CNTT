<!-- Banner -->
<div>
    <img src="<?= URL_ICON ?>/product-banner-Copy.jpg" alt="banner" class="img-fluid">
</div>

<!-- Menu -->
<div class="wrapper pt-3" style="background-color: var(--body)!important;">
    <div class="container d-flex flex-column align-items-center">
        <h2 class="title">RAU HÔM NAY TẠI NHÀ TÈO</h2>
        <h3 class="sub-title">Tìm kiếm: <?= $_GET["key"] ?></h2>
        <div class="cate-content container menu">
            <?php foreach($data["vege_to_show"] as $i => $vege) :?>
                <div class="cate-item">
                    <a href="<?= DOCUMENT_ROOT?>/products/detail/<?= $vege['id']?>"><img class="item-img" src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt=""></a>
                    <h5 class="item-name"><?= ucwords($vege['name']) ?></h5>
                    <div class="star-vote mt-1">
                        <?php
                            $rate = $data[$vege['id']]["rating"];
                            $vote = floor($rate);
                            $no_vote = floor(5-$rate);
                            $half_vote = 5 - ($vote + $no_vote);
                        ?>
                        <?php for($i=1; $i <= $vote; $i++) : ?>
                            <i class="fas fa-star" style="color: #FFCC33; margin-left:1px; margin-right:1px; font-size: 16px;"></i>
                        <?php endfor; ?>
                        <?php for($i=1; $i <= $half_vote; $i++) : ?>
                            <i class="fas fa-star-half-alt" style="color: #FFCC33; margin-left:1px; margin-right:1px; font-size: 16px;"></i>
                        <?php endfor; ?>
                        <?php for($i=1; $i <= $no_vote; $i++) : ?>
                            <i class="far fa-star" style="color: #FFCC33; margin-left:1px; margin-right:1px; font-size: 16px;"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="price-button">
                        <p style="color: var(--green); font-weight: 700; font-size:22px; margin-bottom:0; line-height: 38px"><?= number_format($vege["sale_price"]==NULL ? $vege["price"] : $vege["sale_price"],0, ',','.') ?>đ</p>
                        <button onclick="addToCart(<?= isset($_SESSION['user'])? $_SESSION['user']['id']: 0 ?> , <?= $vege['id']?>)" class="btn btn-primary" style="font-size: 14px; font-weight: 700;">Thêm vào giỏ</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if($data["vege_to_show"] == []) :?>
            <div style="margin-bottom: 30px">
                <i>Không có kết quả nào được tìm thấy.</i>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- End menu -->

<!-- Categories -->
<div class="wrapper pt-3" style="background-color: var(--body)!important;">
    <div class="container d-flex flex-column align-items-center">
        <h3 class="sub-title">Xem Thêm</h2>
        <h2 class="title">CÁC LOẠI SẢN PHẨM CỦA TÈO</h2>
        <div class="cate-content container categories">
            <?php foreach($data["cate"] as $i => $cate) :?>
                <a href="<?= DOCUMENT_ROOT ?>/products/categories?id=<?= $cate['id']?>&page=1">
                    <div class="cate-item">
                        <img class="item-img" src="<?= URL_IMG ?>/categories/<?= $cate["image"]?>" alt="">
                        <h5 class="item-name"><?= ucfirst($cate["name"]) ?></h5>
                        <p class="item-des">Các loại <?= strtolower($cate["name"]) ?> tươi</p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- End categories -->