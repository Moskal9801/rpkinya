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

        document.addEventListener('input', function (e) {
            if (e.target.closest('.product-card') || e.target.closest('.cart-card')) {
                e.preventDefault();

                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            }
        });

        document.addEventListener('change', function (e) {
            if (e.target.closest('.product-card')) {
                let controlling = e.target.closest('.product-card').querySelector('.buy-controlling'),
                    add = e.target.closest('.product-card').querySelector('.add__cart'),
                    added = e.target.closest('.product-card').querySelector('.add__quantity'),
                    input = e.target.closest('.product-card').querySelector('.quantity__input');

                if (e.target.closest('.quantity__input')) {
                    e.preventDefault();

                    controlling.dataset.quantity = e.target.value;

                    input.value = parseInt(controlling.dataset.quantity, 10);

                    if (e.target.value > 0) {
                        if (find('.cart-page')) {
                            let cartItems = findAll('.cart-controlling');

                            cartItems.forEach(function (item) {

                                if (item.dataset.id === controlling.dataset.id) {

                                    let itemInput = item.querySelector('.quantity__input');

                                    item.dataset.quantity = parseInt(controlling.dataset.quantity, 10);

                                    itemInput.value = parseInt(controlling.dataset.quantity, 10);
                                }
                            });
                        }

                        if (find('.cart-page')) {
                            notCart();
                        }

                        updateFromCart(controlling.dataset.id, parseInt(controlling.dataset.quantity, 10));
                    } else {
                        if (find('.cart-page')) {
                            let cartItems = findAll('.cart-controlling');

                            cartItems.forEach(function (item) {

                                if (item.dataset.id === controlling.dataset.id) {

                                    item.closest('.products__item').remove();
                                }
                            });
                        }

                        add.classList.remove('added');
                        add.textContent = '+ Купить';
                        add.href = '#';

                        added.style.display = 'none';

                        if (find('.cart-page')) {
                            notCart();
                        }

                        removeFromCart(controlling.dataset.id);
                    }
                }
            }

            if (e.target.closest('.cart-card')) {
                let cart = e.target.closest('.cart-card').querySelector('.cart-controlling'),
                    input = e.target.closest('.cart-card').querySelector('.quantity__input');

                if (e.target.closest('.quantity__input')) {
                    e.preventDefault();

                    cart.dataset.quantity = e.target.value;

                    input.value = parseInt(cart.dataset.quantity, 10);

                    if (e.target.value > 0) {
                        if (find('.cart-page')) {
                            let buyItems = findAll('.buy-controlling');

                            buyItems.forEach(function (item) {

                                if (item.dataset.id === cart.dataset.id) {

                                    let itemInput = item.querySelector('.quantity__input');

                                    item.dataset.quantity = parseInt(cart.dataset.quantity, 10);

                                    itemInput.value = parseInt(cart.dataset.quantity, 10);
                                }
                            });
                        }

                        notCart();

                        updateFromCart(cart.dataset.id, parseInt(cart.dataset.quantity, 10));
                    } else {
                        if (find('.cart-page')) {
                            let buyItems = findAll('.buy-controlling');

                            buyItems.forEach(function (item) {

                                if (item.dataset.id === cart.dataset.id) {
                                    let itemAdd = item.querySelector('.add__cart'),
                                        itemAdded = item.querySelector('.add__quantity'),
                                        itemInput = item.querySelector('.quantity__input');

                                    item.dataset.quantity = parseInt(cart.dataset.quantity, 10);

                                    itemAdd.classList.remove('added');
                                    itemAdd.textContent = '+ Купить';
                                    itemAdd.href = '#';

                                    itemAdded.style.display = 'none';

                                    itemInput.value = parseInt(cart.dataset.quantity, 10);
                                }
                            });
                        }

                        cart.closest('.products__item').remove();

                        notCart();

                        removeFromCart(cart.dataset.id);
                    }
                }
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.closest('.product-card')) {
                let controlling = e.target.closest('.product-card').querySelector('.buy-controlling'),
                    add = e.target.closest('.product-card').querySelector('.add__cart'),
                    added = e.target.closest('.product-card').querySelector('.add__quantity'),
                    input = e.target.closest('.product-card').querySelector('.quantity__input');

                if (e.target.closest('.add__cart')) {
                    if (!add.classList.contains('added')) {
                        e.preventDefault();

                        controlling.dataset.quantity = parseInt(controlling.dataset.quantity, 10) + 1;

                        input.value = parseInt(controlling.dataset.quantity, 10);

                        add.classList.add('added');
                        add.textContent = 'В корзинe';
                        add.href = '/cart/';

                        added.style.display = 'flex';

                        if (find('.cart-page')) {
                            addCart(controlling.dataset.id);
                        }

                        addToCart(controlling.dataset.id, parseInt(controlling.dataset.quantity, 10));
                    }
                }

                if (e.target.closest('.quantity__minus')) {
                    e.preventDefault();

                    controlling.dataset.quantity = parseInt(controlling.dataset.quantity, 10) - 1;

                    input.value = parseInt(controlling.dataset.quantity, 10);

                    if (parseInt(controlling.dataset.quantity, 10) > 0) {
                        if (find('.cart-page')) {
                            let cartItems = findAll('.cart-controlling');

                            cartItems.forEach(function (item) {

                                if (item.dataset.id === controlling.dataset.id) {

                                    let itemInput = item.querySelector('.quantity__input');

                                    item.dataset.quantity = parseInt(controlling.dataset.quantity, 10);

                                    itemInput.value = parseInt(controlling.dataset.quantity, 10);
                                }
                            });
                        }

                        if (find('.cart-page')) {
                            notCart();
                        }

                        updateFromCart(controlling.dataset.id, parseInt(controlling.dataset.quantity, 10));
                    } else {
                        if (find('.cart-page')) {
                            let cartItems = findAll('.cart-controlling');

                            cartItems.forEach(function (item) {

                                if (item.dataset.id === controlling.dataset.id) {

                                    item.closest('.products__item').remove();
                                }
                            });
                        }

                        add.classList.remove('added');
                        add.textContent = '+ Купить';
                        add.href = '#';

                        added.style.display = 'none';

                        if (find('.cart-page')) {
                            notCart();
                        }

                        removeFromCart(controlling.dataset.id);
                    }
                }

                if (e.target.closest('.quantity__plus')) {
                    e.preventDefault();

                    controlling.dataset.quantity = parseInt(controlling.dataset.quantity, 10) + 1;

                    input.value = parseInt(controlling.dataset.quantity, 10);

                    if (find('.cart-page')) {
                        let cartItems = findAll('.cart-controlling');

                        cartItems.forEach(function (item) {

                            if (item.dataset.id === controlling.dataset.id) {

                                let itemInput = item.querySelector('.quantity__input');

                                item.dataset.quantity = parseInt(controlling.dataset.quantity, 10);

                                itemInput.value = parseInt(controlling.dataset.quantity, 10);
                            }
                        });
                    }

                    if (find('.cart-page')) {
                        notCart();
                    }

                    updateFromCart(controlling.dataset.id, parseInt(controlling.dataset.quantity, 10));
                }
            }

            if (e.target.closest('.cart-card')) {
                let cart = e.target.closest('.cart-card').querySelector('.cart-controlling'),
                    input = e.target.closest('.cart-card').querySelector('.quantity__input');

                if (e.target.closest('.more__remove')) {
                    e.preventDefault();

                    if (find('.cart-page')) {
                        let buyItems = findAll('.buy-controlling');

                        buyItems.forEach(function (item) {

                            if (item.dataset.id === cart.dataset.id) {
                                let itemAdd = item.querySelector('.add__cart'),
                                    itemAdded = item.querySelector('.add__quantity'),
                                    itemInput = item.querySelector('.quantity__input');

                                item.dataset.quantity = 0;

                                itemAdd.classList.remove('added');
                                itemAdd.textContent = '+ Купить';
                                itemAdd.href = '#';

                                itemAdded.style.display = 'none';

                                itemInput.value = 0;
                            }
                        });
                    }

                    cart.closest('.products__item').remove();

                    if (find('.cart-page')) {
                        notCart();
                    }

                    removeFromCart(cart.closest('.products__item').querySelector('.cart-controlling').dataset.id);
                }

                if (e.target.closest('.quantity__minus')) {
                    e.preventDefault();

                    cart.dataset.quantity = parseInt(cart.dataset.quantity, 10) - 1;

                    input.value = parseInt(cart.dataset.quantity, 10);

                    if (parseInt(cart.dataset.quantity, 10) > 0) {
                        if (find('.cart-page')) {
                            let buyItems = findAll('.buy-controlling');

                            buyItems.forEach(function (item) {

                                if (item.dataset.id === cart.dataset.id) {

                                    let itemInput = item.querySelector('.quantity__input');

                                    item.dataset.quantity = parseInt(cart.dataset.quantity, 10);

                                    itemInput.value = parseInt(cart.dataset.quantity, 10);
                                }
                            });
                        }

                        if (find('.cart-page')) {
                            notCart();
                        }

                        updateFromCart(cart.dataset.id, parseInt(cart.dataset.quantity, 10));
                    } else {
                        if (find('.cart-page')) {
                            let buyItems = findAll('.buy-controlling');

                            buyItems.forEach(function (item) {

                                if (item.dataset.id === cart.dataset.id) {
                                    let itemAdd = item.querySelector('.add__cart'),
                                        itemAdded = item.querySelector('.add__quantity'),
                                        itemInput = item.querySelector('.quantity__input');

                                    item.dataset.quantity = parseInt(cart.dataset.quantity, 10);

                                    itemAdd.classList.remove('added');
                                    itemAdd.textContent = '+ Купить';
                                    itemAdd.href = '#';

                                    itemAdded.style.display = 'none';

                                    itemInput.value = parseInt(cart.dataset.quantity, 10);
                                }
                            });
                        }

                        cart.closest('.products__item').remove();

                        if (find('.cart-page')) {
                            notCart();
                        }

                        removeFromCart(cart.dataset.id);
                    }
                }

                if (e.target.closest('.quantity__plus')) {
                    e.preventDefault();

                    cart.dataset.quantity = parseInt(cart.dataset.quantity, 10) + 1;

                    input.value = parseInt(cart.dataset.quantity, 10);

                    if (find('.cart-page')) {
                        let buyItems = findAll('.buy-controlling');

                        buyItems.forEach(function (item) {

                            if (item.dataset.id === cart.dataset.id) {

                                let itemInput = item.querySelector('.quantity__input');

                                item.dataset.quantity = parseInt(cart.dataset.quantity, 10);

                                itemInput.value = parseInt(cart.dataset.quantity, 10);
                            }
                        });
                    }

                    if (find('.cart-page')) {
                        notCart();
                    }

                    updateFromCart(cart.dataset.id, parseInt(cart.dataset.quantity, 10));
                }
            }
        });

        //ФУНКЦИЯ ДОБАВЛЕНИЯ ТОВАРА
        function addToCart (productId, quantity) {
            const data = new FormData();

            data.append('action', 'addProduct');
            data.append('productId', productId);
            data.append('quantity', quantity);

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            }).then((response) => {
                if ( !response.ok ) {
                    alert( 'Ошибка запроса!' );
                }

                return response.json();
            }).then( (result) => {
                if (result) {
                    updateSpanCart(result.data);

                    if (find('.cart-page')) {
                        updateCart();
                    }

                    $( document.body ).trigger( 'update_checkout' );

                    $.notify("Товар добавлен в корзину", {
                        clickToHide: true,
                        autoHide: true,
                        autoHideDelay: 2500,
                        showAnimation: 'fadeIn',
                        showDuration: 250,
                        hideAnimation: 'fadeOut',
                        hideDuration: 500,
                    });

                    console.log("Товар добавлен")
                }
            });
        }

        //ФУНКЦИЯ ОБНОВЛЕНИЯ КОЛИЧЕСТВА ТОВАРА
        function updateFromCart (productId, quantity) {
            const data = new FormData();

            data.append('action', 'updateProduct');
            data.append('productId', productId);
            data.append('quantity', quantity);

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            }).then((response) => {
                if ( !response.ok ) {
                    alert( 'Ошибка запроса!' );
                }

                return response.json();
            }).then( (result) => {
                if (result) {
                    updateSpanCart(result.data);

                    if (find('.cart-page')) {
                        updateCart();
                    }

                    $.notify("Товар обновлен в корзине", {
                        clickToHide: true,
                        autoHide: true,
                        autoHideDelay: 2500,
                        showAnimation: 'fadeIn',
                        showDuration: 250,
                        hideAnimation: 'fadeOut',
                        hideDuration: 500,
                    });

                    console.log("Количество товара обновлено")
                }
            });
        }

        //ФУНКЦИЯ УДАЛЕНИЯ ТОВАРА
        function removeFromCart (productId) {
            const data = new FormData();

            data.append('action', 'removeProduct');
            data.append('productId', productId);

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            }).then((response) => {
                if ( !response.ok ) {
                    alert( 'Ошибка запроса!' );
                }

                return response.json();
            }).then( (result) => {
                if (result) {
                    updateSpanCart(result.data);

                    if (find('.cart-page')) {
                        updateCart();
                    }

                    $.notify("Товар удален из корзины", {
                        clickToHide: true,
                        autoHide: true,
                        autoHideDelay: 2500,
                        showAnimation: 'fadeIn',
                        showDuration: 250,
                        hideAnimation: 'fadeOut',
                        hideDuration: 500,
                    });

                    console.log("Товар удален")
                }
            });
        }

        //ФУНКЦИЯ ОБНОВЛЕНИЯ КОЛИЧЕСТВА В ИКОНКЕ КОРЗИНЫ
        function updateSpanCart (result) {
            let allCart = findAll('.controlling__cart span');

            allCart.forEach(function (cart) {
                if (result > 0) {
                    cart.style.display = 'flex';
                    cart.textContent = result;
                } else {
                    cart.style.display = 'none';
                    cart.textContent = result;
                }
            });
        }

        //ФУНКЦИЯ ДОБАВЛЕНИЯ ВЕРСТКИ ТОВАРА В КОРЗИНУ
        function addCart (productId) {
            const data = new FormData();

            data.append('action', 'addCart');
            data.append('productId', productId);

            fetch('/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            }).then((response) => {
                if ( !response.ok ) {
                    alert( 'Ошибка запроса!' );
                }

                return response.text();
            }).then( (result) => {
                if (result) {

                    find('.cart-page__cart .body__items-cart .items-cart__products').insertAdjacentHTML('beforeend', result);

                    notCart();

                    console.log("Верстка добавлена в корзину")
                }
            });
        }

        //ФУНКЦИЯ ОБНОВЛЕНИЯ СУММЫ И КОЛИЧЕСТВА ТОВАРА В КОРЗИНЕ
        function updateCart () {
            let quantity = 0,
                regularPrice = 0,
                salePrice = 0,
                discountAll = 0;

            let allCart = findAll('.cart-controlling');

            allCart.forEach(function (cart) {
                quantity += parseInt(cart.dataset.quantity);
                regularPrice += (parseFloat(cart.dataset.regular) * parseInt(cart.dataset.quantity));
                salePrice += (parseFloat(cart.dataset.sale) * parseInt(cart.dataset.quantity));
                discountAll += (parseFloat(cart.dataset.discount) * parseInt(cart.dataset.quantity));
            });

            find('.items-cart__ordering .ordering__item.quantity span').textContent = quantity;
            find('.items-cart__ordering .ordering__item.regular span').textContent = regularPrice;
            find('.items-cart__ordering .ordering__item.discount span').textContent = '-' + discountAll;
            find('.items-cart__ordering .ordering__item.sale span').textContent = salePrice;
        }

        //ФУНКЦИЯ ОБНОВЛЕНИЯ ВЕРСТКИ ПРИ ОТСУТСТВИИ ТОВАРОВ В КОРЗИНЕ
        function notCart () {
            let cartCard = findAll('.cart-card'),
                cartItems = find('.body__items-cart'),
                notItems = find('.body__items-not');

            console.log(cartCard.length)

            if (cartCard.length > 0) {
                cartItems.style.display = 'grid';
                notItems.style.display = 'none';
            } else {
                cartItems.style.display = 'none';
                notItems.style.display = 'flex';
            }
        }
    } );
})( jQuery );