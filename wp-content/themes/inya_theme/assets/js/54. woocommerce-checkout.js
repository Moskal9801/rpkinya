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

        if (find('.checkout-page')) {
            function clearWooCommerceFields() {
                //СТАНДРАТНЫЕ ПОЛЯ WOOCOMMERCE
                const fieldsToClean = [
                    'billing_first_name',
                    'billing_address_1',
                    'billing_address_2',
                    'billing_phone',
                    'billing_email',
                    'order_comments',
                    'billing_date',
                    'billing_time',
                    'billing_change',
                ];

                //ОЧИЩАЕМ КАЖДОЕ ПОЛЕ
                fieldsToClean.forEach(fieldName => {
                    const field = document.getElementById(fieldName);

                    if (field) {
                        field.value = '';
                    }
                });
            }

            clearWooCommerceFields();

            //ПЕРЕКЛЮЧЕНИЕ МЕЖДУ ДОСТАВКАМИ
            let methodDelivery = document.querySelectorAll('.delivery input[name="shipping"]');

            methodDelivery.forEach(function (item) {
                item.addEventListener('click', function (e) {
                    let methodContents = document.querySelectorAll('.delivery .info__items');

                    methodContents.forEach(function (content) {
                       if (item.value === content.id) {
                           content.style.display = 'flex';
                       } else {
                           content.style.display = 'none';
                       }
                    });

                    const fieldsToClean = [
                        'wc__city',
                        'billing_address_1',
                        'wc__entrance',
                        'wc__intercom',
                        'wc__room',
                        'wc__floor',
                        'billing_address_2',
                        'wc__date',
                        'billing_date',
                        'wc__time',
                        'billing_time',
                    ];

                    //ОЧИЩАЕМ КАЖДОЕ ПОЛЕ
                    fieldsToClean.forEach(fieldName => {
                        const fields = document.querySelectorAll(`input[name="${fieldName}"]`);

                        fields.forEach(function (field) {
                            if (field) {
                                field.value = '';

                                field.classList.remove('required');
                            }
                        });
                    });

                    let methodLabel = e.target.closest('.method__item').querySelector('label').textContent,
                        methodDefault = document.querySelectorAll('.woocommerce-shipping-methods li');

                    methodDefault.forEach(function (method) {
                        if (method.querySelector('label').textContent === methodLabel) {
                            method.querySelector('label').click();
                        }
                    });

                    if (methodLabel === 'Самовывоз') {
                        document.querySelector('input[name="billing_address_1"]').value = 'Хабаровск, ул. Тихоокеанская, 204, корпус 3';
                    }
                });
            });

            document.querySelector('.delivery input[name="shipping"]').click();

            //ПЕРЕКЛЮЧЕНИЕ МЕЖДУ ОПЛАТАМИ
            let methodCash = document.querySelectorAll('.order input[name="payment"]');

            methodCash.forEach(function (item) {
                item.addEventListener('click', function (e) {
                    let methodContents = document.querySelectorAll('.order .amount__change');

                    methodContents.forEach(function (content) {
                        if (item.value === content.id) {
                            content.style.display = 'flex';
                        } else {
                            content.style.display = 'none';
                        }
                    });

                    let methodLabel = e.target.closest('.method__item').querySelector('label').textContent,
                        methodDefault = document.querySelectorAll('.wc_payment_methods.payment_methods li');

                    methodDefault.forEach(function (method) {
                        if (method.querySelector('label').textContent.trim() === methodLabel) {
                            method.querySelector('label').click();
                        }
                    });

                    const fieldsToClean = [
                        'wc__change',
                        'billing_change',
                    ];

                    //ОЧИЩАЕМ КАЖДОЕ ПОЛЕ
                    fieldsToClean.forEach(fieldName => {
                        const fields = document.querySelectorAll(`input[name="${fieldName}"]`);

                        fields.forEach(function (field) {
                            if (field) {
                                field.value = '';
                            }
                        });
                    });
                });
            });

            document.querySelector('.order input[name="payment"]').click();

            //ПОДСТАНОВКА КАСТОМНЫЙ ПОЛЕЙ В СТАНДАРТНЫЕ ПОЛЯ WOOCOMMERCE
            let wooInputs = document.querySelectorAll('.checkout-page input[data-for-input]');

            wooInputs.forEach(function (input) {
               input.addEventListener('blur', function (e) {
                  e.preventDefault();

                  let targetInput = document.querySelector(`[name="${this.dataset.forInput}"]`);

                   targetInput.value = this.value;
               });
            });

            //ОТПРАВКА ЗАКАЗА
            let customSubmit = document.querySelector('.checkout-page .amount__button');

            customSubmit.addEventListener('click', function (e) {
                e.preventDefault();

                let requiredInputs = document.querySelectorAll('.checkout-page input[required]');
                let isPickupSelected = document.querySelector('.method__item input[id="pickup"]:checked') !== null;
                let confirmCheckbox = document.querySelector('#wc-confirm__checkbox');

                let isValid = true;

                function validateField(input) {
                    if (isPickupSelected && input.name === 'wc__city') {
                        input.classList.remove('required');
                        return;
                    }

                    if (!input.value.trim()) {
                        input.classList.add('required');
                        isValid = false;
                    } else {
                        input.classList.remove('required');
                    }
                }

                requiredInputs.forEach(validateField);

                if (!confirmCheckbox.checked) {
                    confirmCheckbox.classList.add('required');
                    isValid = false;
                } else {
                    confirmCheckbox.classList.remove('required');
                }

                if (isValid) {
                    let entrance = document.querySelector('input[name="wc__entrance"]').value,
                        intercom = document.querySelector('input[name="wc__intercom"]').value,
                        room = document.querySelector('input[name="wc__room"]').value,
                        floor = document.querySelector('input[name="wc__floor"]').value;

                    let address2 = '';

                    if (entrance) {
                        address2 += 'Подъезд:&nbsp' + entrance + '; ';
                    }

                    if (intercom) {
                        address2 += 'Домофон:&nbsp' + intercom + '; ';
                    }

                    if (room) {
                        address2 += 'Кв./офис:&nbsp' + room + '; ';
                    }

                    if (floor) {
                        address2 += 'Этаж:&nbsp' + floor + '; ';
                    }

                    document.querySelector('input[name="billing_address_2"]').value = address2;

                    document.querySelector('button[name="woocommerce_checkout_place_order"]').click();
                }
            })

            //МАСКА ДЛЯ INPUT ПОЛЕЙ
            $("[name=wc__phone]").click().mask("+7 (999) 999-99-99");
            $("[name=wc__date]").click().mask("99.99.9999");
            $("[name=wc__time]").click().mask("99:99");

            //ВЫБОР ДАТЫ ДЛЯ INPUT
            $('input.date-picker').each(function (index) {
                $(this).datetimepicker({
                    timepicker: false,
                    format: 'd.m.Y',
                    minDate: 0,
                    dayOfWeekStart: 1,
                    closeOnWithoutClick: false,
                    onSelectDate: function (ct, $i) {
                        document.activeElement.blur();
                    }
                });
            })

            //ВЫБОР ВРЕМЕНИ ДЛЯ INPUT
            $('input.time-picker').each(function (index) {
                $(this).datetimepicker({
                    datepicker: false,
                    timepicker: true,
                    format: 'H:i',
                    minTime: 0,
                    step: 15,
                    closeOnWithoutClick: false,
                    onSelectDate: function (ct, $i) {
                        document.activeElement.blur();
                    }
                });
            })

            $.datetimepicker.setLocale('ru');
        }
    } );
})( jQuery );