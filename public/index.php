<?php

include('./assets/function.php');
$func = new MyFunction('./assets/config.php');

$func->addStyle('/assets/css/style.min.css');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="<?php echo $func->getLanguageCode(); ?>">
    <head>
        <?php $func->printMetaData(); ?>
    </head>
    <body>
        <?php include('./assets/include/header.php'); ?>
        <div class="contents">
            <div class="body p-1">
                <div class="top-inner">
                    <img src="<?php echo $func->getUrl(); ?>/assets/img/monster2408-blog-top.jpg" alt="">
                </div>
                <div class="inner">
                    <div class="recommend-title"><h2>おすすめ記事</h2></div>
                    <div class="recommend-area" id="recommend-area"></div>
                </div>
            </div>
        </div>
        <?php include('./assets/include/footer.php'); ?>
        <script src="<?php echo $func->getNoCacheUrl("/assets/js/feed-load.js"); ?>"></script>
    </body>
</html>