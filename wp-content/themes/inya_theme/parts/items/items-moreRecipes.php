<?php $id = $args['id']; ?>

<a class="items__item moreRecipes-card" href="<?php echo get_permalink($id); ?>">
    <div class="item__image">
        <?php echo get_the_post_thumbnail($id); ?>
    </div>
    <div class="item__info">
        <p class="info__title"><?php echo get_the_title($id); ?></p>
        <div class="info__more">
            <div class="more__item">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 4.19995V8.99995L11.4 11.4" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p><?php the_field( 'recipe-time', $id ); ?></p>
            </div>
            <div class="more__item">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.3327 14V12.6667C11.3327 11.1939 10.1388 10 8.66602 10H3.33268C1.85992 10 0.666016 11.1939 0.666016 12.6667V14" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.00065 7.33333C7.47341 7.33333 8.66732 6.13943 8.66732 4.66667C8.66732 3.19391 7.47341 2 6.00065 2C4.52789 2 3.33398 3.19391 3.33398 4.66667C3.33398 6.13943 4.52789 7.33333 6.00065 7.33333Z" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.334 14V12.6667C15.3331 11.4514 14.5107 10.3905 13.334 10.0867" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.666 2.08667C11.846 2.38878 12.6712 3.452 12.6712 4.67C12.6712 5.88801 11.846 6.95122 10.666 7.25334" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <p><?php the_field( 'recipe-portions', $id ); ?></p>
            </div>
        </div>
    </div>
</a>