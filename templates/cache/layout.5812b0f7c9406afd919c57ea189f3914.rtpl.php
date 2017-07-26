<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html>
<?php echo $head;?>

<body class="<?php echo $bodyclass;?>">
<header>
    <section id="main-bar">
        <a id="logo-area" href="<?php echo $home_url;?>">
            <img src="<?php echo $logo;?>" alt="" />
        </a>
        <div id="main-title"><span><?php echo $main_title;?></span></div>
        <a href="javascript://" id="menu-trigger">
            <span class="icon"></span>
        </a>
    </section>
    <section id="nav-bar">
        <div class="navigations">
            <?php echo $primary_navigation;?>

            <?php echo $secondary_navigation;?>

            <?php echo $lang_selection;?>

        </div>
    </section>
    <div id="nav-overlay"></div>
</header>
<div id="top-fadeout"></div>
<div class="content">
    <?php echo $body;?>

</div>
</body>
<footer>
    <div>
        <div class="copyright"><?php echo $footer_copyright;?></div>
    </div>
    <div>
        <div class="navigation"><?php echo $footer_navigation;?></div>
        <div class="webdesign"><?php echo $footer_webdesign;?></div>
    </div>
</footer>

</html>
