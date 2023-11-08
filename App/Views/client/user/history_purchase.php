<div>
    <img src="<?= URL_ICON ?>/product-banner-Copy.jpg" alt="banner" class="img-fluid">
</div>

<div class="wrapper bg-white">
    <div class="container pt-3 border border-2 rounded-3" style="background-color: var(--body)">
        <ul class="taikhoan-nav navbar navbar-expand-lg navbar-light  mx-auto">
            <li class="col text-center"><a class="text-dark" href="<?= DOCUMENT_ROOT ?>/user">THÔNG TIN</a></li>
            <li class="col text-center"><a class="text-dark" href="<?= DOCUMENT_ROOT ?>/user/history">LỊCH SỬ MUA HÀNG</a></li>
            <li class="col text-center"><a class="text-dark" href="<?= DOCUMENT_ROOT ?>/user/password">ĐỖI MẬT KHẨU</a></li>
        </ul>
    </div>
</div>

<!-- History -->
<div class="wraper">
    <div class="container mt-3">
        <h3 class="sub-title text-center" style="color: var(--bs-green)">Đơn hàng</h2>
            <h2 class="title text-center" style="color: var(--bs-primary)">LỊCH SỬ MUA HÀNG</h2>
            <!-- No processed Orders -->
            <?php foreach ($data["noProcessedOrders"] as $index => $orders) : ?>
                <div class="history">
                    <?php $total = 0; ?>
                    <div class="history-title">Mã đơn hàng: #<?= $orders["id"];
                                                                print_r($data["noProcessedOrders"]) ?></div>

                    <?php foreach ($data[$orders["id"]]["vege"] as $i => $vege) : ?>
                        <div class="history-content">
                            <div class="history-content-img">
                                <img src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt="" class=>
                            </div>

                            <div class="history-content-decs">
                                <p class="cake-name"><b><?= $vege['name'] ?></b></p>
                                <p class="cake-size">Khối lượng: <?= $vege['weight'] ?>g</p>
                                <p class="cake-price" style="color: var(--main-color)">Giá tiền: <?= number_format($vege["price"], 0, ',', '.') ?> VND</p>
                                <p class="cake-quantity">Số lượng: <?= $vege['amount'] ?></p>
                            </div>
                        </div>
                        <?php $total = $total + $vege['price'] * $vege['amount'] ?>
                    <?php endforeach; ?>

                    <div class="history-ending">
                        <div class="history-ending1">
                            <p class="history-ending-content">Tổng tiền: </p>
                            <p class="history-ending-content" style="color: var(--main-color)"><?= number_format($total, 0, ',', '.') ?> VND</p>
                        </div>
                        <div class="history-ending2">
                            <p class="history-ending-content">Trạng thái: </p>
                            <p class="history-ending-content" style="color: var(--main-color)">Chưa xử lý</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Preparing Orders -->
            <?php foreach ($data["preparingOrders"] as $index => $orders) : ?>
                <div class="history">
                    <?php $total = 0; ?>
                    <div class="history-title">Mã đơn hàng: #<?= $orders["id"] ?></div>

                    <?php foreach ($data[$orders["id"]]["vege"] as $i => $vege) : ?>
                        <div class="history-content">
                            <div class="history-content-img">
                                <img src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt="" class=>
                            </div>

                            <div class="history-content-decs">
                                <p class="cake-name"><b><?= $vege['name'] ?></b></p>
                                <p class="cake-size">Khối lượng: <?= $vege['weight'] ?>g</p>
                                <p class="cake-price" style="color: var(--main-color)">Giá tiền: <?= number_format($vege["price"], 0, ',', '.') ?> VND</p>
                                <p class="cake-quantity">Số lượng: <?= $vege['amount'] ?></p>
                            </div>
                        </div>
                        <?php $total = $total + $vege['price'] * $vege['amount'] ?>
                    <?php endforeach; ?>

                    <div class="history-ending">
                        <div class="history-ending1">
                            <p class="history-ending-content">Tổng tiền: </p>
                            <p class="history-ending-content" style="color: var(--main-color)"><?= number_format($total, 0, ',', '.') ?> VND</p>
                        </div>
                        <div class="history-ending2">
                            <p class="history-ending-content">Trạng thái: </p>
                            <p class="history-ending-content" style="color: var(--main-color)">Đang chuẩn bị</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Delivering Orders -->
            <?php foreach ($data["deliveringOrders"] as $index => $orders) : ?>
                <div class="history">
                    <?php $total = 0; ?>
                    <div class="history-title">Mã đơn hàng: #<?= $orders["id"] ?></div>

                    <?php foreach ($data[$orders["id"]]["vege"] as $i => $vege) : ?>
                        <div class="history-content">
                            <div class="history-content-img">
                                <img src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt="" class=>
                            </div>

                            <div class="history-content-decs">
                                <p class="cake-name"><b><?= $vege['name'] ?></b></p>
                                <p class="cake-size">Khối lượng: <?= $vege['weight'] ?>g</p>
                                <p class="cake-price" style="color: var(--main-color)">Giá tiền: <?= number_format($vege["price"], 0, ',', '.') ?> VND</p>
                                <p class="cake-quantity">Số lượng: <?= $vege['amount'] ?></p>
                            </div>
                        </div>
                        <?php $total = $total + $vege['price'] * $vege['amount'] ?>
                    <?php endforeach; ?>

                    <div class="history-ending">
                        <div class="history-ending1">
                            <p class="history-ending-content">Tổng tiền: </p>
                            <p class="history-ending-content" style="color: var(--main-color)"><?= number_format($total, 0, ',', '.') ?> VND</p>
                        </div>
                        <div class="history-ending2">
                            <p class="history-ending-content">Trạng thái: </p>
                            <p class="history-ending-content" style="color: var(--main-color)">Đang giao</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Delivered Orders -->
            <?php foreach ($data["deliveredOrders"] as $index => $orders) : ?>
                <div class="history">
                    <?php $total = 0; ?>
                    <div class="history-title">Mã đơn hàng: #<?= $orders["id"] ?></div>

                    <?php foreach ($data[$orders["id"]]["vege"] as $i => $vege) : ?>
                        <div class="history-content">
                            <div class="history-content-img">
                                <img src="<?= URL_IMG ?>/vegetables/<?= $vege['image'] ?>" alt="" class=>
                            </div>

                            <div class="history-content-decs">
                                <p class="cake-name"><b><?= $vege['name'] ?></b></p>
                                <p class="cake-size">Khối lượng: <?= $vege['weight'] ?>g</p>
                                <p class="cake-price" style="color: var(--main-color)">Giá tiền: <?= number_format($vege["price"], 0, ',', '.') ?> VND</p>
                                <p class="cake-quantity">Số lượng: <?= $vege['amount'] ?></p>
                            </div>
                        </div>
                        <?php $total = $total + $vege['price'] * $vege['amount'] ?>
                    <?php endforeach; ?>

                    <div class="history-ending">
                        <div class="history-ending1">
                            <p class="history-ending-content">Tổng tiền: </p>
                            <p class="history-ending-content" style="color: var(--main-color)"><?= number_format($total, 0, ',', '.') ?> VND</p>
                        </div>
                        <div class="history-ending2">
                            <p class="history-ending-content">Trạng thái: </p>
                            <p class="history-ending-content" style="color: var(--main-color)">Đã giao</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</div>