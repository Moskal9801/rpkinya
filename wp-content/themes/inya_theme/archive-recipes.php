<?php get_header();

$counter  = 1;
if (wp_is_mobile()) {
    $maxPosts = 6;
} else {
    $maxPosts = 9;
} ?>

<section class="archive-page__recipes">
    <div class="container">
        <div class="recipes__body">
            <h1 class="title-s">Рецепты</h1>
            <div class="body__items">
                <?php $args = array(
                    'post_type' => 'recipes',
                    'post_status' => 'publish',
                    'order'       => 'DESC',
                    'posts_per_page' => $maxPosts,
                );
                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ($query->have_posts() && (($counter % $maxPosts) !== 0)) {
                        $query->the_post();

                        $params = [
                            'id' => get_the_ID(),
                        ];

                        get_template_part('parts/items/items', 'mainRecipes', $params);

                        $counter++;
                    }
                    wp_reset_postdata();
                } else { ?>
                    <div class="items__not">На данный момент рецепты отсутствуют</div>
                <?php } ?>
            </div>

            <?php $query = array(
                'post_type'      => 'recipes',
                'post_status'    => 'publish',
                'post_per_page' => $maxPosts,
            );
            $posts = new WP_Query( $query );

            $allPostsCounter = 0;
            while ( $posts->have_posts() ) {
                $posts->the_post();
                $allPostsCounter ++;
            }

            $maxPosts --;
            $maxPages = ceil( $allPostsCounter / $maxPosts );

            if ( $maxPages > 1 ) { ?>
                <a id="more-recipes"
                   class="body__more"
                   data-current-page="1"
                   data-query='<?= json_encode( $posts->query_vars ); ?>'
                   data-max-pages="<?= $maxPages; ?>">
                    <div class="loader-inner"></div>
                </a>
            <?php } wp_reset_postdata(); ?>

            <div class="body__background">
                <?php get_template_part( 'parts/icons/recipes', 'pepper' ); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

