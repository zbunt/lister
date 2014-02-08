<div class="item_holder" >
    <div class="item_title">
        <a href="<?php echo $link; ?>">
            <?php echo $post->name; ?>
        </a>
    </div>
    <div class="item_item" id="item_<?PHP echo $post->id; ?>" <?PHP echo $on_click; ?>>
        <?php echo $picture; ?>
    </div>
    <div class="item_text">
        <?php echo $post->text; ?>
    </div>
    <div class="item_social">
        <div class="item_user">
            <img src="<?php echo $user_avatar; ?>"/>
            <div class="item_user_inner">
                <div class="item_user_name">
                    <?php echo $user_name; ?>
                </div>
                <br/>
                <div class="item_user_days_ago">
                    <?php echo $user_days_ago; ?>
                </div>
            </div>
        </div>
        <div class="item_social_separator"></div>
        <div id="likeid_<?php echo $post->id; ?>" class="item_likes" <?PHP echo $on_click_likes; ?>>
            <?php echo $likes; ?>
        </div>
        <div class="item_comments" <?PHP echo $on_click_comments; ?>>
            <?php echo $comments; ?>
        </div>
        <div class="item_social_separator"></div>
        <div class="item_social_inner">
            <div class="item_social_fb"><?php echo $fb_link; ?></div>
            <div class="item_social_twitter"><?php echo $tw_link; ?></div>
            <div class="item_social_gpl"><?php echo $gpl_link; ?></div>
            <div class="item_social_email"></div>
        </div>
    </div>
</div>