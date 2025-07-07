<?php $id = $args['id']; ?>

<a class="swiper-slide items__item news-card" href="<?php echo get_permalink($id); ?>">
    <?php if ( get_field( 'stock', $id) == 1 ) : ?>
        <div class="item__tag">Акция</div>
    <?php endif; ?>

    <div class="item__image">
        <?php echo get_the_post_thumbnail($id); ?>
    </div>
    <div class="item__info">
        <p class="info__title"><?php echo get_the_title($id); ?></p>
        <p class="info__description"><?php the_field( 'description', $id ); ?></p>
        <p class="info__date"><?php echo get_the_time('d.m.Y', $id); ?></p>
    </div>
</a>