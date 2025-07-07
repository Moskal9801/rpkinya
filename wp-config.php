<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'rpkinya' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'n4R|_l,@;2oF9nEm>t[bg^]{4$M%10:`I7ofYk1LQ4LrnmI#R5gmNRkq^dXazTB9' );
define( 'SECURE_AUTH_KEY',  'ReBe82~9Ue]OX8#DG?ppf([)j[lhYmna/Hc4qYL.fd[@)S/kWwPVw2W/kVEcg5{M' );
define( 'LOGGED_IN_KEY',    'cF`B6q=hywWu_D9/( 58:beJgI9}qXX/18%l,xW^OYZYJsH_TB#J0zEm#732D7jd' );
define( 'NONCE_KEY',        '/Q`x<Yyv=d7AIjf1;e:P)ISt5MnDU;]65PxD$s,egoAjXC.KrucG(zmKWjR_27[D' );
define( 'AUTH_SALT',        'J&p_Wy~X4/Y.]@:EsZk}W5zBXF2BW&_<(VkO9$T;prClzcz0;|NnGy }/2(?%YB9' );
define( 'SECURE_AUTH_SALT', 'p!p&&r.#x7V)(El3@auE:,[ TnR|nuI7Kf*a`EzU>sxnbu&[r)&?`tAmwsd7~d L' );
define( 'LOGGED_IN_SALT',   'J;vp#!K7#wTvS$auhuVYgZgk-cdBy&b^0f,*u!@}VpDQ;Ja`GVqZ&(;m*j.ON]9E' );
define( 'NONCE_SALT',       'h}8EZgud&H!N7*hlKLML.(kI Zdr/xJ/1U{jUhynq.T9RSHEDc,js./E`Lw+y_~;' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
