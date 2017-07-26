<?php if(!class_exists('raintpl')){exit;}?><div class="big-teaser <?php echo $layout_type;?>">
    <section class="text-block">
        <h2><?php echo $title;?></h2>
        <?php if( $lead ){ ?><p class="lead"><?php echo $lead;?></p><?php } ?>

        <?php if( $text ){ ?><?php echo $text;?><?php } ?>

        <?php if( $btn_text_one ){ ?><a class="btn btn-primary" href="<?php echo $btn_url_one;?>"><?php echo $btn_text_one;?></a><?php } ?>

        <?php if( $btn_text_two ){ ?><a class="btn btn-discreet" href="<?php echo $btn_url_two;?>"><?php echo $btn_text_two;?></a><?php } ?>

    </section>
    <div class="image_one" style="background-image:url(<?php echo $image_one;?>);"></div>
    <div class="image_two" style="background-image:url(<?php echo $image_two;?>);"></div>
</div>