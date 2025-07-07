<?php get_header();

$counter  = 1;
if (wp_is_mobile()) {
    $maxPosts = 5;
} else {
    $maxPosts = 7;
} ?>

<section class="archive-page__vacancy">
    <div class="container">
        <div class="vacancy__body">
            <h1 class="title-s">Работа у нас</h1>
            <div class="body__items">
                <?php $args = array(
                    'post_type' => 'vacancy',
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

                        get_template_part('parts/items/items', 'vacancy', $params);

                        $counter++;
                    }
                    wp_reset_postdata();
                } else { ?>
                    <div class="items__not">На данный момент вакансии отсутствуют</div>
                <?php } ?>
            </div>

            <?php $query = array(
                'post_type'      => 'vacancy',
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
                <a id="more-vacancy"
                   class="body__more"
                   data-current-page="1"
                   data-query='<?= json_encode( $posts->query_vars ); ?>'
                   data-max-pages="<?= $maxPages; ?>">
                    <div class="loader-inner"></div>
                </a>
            <?php } wp_reset_postdata(); ?>

            <div class="body__background">
                <?php get_template_part( 'parts/icons/vacancy', 'branch' ); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
