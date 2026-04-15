<?php
/*
Plugin Name: Apartments Plugin
Description: 
Version: 1.0
*/

// Register Custom Post Type
function custom_post_type()
{

	$labels = array(
		'name'                  => _x('apartment', 'Post Type General Name', 'text_domain'),
		'singular_name'         => _x('apartment', 'Post Type Singular Name', 'text_domain'),
		'menu_name'             => __('Квартиры', 'text_domain'),
		'name_admin_bar'        => __('Квартира', 'text_domain'),
	);
	$args = array(
		'label'                 => __('Apartment', 'text_domain'),
		'description'           => __('Plugin for apartments', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array('title', 'editor'),
		'public'                => true,
		'has_archive'           => true,
		'rewrite' => array('slug' => 'apartments'),
	);
	register_post_type('apartment', $args);
}
add_action('init', 'custom_post_type', 0);



function apartment_meta_box()
{
	add_meta_box(
		'apartment_fields',
		'Данные квартиры',
		'apartment_fields_html',
		'apartment'
	);
}
add_action('add_meta_boxes', 'apartment_meta_box');

function apartment_fields_html($post)
{
	$description = get_post_meta($post->ID, 'description', true);
	$square = get_post_meta($post->ID, 'square', true);
	$count = get_post_meta($post->ID, 'count', true);
	$rooms = get_post_meta($post->ID, 'rooms',	true);
	$floor = get_post_meta($post->ID, 'floor',	true);
	$address = get_post_meta($post->ID, 'address',	true);
	$tv = get_post_meta($post->ID, 'tv', true);
?>

	<div>
		<label style="font-size: 16px; font-style:italic">Описание квартиры</label><br>
		<input type="text" name="description" value="<?php echo $description; ?>" size="200">
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Площадь квартиры</label><br>
		<input type="text" name="square" value="<?php echo $square; ?>">
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Количество гостей</label><br>
		<input type="text" name="count" value="<?php echo $count; ?>">
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Количество комнат</label><br>
		<input type="text" name="rooms" value="<?php echo $rooms; ?>">
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Этаж</label><br>
		<input type="text" name="floor" value="<?php echo $floor; ?>">
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Адрес</label><br>
		<input type="text" name="address" value="<?php echo $address; ?>" size="100">
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Удобства: Видео/аудио</label><br>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Телевизор с плоским экраном</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Телевизор со Smart TV</p>
	</div>
	<br>

	<div>
		<label style="font-size: 16px; font-style:italic">Удобства: Ванная комната</label><br>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Ванна или душевая кабина</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Тапочки</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Унитаз</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Санузел</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Туалет</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Банные принадлежности</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Гигиенические средства</p>
		<p><input type="checkbox" name="tv" value="<?php echo $tv; ?>">Туалетные средства</p>
	</div>
	<br>

	 
	


<?php
}
add_action('save_post', 'save_apartment_data');

function save_apartment_data($post_id)
{
	if (isset($_POST['description'])) {
		update_post_meta($post_id, 'description', $_POST['description']);
	}

	if (isset($_POST['square'])) {
		update_post_meta($post_id, 'square', $_POST['square']);
	}

	if (isset($_POST['count'])) {
		update_post_meta($post_id, 'count', $_POST['count']);
	}

	if (isset($_POST['rooms'])) {
		update_post_meta($post_id, 'rooms', $_POST['rooms']);
	}

	if (isset($_POST['floor'])) {
		update_post_meta($post_id, 'floor', $_POST['floor']);
	}

	if (isset($_POST['address'])) {
		update_post_meta($post_id, 'address', $_POST['address']);
	}

	if (isset($_POST['tv'])) {
		update_post_meta($post_id, 'tv', $_POST['tv']);
	}
}
