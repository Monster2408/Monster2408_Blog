<?php
    $FULL_URI = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $FILE_NAME = basename($FULL_URI); 

    include_once($func->getAssetsPath().'/assets/view_counter.php');
    $viewCounter = new ViewCounter($func->getAssetsPath().'/assets/data/db/');
    
    $viewCounterData = $viewCounter->getCounterData();
    $viewCountAll = $viewCounterData["all_count"];
    $viewCountToday = $viewCounterData["today_count"];
    $viewCountYesterday = $viewCounterData["yesterday_count"];
?>
<header>
    <?php if ($func->getDiscordLib()->isLogin()): ?>
    <div class="admin-menu">
        <a href="./create.php">新規作成</a> | 
        <a href="./edit.php">編集</a>
    </div>
    <?php endif; ?>
    <div class="menu-btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="logo">
        <?php echo $func->getTitle(); ?>
    </div>
    <div class="nav">
        <ul>
            <li><a href="/blog/">Home</a></li>
            <li><a href="/blog/about/">About</a></li>
            <li><a href="/blog/contact/">Contact</a></li>
        </ul>
    </div>
</header>