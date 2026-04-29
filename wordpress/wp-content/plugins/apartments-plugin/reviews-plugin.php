<?php
/*
Plugin Name: Reviews Plugin
Description: Plugin for managing review users.
Version: 1.0
*/

// Register Custom Post Type
function custom_post_type_reviews()
{
    $labels = array(
        'name'                  => _x('reviews', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('review', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Отзывы', 'text_domain'),
        'name_admin_bar'        => __('Отзыв', 'text_domain'),
    );
    $args = array(
        'label'                 => __('review', 'text_domain'),
        'description'           => __('Plugin for reviews', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'), // поддержка миниатюры
        'public'                => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'reviews'),
    );
    register_post_type('review', $args);
}
add_action('init', 'custom_post_type_reviews', 0);

// Add meta box
function review_meta_box()
{
    add_meta_box(
        'review_fields',
        'Информация по отзывам',
        'review_fields_html',
        'review',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'review_meta_box');

// Meta box HTML (включая галерею)

function review_fields_html($post)
{
    wp_nonce_field('save_review_data', 'review_nonce');


    $review_user_name = get_post_meta($post->ID, 'review_user-name', true);
    $rating = get_post_meta($post->ID, 'review_rating', true);
    $comment = get_post_meta($post->ID, 'review_comment', true);

    $image_id = get_post_meta($post->ID, 'review_user_image', true);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';
?>

    <div>
        <label>Фото пользователя:</label><br>
        <img id="preview-image" src="<?php echo $image_url; ?>" style="max-width:100px;"><br>
        <input type="hidden" name="review_user_image" id="review_user_image" value="<?php echo $image_id; ?>">
        <button type="button" class="upload_image_button">Загрузить</button>
    </div>

    <div>
        <label style="font-size: 16px; font-style:italic">Имя и фамилия пользователя</label><br>
        <textarea name="review_user-name"><?php echo esc_textarea($review_user_name); ?></textarea>
    </div>

    <div> <label style="font-size: 16px; font-style:italic">Оценка пользователя</label><br>
        <?php for ($i = 1; $i <= 5; $i++) : ?>

            <p><input type="radio" name="review_rating" value="<?php echo $i; ?>" <?php checked($rating, $i); ?>>
                <?php echo $i; ?>⭐️</p>
        <?php endfor; ?>
    </div>

    <div>
        <label style="font-size: 16px; font-style:italic">Комментарий отзыва</label><br>
        <textarea name="review_comment" rows="4" cols="200"><?php echo esc_textarea($comment); ?></textarea>
    </div>
    <br>



<?php
}

function save_review_data($post_id)
{

    if (isset($_POST['review_user_image'])) {
    update_post_meta($post_id, 'review_user_image', $_POST['review_user_image']);
}

    if (!isset($_POST['review_nonce']) || !wp_verify_nonce($_POST['review_nonce'], 'save_review_data')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $text_fields = array('review_user-name', 'review_comment');
    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }

    if (isset($_POST['review_rating'])) {
        update_post_meta($post_id, 'review_rating', $_POST['review_rating']);
    }
}




add_action('save_post', 'save_review_data');


add_action('admin_footer', function () {
?>
<script>
jQuery(document).ready(function($) {

    let frame;

    $('.upload_image_button').on('click', function(e) {
        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Выбрать фото',
            button: { text: 'Использовать' },
            multiple: false
        });

        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();

            $('#review_user_image').val(attachment.id);
            $('#preview-image').attr('src', attachment.url);
        });

        frame.open();
    });

});
</script>
<?php
});