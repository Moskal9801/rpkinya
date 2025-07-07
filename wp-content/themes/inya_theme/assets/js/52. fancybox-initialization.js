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

        //ВЫВОД ПОПАПА ОСТАВИТЬ ЗАЯВКУ
        Fancybox.bind("a[href='#popup-request']", {
            type: 'inline',
            src: '#popup-request',
            on: {
                close:() => {

                }
            }
        });

        Fancybox.bind('[data-fancybox="gallery"]', {

        });

        if (find('.default__body')) {
            let galleries = document.querySelectorAll('.wp-block-gallery');

            galleries.forEach(function(gallery, index) {
                let images = gallery.querySelectorAll('img');
                let galleryId = 'gallery-' + (index + 1);

                images.forEach(function(image) {
                    image.setAttribute('data-fancybox', galleryId);
                });

                Fancybox.bind(`[data-fancybox="${galleryId}"]`, {

                });
            });

            let swipers = document.querySelectorAll('.swiper-acf-block-default--wrap');

            swipers.forEach(function (swiper) {
                let swiperId = 'slider-' + swiper.querySelector('.swiper').id;

                Fancybox.bind(`[data-fancybox="${swiperId}"]`, {

                });
            });
        }
    } );
})( jQuery );