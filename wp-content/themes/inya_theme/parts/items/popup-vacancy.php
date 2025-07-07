<?php $id = $args['id']; ?>

<svg data-fancybox-close data-src="#popup-vacancy" class="popup__close" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M21 21L1 1.00005M1 21L21 1" stroke="#2D2D2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<p class="info__name"><?php echo get_the_title($id); ?></p>

<?php if (get_field( 'vacancy-salary', $id )) { ?>
    <p class="info__salary"><?php the_field( 'vacancy-salary', $id ); ?></p>
<?php } ?>

<?php if ( get_field( 'vacancy-duties' ) ) : ?>
    <div class="info__detail">
        <p class="detail__title">Обязанности:</p>
        <div class="detail__items">
            <?php the_field( 'vacancy-duties' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( get_field( 'vacancy-requirements' ) ) : ?>
    <div class="info__detail">
        <p class="detail__title">Требования:</p>
        <div class="detail__items">
            <?php the_field( 'vacancy-requirements' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( get_field( 'vacancy-conditions' ) ) : ?>
    <div class="info__detail">
        <p class="detail__title">Условия:</p>
        <div class="detail__items">
            <?php the_field( 'vacancy-conditions' ); ?>
        </div>
    </div>
<?php endif; ?>

<p class="info__more">Для отклика на вакансию заполните форму ниже:</p>

