<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/';
	$defaultLogo = $imagepath.'logo.png';

	$options = array();

	$options[] = array(
		'name' => __('General Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Main Header Logo', 'options_check'),
		'desc' => __('Upload logo here.', 'options_check'),
		'id' => 'main_logo',
		'std' => $defaultLogo,
		'type' => 'upload');

	$email_address = 'info@johnanderson.net';
	$options[] = array(
		'name' => __('Add Email Address', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'email_address',
		'std' => $email_address,
		'type' => 'text');

	$podcast_url = '#';
	$options[] = array(
		'name' => __('Podcast Url', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'podcast_url',
		'std' => $podcast_url,
		'type' => 'text');

    $email_url = '#';
	$options[] = array(
		'name' => __('Email Url', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'email_url',
		'std' => $email_url,
		'type' => 'text');


	$options[] = array(
		'name' => __('Social Media', 'options_check'),
		'type' => 'heading');

	$social_fb = 'https://www.facebook.com';
	$social_yt = 'https://www.youtube.com';
	$social_em = 'abc@gmail.com';
	$social_tw = 'https://www.twitter.com';

	$options[] = array(
		'name' => __('Facebook', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'social_fb',
		'std' => $social_fb,
		'type' => 'text');

	$options[] = array(
		'name' => __('YouTube', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'social_yt',
		'std' => $social_yt,
		'type' => 'text');

	$options[] = array(
		'name' => __('Email', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'social_em',
		'std' => $social_em,
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'social_tw',
		'std' => $social_tw,
		'type' => 'text');


function wpmark_change_theme_options_menu_name( $menu ) {
 
	$menu[ 'menu_title' ] = 'TF Options'; 
	$menu[ 'page_title' ] = 'Theme Options'; 
 	return $menu;
 
}
 
add_filter( 'optionsframework_menu', 'wpmark_change_theme_options_menu_name' );




	$options[] = array(
		'name' => __('About John', 'options_check'),
		'type' => 'heading');


    $about_ab = 'lorem ipsum doller sit amet';
	$about_tx = 'lorem ipsum doller sit amet';
	$about_link = '#';
	$about_image ="";
	$read_more_texts ="";
	$about_p_tx  ="";

    $options[] = array(
		'name' => __('about Image', 'options_check'),
		'desc' => __('Upload image here.', 'options_check'),
		'id' => 'about_image',
		'std' => $about_image,
		'type' => 'upload');

	$options[] = array(
		'name' => __('About heading', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'about_ab',
		'std' => $about_ab,
		'type' => 'text');

	$options[] = array(
		'name' => __('About Texts', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'about_tx',
		'std' => $about_tx,
		'type' => 'textarea');

	$options[] = array(
		'name' => __('About paragraph Texts', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'about_p_tx',
		'std' => $about_p_tx,
		'type' => 'text');

	$options[] = array(
		'name' => __('Read More Texts', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'read_more_texts',
		'std' => $read_more_texts,
		'type' => 'text');

	$options[] = array(
		'name' => __('Read More Link', 'options_check'),
		'desc' => __('', 'options_check'),
		'id' => 'about_link',
		'std' => $about_link,
		'type' => 'text');

	$options[] = array(
		'name' => __('Social Media Icons', 'options_check'),
		'type' => 'heading');

        $Facebook_icon = '#';
        
        $options[] = array(
		'name' => __('Facebook Url', 'options_check'),
		'desc' => __('Upload Facebook URL here.', 'options_check'),
		'id' => 'Facebook_icon',
		'std' => $Facebook_icon,
		'type' => 'upload');
		return $options;

}



