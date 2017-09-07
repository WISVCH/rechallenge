<?php $with_photo = has_post_thumbnail() ? 'has-photo' : false; ?>
<div class="row roster-page <?=$with_photo ?? ''?>">

    <?php if ($with_photo) { ?>

        <div class="large-5 column">
            <?php the_post_thumbnail('full'); ?>
        </div>

        <div class="large-7 column">
            <?php the_title('<h1>', '</h1>'); ?>
            <?php the_content(); ?>
        </div>

    <?php } else { ?>

        <div class="column">
            <?php
            the_title('<h1>', '</h1>');
            the_content();
            ?>
        </div>

    <?php } ?>

</div>
