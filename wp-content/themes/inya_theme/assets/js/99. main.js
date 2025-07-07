(function ( $ ) {
    document.addEventListener( 'DOMContentLoaded', function () {
        let scrollWidth;

        function getScrollbarWidth() {
            // Создаем временный элемент для измерения ширины
            const div = document.createElement('div');
            div.style.overflowY = 'scroll';
            div.style.width = '50px';
            div.style.height = '50px';

            document.body.appendChild(div);
            scrollWidth = div.offsetWidth - div.clientWidth;
            document.body.removeChild(div);
        }

        getScrollbarWidth();

        /**
         * Определяет, используется ли мобильное устройство.
         * @returns {boolean} - возвращает true, если ширина окна браузера меньше или равна 768px
         */
        function isMobile () {
            return window.outerWidth <= 1024;
        }

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

        if (find('.main-header')) { //ЛОГИКА РАБОТЫ ХЭДЕРА
            let header = document.querySelector('.main-header'),
                menu = document.querySelector('.main-menu'),
                background = document.querySelector('.main-background'),
                openMenu = document.querySelectorAll('.controlling__hamburger');

            openMenu.forEach(function (open) {
               open.onclick = function (e) {
                   e.preventDefault();

                   document.documentElement.classList.toggle('no-scroll');

                   if (document.documentElement.classList.contains('no-scroll')) {
                       document.documentElement.style.marginRight = scrollWidth + 'px';
                       header.style.right = scrollWidth + 'px';
                   } else {
                       document.documentElement.style.removeProperty('margin-right');
                       header.style.removeProperty('right');
                   }

                   let openIcon = document.querySelectorAll('.hamburger__icon');

                   openIcon.forEach(function (iconItem) {
                       iconItem.classList.toggle('active');
                   });

                   menu.classList.toggle('open');

                   background.classList.toggle('open');
               };
            });

            background.onclick = function (e) {
                e.preventDefault();

                document.documentElement.classList.toggle('no-scroll');

                if (document.documentElement.classList.contains('no-scroll')) {
                    document.documentElement.style.marginRight = scrollWidth + 'px';
                    header.style.right = scrollWidth + 'px';
                } else {
                    document.documentElement.style.removeProperty('margin-right');
                    header.style.removeProperty('right');
                }

                let openIcon = document.querySelectorAll('.hamburger__icon');

                openIcon.forEach(function (iconItem) {
                    iconItem.classList.toggle('active');
                });

                menu.classList.toggle('open');

                background.classList.toggle('open');
            };

            //ПОВЕДЕНИЕ ХЭДЕРА ПРИ СКРОЛЛЕ
            let prevScrollpos = window.scrollY;

            window.addEventListener('scroll', function () {
                let currentScrollPos = window.scrollY;

                if (window.scrollY <= 1) {
                    header.classList.remove('scroll-background')
                } else if (prevScrollpos > currentScrollPos) {
                    header.classList.add('scroll-background')
                } else {
                    header.classList.add('scroll-background')
                }
                prevScrollpos = currentScrollPos;
            });
        }

        if (find('.widget')) {
            let widgetMain = find('.widget__main');

            widgetMain.onclick = function (e) {
                e.preventDefault();

                widgetMain.closest('.widget').classList.toggle('active');
            }
        }

        if (find('.home-page__popular')) {
            let background = find('.home-page__popular .popular__background'),
                title = find('.home-page__popular .body__title'),
                products = find('.home-page__popular .popular__items');

            background.style.top = title.getBoundingClientRect().height + (products.getBoundingClientRect().height / 2) + 'px';
        }

        if (find('.video-block')) {
            let playButton = document.querySelector('.video-block__play');
            let posterParts = document.querySelectorAll('.video-block__part');

            playButton.addEventListener('click', (e) => {
                let videoUrl = e.target.closest('.video-block').getAttribute('data-video');
                let videoLayout = `<iframe width="100%" height="600" src="${videoUrl}" frameborder="0" allowfullscreen></iframe>`;
                e.target.closest('.video-block').insertAdjacentHTML('afterBegin', videoLayout);
                posterParts.forEach(part => {
                    part.remove();
                });
            });
        }

        if (find('.single-recipes')) { //ВНУТРЕННЯЯ СТРАНИЦА РЕЦЕПТОВ
            if (!isMobile()) {
                let title = find('.body__info h4'),
                    time = find('.body__info .info__time'),
                    description = find('.body__info .info__description'),
                    background = find('.body__background');

                background.style.top = title.getBoundingClientRect().height + time.getBoundingClientRect().height + description.getBoundingClientRect().height + 50 + 'px';
            }

            //РАСКРЫТИЕ И СКРЫТИЕ РЕЦЕПТА
            let stepValue = find('.info__step .step__value'),
                stepValueHeight = stepValue.getBoundingClientRect().height,
                stepButton = find('.info__step .step__button');

            if (stepValueHeight <= 300) {
                stepButton.style.display = 'none';
            } else {
                let stepActive = false

                stepValue.style.maxHeight = (stepValueHeight / 3) + 'px';
                stepButton.classList.add('active');
                stepActive = false;

                stepButton.addEventListener( 'click', function (e) {
                    e.preventDefault();

                    if (stepActive == false) {
                        stepValue.style.maxHeight = stepValueHeight + 'px';
                        stepButton.querySelector('p').textContent = 'Свернуть';
                        stepButton.classList.remove('active');
                        stepActive = true;
                    } else {
                        stepValue.style.maxHeight = (stepValueHeight / 3) + 'px';
                        stepButton.querySelector('p').textContent = 'Развернуть';
                        stepButton.classList.add('active');
                        stepActive = false;
                    }
                });
            }
        }

        if (document.querySelector('#api-map')) {
            //ЯНДЕКС КАРТЫ
            ymaps.ready(init);
            function init() {
                let myMap;

                if (isMobile()) {
                    myMap = new ymaps.Map('map', {
                        center: [48.4227, 135.084],
                        zoom: 10,
                        minZoom: 10,
                        maxZoom: 12
                    });
                } else {
                    myMap = new ymaps.Map('map', {
                        center: [48.4727, 135.034],
                        zoom: 11,
                        minZoom: 10,
                        maxZoom: 12
                    });
                }

                let objectManager = new ymaps.ObjectManager({
                        clusterize: true,
                        gridSize: 32,
                        synchroOverlays: false
                    });

                myMap.behaviors.disable('scrollZoom');
                myMap.geoObjects.add(objectManager);
                objectManager.objects.options.set('preset', 'islands#blueCircleDotIcon');
                objectManager.objects.options.set('synchroOverlays', false);
                objectManager.clusters.options.set('synchroOverlays', false);
                myMap.geoObjects.add(objectManager);
                objectManager.add({
                    "type": "FeatureCollection",
                    "features": [
                        {
                            "type": "Feature",
                            "id": 1,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.554888, 135.048579]
                            },
                        }, {
                            "type": "Feature",
                            "id": 2,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.438286, 135.106134]
                            },
                        }, {
                            "type": "Feature",
                            "id": 3,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.486351, 135.091707]
                            },
                        }, {
                            "type": "Feature",
                            "id": 4,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.485801, 135.067614]
                            },
                        }, {
                            "type": "Feature",
                            "id": 5,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.431375, 135.110805]
                            },
                        }, {
                            "type": "Feature",
                            "id": 6,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.497731, 135.099118]
                            },
                        }, {
                            "type": "Feature",
                            "id": 7,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.530301, 135.090341]
                            },
                        }, {
                            "type": "Feature",
                            "id": 8,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.394118, 135.104400]
                            },
                        }, {
                            "type": "Feature",
                            "id": 9,
                            "geometry": {
                                "type": "Point",
                                "coordinates": [48.453363, 135.112722]
                            },
                        }
                    ]
                });
                /* 2. Обработка списка и меток */
                //Клик по метке в карте
                objectManager.objects.events.add('click', function (e) {
                    var objectId = e.get('objectId');
                    viewObject(objectId);
                });
                //Клик в списке
                [].forEach.call(document.querySelectorAll('[data-objectId]'), function (el) {
                    el.addEventListener('click', function () {
                        var objectId = el.getAttribute("data-objectId");
                        viewObject(objectId);
                    });
                });

                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var objectId = urlParams.get('objectId');

                if (objectId === '1') {
                    viewObject(1);
                }

                // Что происходит при выборе метки или варианта из списка
                function viewObject(objectId) {
                    // Удаляем со всего списка класс active затем добавляем к выбранному
                    for (var object of document.querySelectorAll('[data-objectId]')) {
                        object.classList.remove('active');
                    }
                    document.querySelector('[data-objectId="' + objectId + '"]').classList.add('active');
                    // Центрирование по метке
                    myMap.setCenter(objectManager.objects.getById(objectId).geometry.coordinates, 15, {
                        checkZoomRange: true
                    });
                }

                //ПЕРЕДЕЛКА ТОЧЕК НА КАРТЕ
                /*function reloadPoint () {
                    setTimeout(function() {
                        let points = document.querySelectorAll('.ymaps-2-1-79-placemark-overlay.ymaps-2-1-79-user-selection-none');

                        points.forEach(point => {
                            point.innerHTML = '';

                            let backgroundDiv = document.createElement('div');
                            backgroundDiv.className = 'main__background';

                            let buttonDiv = document.createElement('div');
                            buttonDiv.className = 'main__button';

                            point.appendChild(backgroundDiv);
                            point.appendChild(buttonDiv);
                        });
                    }, 25)
                }*/
            }
        }

        if (find('.products-page')) {
            let openCategory = find('.body__category.mobile .category__open-button'),
                allCategory = find('.body__category.mobile .category__all-categories');

            openCategory.addEventListener('click', function (e) {
                openCategory.classList.toggle('open');

                allCategory.classList.toggle('open');
            });
        }
    } );

    window.addEventListener('load', function () {
        //МАСКА НА ТЕЛЕФОН
        $( "input[type=tel]" ).mask( "+9 (999) 999-9999" );

        //МАСКА НА ДАТУ РОЖДЕНИЯ
        $( "input.birthday[type=text]" ).mask( "99.99.9999" );

        //ЛОГИКА ДОБАВЛЕНИЯ ФАЙЛА В ФОРМУ ВАКАНСИИ
        let file = document.getElementById('vacancy-file');

        if (file) {
            let fileIcon = '<svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<path d="M13.3526 4.05406V14.3243C13.3526 16.5597 11.6249 18.3784 9.50126 18.3784C7.3776 18.3784 5.6499 16.5598 5.6499 14.3243V4.05406C5.6499 2.71281 6.68651 1.62164 7.9607 1.62164C9.23488 1.62164 10.2715 2.71281 10.2715 4.05406V14.3243C10.2715 14.7714 9.92594 15.1352 9.50122 15.1352C9.0765 15.1352 8.73094 14.7714 8.73094 14.3243V4.05406H7.19045V14.3243C7.19045 15.6656 8.22707 16.7568 9.50126 16.7568C10.7754 16.7568 11.8121 15.6656 11.8121 14.3243V4.05406C11.8121 1.81863 10.0844 0 7.96073 0C5.83711 0 4.10938 1.81863 4.10938 4.05406V14.3243C4.10938 17.4539 6.52816 20 9.50126 20C12.4743 20 14.8931 17.4539 14.8931 14.3243V4.05406H13.3526Z" fill="black"/>' +
                '</svg>';

            let fileRemoveIcon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<circle cx="10" cy="10" r="10" fill="#FF4B4B"/>' +
                '<path d="M14 14L6 6.00002M6 14L14 6" stroke="#FFFFFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
                '</svg>';

            //СОЗДАЕМ ОБЩИЙ БЛОК С ИНФОМРАЦИЕЙ О ФАЙЛЕ И КНОПКЕ УДАЛЕНИЯ ФАЙЛА
            let fileControl = document.createElement('div');
            fileControl.className = 'custom-file-control';

            //СОЗДАЕМ БЛОК С ИНФОРМАЦИЕЙ О ФАЙЛЕ
            let fileInfo = document.createElement('div');
            fileInfo.className = 'custom-file-info';
            fileInfo.style.display = 'none';

            let fileName = document.createElement('p');
            fileName.className = 'custom-file-name';

            fileInfo.innerHTML = fileIcon;
            fileInfo.appendChild(fileName);

            //СОЗДАЕМ КНОПКУ УДАЛЕНИЯ ФАЙЛА
            let fileRemove = document.createElement('a');
            fileRemove.className = 'custom-file-remove';
            fileRemove.href = '#';
            fileRemove.style.display = 'none';
            fileRemove.innerHTML = fileRemoveIcon;

            //СОЗДАННЫЕ БЛОКИ ПОМЕЩАЕМ В ОБЩИЙ БЛОК
            fileControl.appendChild(fileInfo);
            fileControl.appendChild(fileRemove);

            //ПОМЕЩАЕМ ОБЩИЙ БЛОК В ПОДГОТОВЛЕННЫЙ БЛОК С КНОПКОЙ ЗАГРУЗКИ ФАЙЛА
            let fileCustom = document.querySelector('.custom-file-upload');
            fileCustom.parentNode.insertBefore(fileControl, fileCustom.nextSibling);

            //ЛОГИКА ЕСЛИ INPUT ФАЙЛА МЕНЯЕТСЯ
            file.addEventListener('change', function(e) {
                if (file.files.length > 0) {
                    fileName.textContent = file.files[0].name;

                    fileInfo.style.display = 'grid';
                    fileRemove.style.display = 'flex';
                } else {
                    fileName.textContent = '';

                    fileInfo.style.display = 'none';
                    fileRemove.style.display = 'none';
                }
            });

            //ЛОГИКА УДАЛЕНИЯ ФАЙЛА
            fileRemove.addEventListener('click', function(e) {
                e.preventDefault();
                file.value = '';
                fileName.textContent = '';

                fileInfo.style.display = 'none';
                fileRemove.style.display = 'none';
            });
        }

        //ЛОГИКА ОТПРАВКИ ФОРМ
        let forms = document.querySelectorAll('.wpcf7');

        for (let form of forms) {
            form.addEventListener('submit', function () {
                if (form.id === 'wpcf7-f12-o1') {
                    document.querySelector('.input.post').value = document.querySelector('.popup-vacancy .popup-vacancy__info .info__name').textContent;
                }
            });

            //УСПЕШНАЯ ОТПРАВКА ФОРМЫ
            form.addEventListener('wpcf7mailsent', function () {
                Fancybox.close();

                Fancybox.show([{ src: '#popup-success', type: "inline" }]);
            });

            //НЕУСПЕШНАЯ ОТПРАВКА ФОРМЫ
            form.addEventListener('wpcf7mailfailed', function () {
                Fancybox.close();

                Fancybox.show([{ src: '#popup-failed', type: "inline" }]);
            });
        }

        // Получаем путь страницы
        const currentPath = window.location.pathname;

        // Получаем хэш, если он есть
        const currentHash = window.location.hash;

        // Проверяем, находится ли пользователь на странице /vacancy/
        if (currentPath === '/vacancy/') {

            // Дополнительная проверка на наличие хэша
            if (currentHash) {
                if (document.querySelector('a[href="' + currentHash + '"]')) {
                    document.querySelector('a[href="' + currentHash + '"]').click();
                }
            }
        }
    });
})( jQuery );