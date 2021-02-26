<?php
/**
 * Block Name: Profile
 * Category: layout
 *
 * @var array $block
 */

$slug     = str_replace( 'acf/', '', $block['name'] );
$block_id = $slug . '-' . $block['id'];

$bg_color      = get_field( "profile_background_color" );
$section_style = '';
if ( $bg_color ) {
    $section_style .= "background-color:" . $bg_color;
}
?>


<section class="profile" style="<?= $section_style; ?>">
    <div class="profile__content">
        
        <div class="profile__ava">
            <?php $avatar = get_field( "user_avatar" );
                if ( $avatar ) :?>
                    <?php echo $avatar; ?>
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/ava.png" alt="ava">
            <?php endif; ?>
        </div>

        <?php 
            $name = get_field( "user_name" );
            if ( $name ) :?>
                <div class="profile__name"><?php echo $name; ?></div>
        <?php endif; ?>
        <?php
            $city = get_field( "user_city" );
            if ( $city ) :?>
                <a href="#" class="profile__city"><?php echo $city; ?></a>
        <?php endif; ?>
        <?php
            $follow = get_field( "follow" );
            if ( $follow ) :?>
                <a href="#" class="profile__follow"><?php echo $follow; ?></a>
        <?php endif; ?>
    </div>

    <div class="profile__data">
        <div class="profile__info">
            <?php 
                $followers = get_field( "followers" );
                    if ( $followers ) :?>
                    <p class="profile__followers"><?php echo $followers; ?>
                    <?php else: ?>0
                </p>
            <?php endif; ?>
            <p class="profile__text">Followers</p>
        </div>
        <div class="profile__info">
            <?php
                $photos = get_field( "photos" );
                if ( $photos ) :?>
                    <p class="profile__photos"><?php echo $photos; ?>
                    <?php else: ?>0</p>
            <?php endif; ?>
            <p class="profile__text">Photos</p>
        </div>
        <div class="profile__info">
            <?php
                $like = get_field( "like" );
                if ( $like ) :?>
                    <p class="profile__like"><?php echo $like; ?>
                        <?php else: ?>0
                    </p>
            <?php endif; ?> 
            <p class="profile__text">Like</p>
        </div>
    </div>
</section>
