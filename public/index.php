<?php

include('./assets/function.php');
$func = new MyFunction('./assets/config.php');

$func->addStyle('/assets/css/style.min.css');

function is_page() {
    return empty($_GET['p']) === false;
}

$top_image = $func->getUrl() . '/assets/img/monster2408-blog-top.jpg';
if (is_page()) {
    $top_image = $func->getUrl() . '/assets/img/monster2408-blog-top.jpg';
}

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
                    <?php
                        if (is_page() === false) {
                            echo '<div class="recommend-title"><h2>おすすめ記事</h2></div>';
                            echo '<div class="recommend-area" id="recommend-area"></div>';
                        } else {
                            echo '<div class="recommend-title"><h2 id="post-title"></h2></div>';
                            echo '<div class="content" id="content-area"></div>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php include('./assets/include/footer.php'); ?>
        <?php
            if (is_page() === false) {
                echo '<script src="'.$func->getNoCacheUrl("/assets/js/feed-load.js").'"></script>';
            } else {
                echo '<script src="'.$func->getNoCacheUrl("/assets/js/post-load.js").'"></script>';
            }
        ?>
    </body>
</html>