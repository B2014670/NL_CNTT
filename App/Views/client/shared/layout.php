<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frazzo Store</title>
    <link rel="shortcut icon" href="<?= URL_ICON ?>/iconFraazo.png">
    <link rel="stylesheet" href="<?= URL_FONT ?>/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= URL_BOOTSTRAP ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL_CSS ?>/base.css">
    <link rel="stylesheet" href="<?= URL_CSS ?>/reset.css">
    <link rel="stylesheet" type="text/css" href="<?= URL_PUBLIC ?>/slick/slick.css?v2022">
    <link rel="stylesheet" type="text/css" href="<?= URL_PUBLIC ?>/slick/slick-theme.css?v2022">
    <?php if ($GLOBALS['currentPage'] != "Accounts") : ?>
        <link rel="stylesheet" href="<?= URL_CSS ?>/header.css">
        <link rel="stylesheet" href="<?= URL_CSS ?>/footer.css">
        <link rel="stylesheet" href="<?= URL_CSS ?>/guarantee.css">
        <link rel="stylesheet" href="<?= URL_CSS ?>/home.css">
        <link rel="stylesheet" href="<?= URL_CSS ?>/about.css">
        <link rel="stylesheet" href="<?= URL_CSS ?>/profile.css">
        <link rel="stylesheet" href="<?= URL_CSS ?>/cart.css">
    <?php endif; ?>

    <?php if ($GLOBALS['currentPage'] == "Accounts") : ?>
        <link rel="stylesheet" href="<?= URL_CSS ?>/auth.css">
    <?php endif; ?>
    
</head>

<body>
    <!-- Hidden tag to use AJAX -->
    <p id="documentRootId" hidden><?= DOCUMENT_ROOT ?></p>

    <!-- Header -->
    <?php $GLOBALS['currentPage'] != "Accounts" ? require_once VIEW . "/client/shared/header.php" : "" ?>

    <!-- Content -->
    <?php require_once VIEW . "/client/" . $view . ".php" ?>

    <!-- Footer -->
    <?php $GLOBALS['currentPage'] != "Accounts" ? require_once VIEW . "/client/shared/footer.php" : "" ?>

    <!-- Toast messsage when adding vege to cart -->
    <div id="toast-yes">
        <div id="toast-yes-img" class="img"><i class="fas fa-thumbs-up"></i></div>
        <div id="toast-yes-desc">A notification message..</div>
    </div>

    <div id="toast-no">
        <div id="toast-no-img" class="img"><i class="fas fa-thumbs-down"></i></div>
        <div id="toast-no-desc">A notification message..</div>
    </div>

    <!-- JQuery -->
    <script src="<?= URL_JS ?>/jquery.js"></script>

    <!-- Javascript for Bootstrap -->
    <script src="<?= URL_BOOTSTRAP ?>/js/bootstrap.min.js"></script>

    <!-- TEST NAV -->
    <script src="<?= URL_BOOTSTRAP ?>/js/f205abf1eb.js"></script>
    <!-- END TEST NAV -->

    <!-- slick -->
    <script src="<?= URL_PUBLIC ?>/slick/slick.js?v2022" type="text/javascript" charset="utf-8"></script>

    <!-- JS menu bar -->
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop()) {
                    $('header').addClass('sticky ');
                } else {
                    $('header').removeClass('sticky ');
                }
            });
            $('.responsive').slick({
                dots: false,
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1281,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1023,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,

                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });


        });
    </script>
    <script src="<?= URL_JS ?>/cart.js"></script>
    <script src="<?= URL_JS ?>/profile.js"></script>
    <script src="<?= URL_JS ?>/validator.js"></script>
    <script src="<?= URL_JS ?>/detail.js"></script>
</body>

</html>