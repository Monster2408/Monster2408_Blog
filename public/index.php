<?php

include('./assets/function.php');
$func = new MyFunction('./assets/config.php', "トップページ");

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
            <div class="about-area">
            </div>
            <div class="p-1">
                <div class="title"><h2 lang="ja">アクセス解析中</h2><h2 lang="en">Access analysis underway</h2></div>
                <div class="body">
                    <div class="inner">
                        <div class="system-area count-area">
                            <p lang="ja">総アクセス数：<?php echo $viewCountAll; ?></p>
                            <p lang="en">Total number of accesses: <?php echo $viewCountAll; ?></p>
                            <p lang="ja">今日のアクセス数：<?php echo $viewCountToday; ?></p>
                            <p lang="en">Today's access: <?php echo $viewCountToday; ?></p>
                            <p lang="ja">昨日のアクセス数：<?php echo $viewCountYesterday; ?></p>
                            <p lang="en">Yesterday's access: <?php echo $viewCountYesterday; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <?php include('./assets/include/footer.php'); ?> -->
    </body>
</html>