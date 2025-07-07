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

        /**
         * Находит все элементы, соответствующие селектору.
         * @param {string} selector - CSS селектор для поиска элементов
         * @returns {NodeList} - список найденных элементов
         */
        function findAll ( selector ) {
            return document.querySelectorAll( selector );
        }

        if ( find('.post-type-archive-news') ) { //СТРАНИЦА АРХИВА НОВОСТЕЙ
            //ПОДГРУЗКА ПОСТОВ ПРИ СКРОЛЛЕ
            function loadMoreNews () {
                let bottomOffset = 1500;

                let loadMore = jQuery( '#more-news' ), currentPage = loadMore.attr( 'data-current-page' );

                let data = {
                    'action':'load_more-news', 'query':loadMore.attr( "data-query" ), 'page':currentPage
                };

                if ( (jQuery( document ).scrollTop() > (jQuery( document ).height() - bottomOffset)) && !jQuery( 'body' ).hasClass( 'loading' ) && !loadMore.hasClass( 'hidden' ) ) {
                    jQuery.ajax( {
                        url:'/wp-admin/admin-ajax.php', data:data, type:'POST', beforeSend:function ( xhr ) {
                            jQuery( 'body' ).addClass( 'loading' );
                            loadMore.css( 'opacity', 1 );
                        }, success:function ( data ) {
                            if ( data ) {
                                loadMore.html( '<div class="loader-inner"></div>' );
                                loadMore.prev().append( data );

                                currentPage++;
                                loadMore.attr( 'data-current-page', currentPage.toString() );

                                if ( currentPage === parseInt( loadMore.attr( "data-max-pages" ) ) ) {
                                    loadMore.addClass( 'hidden' );
                                }
                                jQuery( 'body' ).removeClass( 'loading' );
                                loadMore.css( 'opacity', 0 );
                            } else {
                                loadMore.addClass( 'hidden' );
                                jQuery( 'body' ).removeClass( 'loading' );
                            }
                        },
                    } );
                }
            }

            //ВЫЗОВ ФУНКЦИИ ПОДГРУЗКИ ПОСТОВ ПРИ СКРОЛЛЕ
            window.addEventListener( 'scroll', function () {
                loadMoreNews();
            } );
        }

        if ( find('.post-type-archive-recipes') ) { //СТРАНИЦА АРХИВА РЕЦЕПТОВ
            //ПОДГРУЗКА ПОСТОВ ПРИ СКРОЛЛЕ
            function loadMoreRecipes () {
                let bottomOffset = 1500;

                let loadMore = jQuery( '#more-recipes' ), currentPage = loadMore.attr( 'data-current-page' );

                let data = {
                    'action':'load_more-recipes', 'query':loadMore.attr( "data-query" ), 'page':currentPage
                };

                if ( (jQuery( document ).scrollTop() > (jQuery( document ).height() - bottomOffset)) && !jQuery( 'body' ).hasClass( 'loading' ) && !loadMore.hasClass( 'hidden' ) ) {
                    jQuery.ajax( {
                        url:'/wp-admin/admin-ajax.php', data:data, type:'POST', beforeSend:function ( xhr ) {
                            jQuery( 'body' ).addClass( 'loading' );
                            loadMore.css( 'opacity', 1 );
                        }, success:function ( data ) {
                            if ( data ) {
                                loadMore.html( '<div class="loader-inner"></div>' );
                                loadMore.prev().append( data );

                                currentPage++;
                                loadMore.attr( 'data-current-page', currentPage.toString() );

                                if ( currentPage === parseInt( loadMore.attr( "data-max-pages" ) ) ) {
                                    loadMore.addClass( 'hidden' );
                                }
                                jQuery( 'body' ).removeClass( 'loading' );
                                loadMore.css( 'opacity', 0 );
                            } else {
                                loadMore.addClass( 'hidden' );
                                jQuery( 'body' ).removeClass( 'loading' );
                            }
                        },
                    } );
                }
            }

            //ВЫЗОВ ФУНКЦИИ ПОДГРУЗКИ ПОСТОВ ПРИ СКРОЛЛЕ
            window.addEventListener( 'scroll', function () {
                loadMoreRecipes();
            } );
        }

        if ( find('.post-type-archive-vacancy') ) { //СТРАНИЦА АРХИВА ВАКАНСИЙ
            //ПОДГРУЗКА ПОСТОВ ПРИ СКРОЛЛЕ
            function loadMoreVacancy () {
                let bottomOffset = 1500;

                let loadMore = jQuery( '#more-vacancy' ), currentPage = loadMore.attr( 'data-current-page' );

                let data = {
                    'action':'load_more-vacancy', 'query':loadMore.attr( "data-query" ), 'page':currentPage
                };

                if ( (jQuery( document ).scrollTop() > (jQuery( document ).height() - bottomOffset)) && !jQuery( 'body' ).hasClass( 'loading' ) && !loadMore.hasClass( 'hidden' ) ) {
                    jQuery.ajax( {
                        url:'/wp-admin/admin-ajax.php', data:data, type:'POST', beforeSend:function ( xhr ) {
                            jQuery( 'body' ).addClass( 'loading' );
                            loadMore.css( 'opacity', 1 );
                        }, success:function ( data ) {
                            if ( data ) {
                                loadMore.html( '<div class="loader-inner"></div>' );
                                loadMore.prev().append( data );

                                currentPage++;
                                loadMore.attr( 'data-current-page', currentPage.toString() );

                                if ( currentPage === parseInt( loadMore.attr( "data-max-pages" ) ) ) {
                                    loadMore.addClass( 'hidden' );
                                }

                                jQuery( 'body' ).removeClass( 'loading' );
                                loadMore.css( 'opacity', 0 );

                                //ПЕРЕВЫЗОВ ФУНКЦИИ ОТКРЫТИЯ ВАКАНСИИ
                                let allVacancy = findAll('.vacancy-card');

                                allVacancy.forEach(function (item) {
                                    item.querySelector('.more__button').removeEventListener('click', openVacancy);

                                    item.querySelector('.more__button').addEventListener('click', openVacancy);
                                });
                            } else {
                                loadMore.addClass( 'hidden' );
                                jQuery( 'body' ).removeClass( 'loading' );
                            }
                        },
                    } );
                }
            }

            //ВЫЗОВ ФУНКЦИИ ПОДГРУЗКИ ПОСТОВ ПРИ СКРОЛЛЕ
            window.addEventListener( 'scroll', function () {
                loadMoreVacancy();
            } );

            //ВЫЗОВ ФУНКЦИИ ОТКРЫТИЯ ВАКАНСИИ
            let allVacancy = findAll('.vacancy-card');

            allVacancy.forEach(function (item) {
                item.querySelector('.more__button').addEventListener('click', openVacancy)
            });

            //ФУНКЦИЯ ОТКРЫТИЯ ВАКАНСИЙ
            function openVacancy (e) {
                e.preventDefault();

                document.querySelector( 'body' ).classList.add( 'background' );

                const formData = new FormData();

                formData.append('action', 'openVacancy');
                formData.append('id', this.closest('.vacancy-card').getAttribute('data-id'));

                fetch('/wp-admin/admin-ajax.php', {
                    method:'POST',
                    body:formData,
                }).then((response) => {
                    if ( !response.ok ) {
                        alert( 'Ошибка запроса!' );
                    }

                    return response;
                }).then(async (result) => {
                    let element = await result.text();

                    find('.popup-vacancy .popup-vacancy__info').innerHTML = element;

                    document.querySelector( 'body' ).classList.remove( 'background' );

                    Fancybox.show([{
                        src: '#popup-vacancy',
                        type: 'inline',
                    }], {
                        on: {
                            ready: (fancybox) => {
                                // Добавляем хэш в адресную строку при открытии попапа
                                window.location.hash = this.closest('.vacancy-card').getAttribute('data-id');
                            },
                            close: (fancybox) => {
                                // Удаляем хэш из адресной строки при закрытии попапа
                                setTimeout(() => {
                                    const url = window.location.href.split('#')[0]; // Получаем URL без хэша
                                    window.history.pushState(null, '', url); // Обновляем адресную строку
                                }, 0);

                                let allInput = findAll('.input'),
                                    remove = find('.custom-file-remove'),
                                    privacy = find('.wpcf7-form-control-wrap[data-name="terms-of-use"] label'),
                                    accept = find('.privacy__accept');

                                if (!accept.disabled) {
                                    privacy.click();
                                }

                                allInput.forEach(function (input) {
                                    input.value = '';

                                    input.classList.remove('wpcf7-not-valid')
                                });

                                remove.click();
                            },
                        }
                    });
                });
            }
        }
    } );
})( jQuery );