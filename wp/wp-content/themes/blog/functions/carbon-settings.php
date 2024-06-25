<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    $screens_labels = array(
        'plural_name' => 'секции',
        'singular_name' => 'секцию',
    );

    $labels = array(
        'plural_name' => 'элементы',
        'singular_name' => 'элемент',
    );
    $periods_pricing = array(
        'plural_name' => 'периоды',
        'singular_name' => 'период',
    );
    $labels_modals = array(
        'plural_name' => 'модальные окна',
        'singular_name' => 'модальное окно',
    );


    Container::make('theme_options', "Информация сайта")
        ->add_fields(array(


        ));


    Container::make('theme_options', 'Модальные окна')
        ->add_tab('Модальные окна', array(
            Field::make('complex', 'modals', 'Модальные окна')
                ->setup_labels($labels_modals)
                ->set_layout('tabbed-vertical')
                ->add_fields(array(
                    Field::make("text", "id", "ID окна (уникальное значение)")
                        ->set_attribute('pattern', '^[a-z0-9\-]+$')
                        ->set_help_text('Слово на латинице без пробелов. Возможен сымвол: "-" <br> <strong>Значение ID не должно повторятся!</strong>')
                        ->set_required(true),
                    Field::make("text", "title", "Заголовок "),
                    Field::make("textarea", "subtitle", "Подзаголовок"),
                    Field::make("text", "form", "Шорткод формы")->set_required(true),
                ))
                ->set_header_template('
                        <%- $_index + 1 %>.
                        <% if (title) { %>
                            "<%- title %>"
                        <% } %>
                    ')
        ))
        ->add_tab('Окно благодарности', array(
            Field::make("text", "thanks_title", "Заголовок")->set_required(true),
            Field::make("text", "thanks_subtitle", "Подзаголовок"),
        ));

}

add_action('carbon_fields_register_fields', 'crb_attach_in_front_page');
function crb_attach_in_front_page()
{

    $var = variables();
    $set = $var['setting_home'];
    $assets = $var['assets'];
    $url = $var['url'];

    $screens_labels = array(
        'plural_name' => 'секции',
        'singular_name' => 'секцию',
    );

    $labels = array(
        'plural_name' => 'элементы',
        'singular_name' => 'элемент',
    );

    $labels_modals = array(
        'plural_name' => 'модальные окна',
        'singular_name' => 'модальное окно',
    );

    Container::make('post_meta', 'Секции')
        ->show_on_template('index.php')
        ->add_fields(array(
            Field::make('complex', 'screens', 'Секции')
                ->set_layout('tabbed-vertical')
                ->setup_labels($screens_labels)
                ->add_fields('screen_1', 'Баннер', array(
                    Field::make("separator", "crb_style_screen_off", "Выключить секцию?"),
                    Field::make('checkbox', 'screen_off', 'Выключить секцию?'),
                    Field::make("separator", "crb_style_inform", "Информация"),
                    get_field_id(),
                    Field::make("rich_text", "title", "Заголовок")
                        ->set_help_text('Сделайте слово/текст жирным чтобы использовать прозрачный шрифт')
                        ->set_required(true),
                    Field::make("rich_text", "subtitle", "Подзаголовок"),
                    add_button(),
                    Field::make("separator", "crb_style_inform1", "Изображение фона"),
                    Field::make("image", "image", "Изображение фона")->set_required(true),
                ))
        ));

}

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    get_template_part('vendor/autoload');
    \Carbon_Fields\Carbon_Fields::boot();
}

add_filter('crb_media_buttons_html', function ($html, $field_name) {
    if (
        $field_name === 'contacts_text' ||
        $field_name === 'contacts_title1' ||
        $field_name === 'contacts_title' ||
        $field_name === 'news_title1' ||
        $field_name === 'news_title' ||
        $field_name === 'vacancies_text' ||
        $field_name === 'vacancies_title' ||
        $field_name === 'vacancies_title1' ||
        $field_name === 'story_title' ||
        $field_name === 'text' ||
        $field_name === 'subtitle' ||
        $field_name === 'title'
    ) {
        return;
    }

    return $html;
}, 10, 2);

function get_field_id()
{
    return Field::make("text", "id", "ID секции (уникальное значение)")
        ->set_attribute('pattern', '^[a-z0-9\-]+$')
        ->set_help_text('Слово на латинице без пробелов. Возможен сымвол: "-" <br> <strong>Значение ID не должно повторятся!</strong>')
        ->set_required(true);
}

function add_button($args = array())
{
    $var = variables();
    $set = $var['setting_home'];
    $assets = $var['assets'];
    $url = $var['url'];
    $url_home = $var['url_home'];

    $id = $args['id'] ?: 'links';

    $name = $args['name'] ?: 'Кнопки';

    $max = $args['max'] ?: 1;

    $labels = array(
        'plural_name' => 'элементы',
        'singular_name' => 'элемент',
    );

    return Field::make('complex', $id, $name)
        ->setup_labels($labels)
        ->set_max($max)
        ->add_fields('modal', 'Кнопка вызова модального окна',
            array(
                Field::make("text", "button_text", "Текст")
                    ->set_width(50)
                    ->set_required(true),
                Field::make("select", "modal", "ID окна")
                    ->set_width(50)
                    ->add_options('get_modals')
                    ->set_required(true),
            )
        )
        ->add_fields('link', 'Ссылка', array(
            Field::make('text', 'button_text', 'Текст')
                ->set_width(50)
                ->set_required(true),
            Field::make('text', 'link', 'Ссылка')
                ->set_width(50)
                ->set_attribute('type', 'url')
                ->set_required(true),

        ));
}