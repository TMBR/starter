<?php

$images = get_sub_field('image_gallery');

if( $images ): ?>

<div class="flex-img-gallery">
    <ul>
        <?php foreach( $images as $image ): ?>
            <li class="image-wrap">
                <a class="js-flex-gallery-img" href="<?php echo $image['sizes']['full_screen']; ?>">
                    <img class="img" src="<?php echo $image['sizes']['lg_thumb']; ?>" alt="<?php echo $image['alt']; ?>" />

                    <div class="overlay">
                        <p><?php echo $image['caption']; ?></p>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>