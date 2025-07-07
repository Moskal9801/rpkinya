<?php
/* Template name: Документация */
get_header();
?>

<section class="documents-page__documents">
    <div class="container">
        <div class="documents__body">
            <h1 class="title-s">Документация</h1>
            <div class="body__items">
                <?php if ( have_rows( 'documents' ) ) : ?>
                    <?php while ( have_rows( 'documents' ) ) : the_row(); ?>
                        <?php $file_url = get_sub_field('documents-item');
                        $attachment_id = attachment_url_to_postid($file_url);
                        $file_title = get_the_title($attachment_id); // Получаем заголовок файла
                        $file_size = filesize(get_attached_file($attachment_id)) / 1048576; // Размер файла в МБ
                        $file_type = wp_check_filetype($file_url)['ext']; // Получаем тип файла ?>

                        <div class="items__item">
                            <div class="item__name">
                                <p><?php echo $file_title; ?></p>
                                <span><?php echo $file_type; ?> (<?php echo number_format($file_size, 2); ?> Мб)</span>
                            </div>
                            <a class="item__control" href="<?php echo $file_url; ?>" target="_blank">
                                <p>Скачать</p>
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.9948 36.6668C29.1995 36.6668 36.6615 29.2049 36.6615 20.0002C36.6615 10.7954 29.1995 3.3335 19.9948 3.3335C10.79 3.3335 3.32812 10.7954 3.32812 20.0002C3.32812 29.2049 10.79 36.6668 19.9948 36.6668Z" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.5 24.167V26.667C12.5 27.5875 13.2462 28.3337 14.1667 28.3337H25.8333C26.7538 28.3337 27.5 27.5875 27.5 26.667V24.167" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6641 20L19.9974 23.3333L23.3307 20" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20 11.667V23.3337" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
