(function ( $ ) {
    document.addEventListener( 'DOMContentLoaded', function () {
        /**
         * Находит первый элемент, соответствующий селектору.
         * @param {string} selector - CSS селектор для поиска элемента
         * @returns {Element} - первый найденный элемент
         */
        function find ( selector ) {
            return document.querySelector( selector );
        }

        if (find('.swiper-galleryMain') && find('.swiper-galleryMore')) {
            let galleryMore = new Swiper(".swiper-galleryMore", {
                spaceBetween: 20,
                slidesPerView: 'auto',
                freeMode: true,
                watchSlidesProgress: true,
            });
            let galleryMain = new Swiper(".swiper-galleryMain", {
                slidesPerView: 1,
                allowTouchMove: true,
                loop: true,
                pagination: {
                    el: ".pagination-gallery.swiper-pagination",
                    clickable: true,
                },
                thumbs: {
                    swiper: galleryMore,
                },
            });
        }

        if ( find('.swiper-news') ) {
            let news = new Swiper(".swiper-news", {
                slidesPerView: 'auto',
                spaceBetween: 10,
                navigation: {
                    nextEl: '.navigation-news.navigation__next',
                    prevEl: '.navigation-news.navigation__prev',
                },
                breakpoints: {
                    1025: {
                        slidesPerView: 3,
                        spaceBetween: 20
                    },
                }
            });
        }

        if ( find('.swiper-popular') ) {
            let popular = new Swiper(".swiper-popular", {
                slidesPerView: 'auto',
                spaceBetween: 10,
                navigation: {
                    nextEl: '.navigation-popular.navigation__next',
                    prevEl: '.navigation-popular.navigation__prev',
                },
                breakpoints: {
                    1025: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    },
                }
            });
        }
    } );
})( jQuery );