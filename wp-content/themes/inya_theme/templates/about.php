<?php
/* Template name: О компании */
get_header();
?>

<section class="about-page__main-info">
    <div class="container">
        <div class="main-info__body">
            <h1 class="title-s">О компании</h1>
            <?php if (get_field( 'contacts-missons' )) { ?>
                <p class="body__mission"><?php the_field( 'contacts-missons' ); ?></p>
            <?php } ?>
            <div class="body__contacts">
                <div class="contacts__contact">
                    <p class="contact__title">Контактная <br>информация:</p>
                    <?php if (get_field( 'contacts-address' )) { ?>
                        <div class="contact__item">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#72BDBE"/>
                                <path d="M33.5714 22.2143C33.5714 19.9978 32.6909 17.8722 31.1237 16.3049C29.5564 14.7376 27.4307 13.8571 25.2143 13.8571C22.9978 13.8571 20.8722 14.7376 19.3049 16.3049C17.7376 17.8722 16.8571 19.9978 16.8571 22.2143C16.8571 25.6426 19.6001 30.1109 25.2143 35.4631C30.8284 30.1109 33.5714 25.6426 33.5714 22.2143ZM25.2143 38C18.4041 31.8101 15 26.547 15 22.2143C15 19.5053 16.0761 16.9072 17.9917 14.9917C19.9072 13.0761 22.5053 12 25.2143 12C27.9233 12 30.5213 13.0761 32.4369 14.9917C34.3524 16.9072 35.4286 19.5053 35.4286 22.2143C35.4286 26.547 32.0244 31.8101 25.2143 38Z" fill="#FFFFFC"/>
                                <path d="M25.2132 24.9994C25.952 24.9994 26.6605 24.7059 27.183 24.1835C27.7054 23.661 27.9989 22.9525 27.9989 22.2137C27.9989 21.4748 27.7054 20.7663 27.183 20.2439C26.6605 19.7214 25.952 19.4279 25.2132 19.4279C24.4744 19.4279 23.7658 19.7214 23.2434 20.2439C22.7209 20.7663 22.4275 21.4748 22.4275 22.2137C22.4275 22.9525 22.7209 23.661 23.2434 24.1835C23.7658 24.7059 24.4744 24.9994 25.2132 24.9994ZM25.2132 26.8565C23.9818 26.8565 22.8009 26.3674 21.9302 25.4967C21.0595 24.6259 20.5703 23.445 20.5703 22.2137C20.5703 20.9823 21.0595 19.8014 21.9302 18.9307C22.8009 18.06 23.9818 17.5708 25.2132 17.5708C26.4445 17.5708 27.6255 18.06 28.4962 18.9307C29.3669 19.8014 29.856 20.9823 29.856 22.2137C29.856 23.445 29.3669 24.6259 28.4962 25.4967C27.6255 26.3674 26.4445 26.8565 25.2132 26.8565Z" fill="#FFFFFC"/>
                            </svg>
                            <p><?php the_field( 'contacts-address' ); ?></p>
                        </div>
                    <?php } ?>
                    <?php if (get_field( 'contacts-firstPhone' ) || get_field( 'contacts-secondPhone' )) { ?>
                        <div class="contact__item">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#72BDBE"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.503 15.9286C19.1147 15.043 18.6833 15.0215 18.3164 15.0215C17.9925 15 17.6459 15 17.2791 15C16.935 15 16.3518 15.129 15.8559 15.6692C15.3587 16.2081 14 17.482 14 20.0931C14 22.7056 15.8989 25.2306 16.1582 25.576C16.4163 25.9213 19.8269 31.4458 25.2236 33.5837C29.712 35.3536 30.6192 35.0082 31.5906 34.8994C32.561 34.7919 34.7205 33.6268 35.1733 32.3744C35.6048 31.1448 35.6048 30.0657 35.4757 29.8492C35.3466 29.6342 34.9785 29.5038 34.4612 29.2231C33.921 28.9649 31.3313 27.6695 30.8354 27.4963C30.3383 27.3242 29.9929 27.2381 29.6475 27.7556C29.3022 28.2958 28.2875 29.4824 27.9651 29.8278C27.6614 30.1731 27.3388 30.2162 26.8202 29.9569C26.2813 29.6987 24.5759 29.1371 22.5468 27.3242C20.9705 25.92 19.9129 24.1729 19.589 23.6556C19.288 23.1154 19.546 22.8345 19.8269 22.5752C20.0647 22.3386 20.3671 21.9502 20.6264 21.6479C20.8844 21.3443 20.9705 21.1077 21.1653 20.7623C21.3375 20.417 21.2514 20.0931 21.1223 19.8351C20.9921 19.5972 19.9787 16.9861 19.503 15.9286Z" stroke="#FFFFFC" stroke-width="1.65346" stroke-linejoin="round"/>
                            </svg>
                            <div class="item__column">
                                <?php if (get_field( 'contacts-secondPhone' )) { ?>
                                    <a href="tel:<?php echo clearPhone(get_field( 'contacts-firstPhone' )); ?>"><?php the_field( 'contacts-firstPhone' ); ?><?php if (get_field( 'contacts-secondPhone' )) { ?><span>,</span><?php } ?></a>
                                <?php } ?>
                                <?php if (get_field( 'contacts-secondPhone' )) { ?>
                                    <a href="tel:<?php echo clearPhone(get_field( 'contacts-secondPhone' )) ?>"><?php the_field( 'contacts-secondPhone' ); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (get_field( 'contacts-mail' )) { ?>
                        <div class="contact__item">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#72BDBE"/>
                                <g clip-path="url(#clip0_678_14301)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M35 34H15C14.4696 34 13.9609 33.7893 13.5858 33.4142C13.2107 33.0391 13 32.5304 13 32V18C13 17.4696 13.2107 16.9609 13.5858 16.5858C13.9609 16.2107 14.4696 16 15 16H35C35.5304 16 36.0391 16.2107 36.4142 16.5858C36.7893 16.9609 37 17.4696 37 18V32C37 32.5304 36.7893 33.0391 36.4142 33.4142C36.0391 33.7893 35.5304 34 35 34ZM18.39 18L25 24.609L31.61 18H18.39ZM35 18H34.39L25.79 26.6C25.7677 26.6409 25.7408 26.6791 25.71 26.714C25.5188 26.8969 25.2645 26.999 25 26.999C24.7355 26.999 24.4812 26.8969 24.29 26.714C24.2592 26.6791 24.2323 26.6409 24.21 26.6L15.61 18H15V32H35V18Z" fill="#FFFFFC"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_678_14301">
                                        <rect width="24" height="24" fill="white" transform="translate(13 13)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <a href="mailto:<?php the_field( 'contacts-mail' ); ?>"><?php the_field( 'contacts-mail' ); ?></a>
                        </div>
                    <?php } ?>
                    <?php if (get_field( 'contacts-mailAddress' )) { ?>
                        <div class="contact__item">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="25" cy="25" r="25" fill="#72BDBE"/>
                                <g clip-path="url(#clip0_678_14307)">
                                    <path d="M37.259 20.9124L37.4863 20.7337H37.1972H25.9125H25.6234L25.8507 20.9124L31.4931 25.3458L31.5548 25.3944L31.6166 25.3458L37.259 20.9124ZM38.1258 29.2667H38.2258V29.1667V22.4889V22.2831L38.064 22.4103L31.5548 27.525L25.0462 22.4103L24.8844 22.2831V22.4889V29.1667V29.2667H24.9844H38.1258ZM24.5733 19.0587H38.5369C39.2869 19.0587 39.9008 19.6824 39.9008 20.4522V29.5478C39.9008 30.3176 39.2869 30.9412 38.5369 30.9412H24.5733C23.8232 30.9412 23.2094 30.3181 23.2094 29.5478V20.4522C23.2094 19.6824 23.8232 19.0587 24.5733 19.0587Z" fill="#FFFFFC" stroke="#72BDBE" stroke-width="0.2"/>
                                    <path d="M10.1 21.744V20.069H20.1933V21.744H10.1Z" fill="#FFFFFC" stroke="#72BDBE" stroke-width="0.2"/>
                                    <path d="M12.8852 25.648V23.973H20.1945V25.648H12.8852Z" fill="#FFFFFC" stroke="#72BDBE" stroke-width="0.2"/>
                                    <path d="M15.7016 30.0648V28.3898H20.1937V30.0648H15.7016Z" fill="#FFFFFC" stroke="#72BDBE" stroke-width="0.2"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_678_14307">
                                        <rect width="30" height="30" fill="white" transform="translate(10 10)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <p><?php the_field( 'contacts-mailAddress' ); ?></p>
                        </div>
                    <?php } ?>
                </div>
                <?php if (get_field( 'contacts-image' )) { ?>
                    <div class="contacts__image">
                        <img src="<?php the_field( 'contacts-image' ); ?>">
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<section class="about-page__more-info">
    <div class="container">
        <div class="more-info__body">
            <div class="body__title">
                <?php if (get_field( 'text-left' )) { ?>
                    <p class="title__mobile-text"><?php the_field( 'text-left' ); ?></p>
                <?php } ?>
                <div class="title__title">
                    <h2><span>С самого начала нашей работы,</span> мы специализируемся на рыбной продукции глубокой переработки</h2>
                    <?php get_template_part('parts/icons/about', 'fish'); ?>
                </div>
            </div>
            <div class="body__main-text">
                <?php if (get_field( 'text-left' )) { ?>
                    <p class="main-text__left"><?php the_field( 'text-left' ); ?></p>
                <?php } ?>
                <?php if (get_field( 'text-right' )) { ?>
                    <p class="main-text__right"><?php the_field( 'text-right' ); ?></p>
                <?php } ?>
            </div>
            <?php if (get_field( 'text-video' )) { ?>
                <?php $iframe = get_field( 'text-video' ); preg_match('/src="(.+?)"/', $iframe, $matches); $srcVideo = $matches[1]; ?>

                <div class="body__video video-block" data-video="<?php echo $srcVideo; ?>">
                    <div class="video__poster video-block__poster video-block__part">
                        <img src="<?php the_field( 'text-poster' ); ?>">
                    </div>
                    <div class="video__play video-block__play video-block__part">
                        <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="32.5" cy="32.5" r="32.5" fill="#F6F6F6"/>
                            <path d="M47 32.5L26 47.2224L26 17.7776L47 32.5Z" fill="#6E5D65"/>
                        </svg>
                    </div>
                </div>
            <?php } ?>
            <div class="body__more-text">
                <?php get_template_part('parts/icons/about', 'branch'); ?>

                <?php if (get_field( 'text-after' )) { ?>
                    <p><?php the_field( 'text-after' ); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
