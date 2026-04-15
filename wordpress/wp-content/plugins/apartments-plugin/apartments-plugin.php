<?php
/*
Plugin Name: Apartments Plugin
Description: Plugin for managing apartments with gallery support
Version: 2.0
*/

// Register Custom Post Type
function custom_post_type()
{
    $labels = array(
        'name'                  => _x('Apartments', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Apartment', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Квартиры', 'text_domain'),
        'name_admin_bar'        => __('Квартира', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Apartment', 'text_domain'),
        'description'           => __('Plugin for apartments', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'), // поддержка миниатюры
        'public'                => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'apartments'),
    );
    register_post_type('apartment', $args);
}
add_action('init', 'custom_post_type', 0);

// Add meta box
function apartment_meta_box()
{
    add_meta_box(
        'apartment_fields',
        'Данные квартиры',
        'apartment_fields_html',
        'apartment',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'apartment_meta_box');

// Meta box HTML (включая галерею)
function apartment_fields_html($post)
{
    wp_nonce_field('apartment_save_data', 'apartment_nonce');

    $description = get_post_meta($post->ID, 'apartment_description', true);
    $square = get_post_meta($post->ID, 'apartment_square', true);
    $count = get_post_meta($post->ID, 'apartment_count', true);
    $rooms = get_post_meta($post->ID, 'apartment_rooms', true);
    $floor = get_post_meta($post->ID, 'apartment_floor', true);
    $address = get_post_meta($post->ID, 'apartment_address', true);
    $amenities_tv = get_post_meta($post->ID, 'amenities_tv', true);
    $amenities_bathroom = get_post_meta($post->ID, 'amenities_bathroom', true);
    $gallery_ids = get_post_meta($post->ID, 'apartment_gallery', true);
    $gallery_ids_array = !empty($gallery_ids) ? explode(',', $gallery_ids) : array();
    ?>

    <div>
        <label style="font-size: 16px; font-style:italic">Описание квартиры</label><br>
        <textarea name="apartment_description" rows="4" cols="200"><?php echo esc_textarea($description); ?></textarea>
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Площадь квартиры (м²)</label><br>
        <input type="text" name="apartment_square" value="<?php echo esc_attr($square); ?>">
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Количество гостей</label><br>
        <input type="number" name="apartment_count" value="<?php echo esc_attr($count); ?>">
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Количество комнат</label><br>
        <input type="number" name="apartment_rooms" value="<?php echo esc_attr($rooms); ?>">
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Этаж</label><br>
        <input type="number" name="apartment_floor" value="<?php echo esc_attr($floor); ?>">
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Адрес</label><br>
        <input type="text" name="apartment_address" value="<?php echo esc_attr($address); ?>" size="100">
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Удобства: Видео/аудио</label><br>
        <p>
            <input type="checkbox" name="amenities_tv[]" value="flat_screen_tv" <?php checked(is_array($amenities_tv) && in_array('flat_screen_tv', $amenities_tv)); ?>>
            Телевизор с плоским экраном
        </p>
        <p>
            <input type="checkbox" name="amenities_tv[]" value="smart_tv" <?php checked(is_array($amenities_tv) && in_array('smart_tv', $amenities_tv)); ?>>
            Телевизор со Smart TV
        </p>
    </div>
    <br>

    <div>
        <label style="font-size: 16px; font-style:italic">Удобства: Ванная комната</label><br>
        <p><input type="checkbox" name="amenities_bathroom[]" value="bathtub" <?php checked(is_array($amenities_bathroom) && in_array('bathtub', $amenities_bathroom)); ?>> Ванна или душевая кабина</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="slippers" <?php checked(is_array($amenities_bathroom) && in_array('slippers', $amenities_bathroom)); ?>> Тапочки</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="toilet" <?php checked(is_array($amenities_bathroom) && in_array('toilet', $amenities_bathroom)); ?>> Унитаз</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="bathroom" <?php checked(is_array($amenities_bathroom) && in_array('bathroom', $amenities_bathroom)); ?>> Санузел</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="wc" <?php checked(is_array($amenities_bathroom) && in_array('wc', $amenities_bathroom)); ?>> Туалет</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="toiletries" <?php checked(is_array($amenities_bathroom) && in_array('toiletries', $amenities_bathroom)); ?>> Банные принадлежности</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="hygiene" <?php checked(is_array($amenities_bathroom) && in_array('hygiene', $amenities_bathroom)); ?>> Гигиенические средства</p>
        <p><input type="checkbox" name="amenities_bathroom[]" value="toilet_means" <?php checked(is_array($amenities_bathroom) && in_array('toilet_means', $amenities_bathroom)); ?>> Туалетные средства</p>
    </div>
    <br>

    <!-- ========== ГАЛЕРЕЯ ИЗОБРАЖЕНИЙ ========== -->
    <div>
        <label style="font-size: 16px; font-style:italic">Галерея изображений</label><br>
        <div id="apartment-gallery-container">
            <?php foreach ($gallery_ids_array as $img_id) :
                $img_url = wp_get_attachment_image_url($img_id, 'thumbnail');
                if ($img_url) : ?>
                    <div class="gallery-image" data-id="<?php echo esc_attr($img_id); ?>" style="display:inline-block; margin:5px; position:relative;">
                        <img src="<?php echo esc_url($img_url); ?>" style="width:100px; height:100px; object-fit:cover;">
                        <button type="button" class="remove-image" data-id="<?php echo esc_attr($img_id); ?>" style="position:absolute; top:-8px; right:-8px; background:red; color:white; border:none; border-radius:50%; cursor:pointer;">&times;</button>
                    </div>
                <?php endif;
            endforeach; ?>
        </div>
        <input type="hidden" name="apartment_gallery" id="apartment_gallery" value="<?php echo esc_attr($gallery_ids); ?>">
        <button type="button" id="upload_gallery_button" class="button">Выбрать/Загрузить изображения</button>
        <p class="description">Выберите несколько изображений для галереи квартиры.</p>
    </div>
    <br>
    <?php
}

// Сохранение данных
function save_apartment_data($post_id)
{
    if (!isset($_POST['apartment_nonce']) || !wp_verify_nonce($_POST['apartment_nonce'], 'apartment_save_data')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Текстовые поля
    $text_fields = array('apartment_description', 'apartment_square', 'apartment_count', 'apartment_rooms', 'apartment_floor', 'apartment_address');
    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Удобства
    if (isset($_POST['amenities_tv']) && is_array($_POST['amenities_tv'])) {
        update_post_meta($post_id, 'amenities_tv', array_map('sanitize_text_field', $_POST['amenities_tv']));
    } else {
        delete_post_meta($post_id, 'amenities_tv');
    }

    if (isset($_POST['amenities_bathroom']) && is_array($_POST['amenities_bathroom'])) {
        update_post_meta($post_id, 'amenities_bathroom', array_map('sanitize_text_field', $_POST['amenities_bathroom']));
    } else {
        delete_post_meta($post_id, 'amenities_bathroom');
    }

    // Галерея
    if (isset($_POST['apartment_gallery'])) {
        update_post_meta($post_id, 'apartment_gallery', sanitize_text_field($_POST['apartment_gallery']));
    }
}
add_action('save_post', 'save_apartment_data');

// Подключение медиа-загрузчика и скриптов только для страниц редактирования квартир
function apartment_admin_scripts($hook)
{
    global $post;
    if (($hook == 'post.php' || $hook == 'post-new.php') && $post && $post->post_type == 'apartment') {
        wp_enqueue_media();
        wp_add_inline_script('jquery', '
            jQuery(document).ready(function($) {
                var frame;
                $("#upload_gallery_button").on("click", function(e) {
                    e.preventDefault();
                    if (frame) {
                        frame.open();
                        return;
                    }
                    frame = wp.media({
                        title: "Выберите изображения для галереи",
                        button: { text: "Добавить в галерею" },
                        multiple: true
                    });
                    frame.on("select", function() {
                        var selection = frame.state().get("selection");
                        var ids = [];
                        $("#apartment-gallery-container .gallery-image").each(function() {
                            ids.push($(this).data("id"));
                        });
                        selection.map(function(attachment) {
                            attachment = attachment.toJSON();
                            if (ids.indexOf(attachment.id) === -1) {
                                ids.push(attachment.id);
                                var imgHtml = \'<div class="gallery-image" data-id="\' + attachment.id + \'" style="display:inline-block; margin:5px; position:relative;">\' +
                                    \'<img src="\' + attachment.url + \'" style="width:100px; height:100px; object-fit:cover;">\' +
                                    \'<button type="button" class="remove-image" data-id="\' + attachment.id + \'" style="position:absolute; top:-8px; right:-8px; background:red; color:white; border:none; border-radius:50%; cursor:pointer;">&times;</button>\' +
                                    \'</div>\';
                                $("#apartment-gallery-container").append(imgHtml);
                            }
                        });
                        $("#apartment_gallery").val(ids.join(","));
                    });
                    frame.open();
                });
                $(document).on("click", ".remove-image", function() {
                    var id = $(this).data("id");
                    var ids = $("#apartment_gallery").val().split(",");
                    var newIds = [];
                    for (var i = 0; i < ids.length; i++) {
                        if (ids[i] != id) newIds.push(ids[i]);
                    }
                    $("#apartment_gallery").val(newIds.join(","));
                    $(this).parent().remove();
                });
            });
        ');
        wp_add_inline_style('wp-admin', '
            .gallery-image { position: relative; }
            .gallery-image button.remove-image { display: none; }
            .gallery-image:hover button.remove-image { display: block; }
        ');
    }
}
add_action('admin_enqueue_scripts', 'apartment_admin_scripts');