<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style();

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/* 
  PHOTOGETHER
*/
function load_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Inconsolata:400,700');
}
add_action('wp_enqueue_scripts', 'load_fonts');

// Custom post types
function pg_create_posttypes() {
  register_post_type('exhibition',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Exhibitions' ),
        'singular_name' => __( 'Exhibition' )
      ),
      'public' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-screenoptions',
      'supports' => array('title', 'editor', 'thumbnail'),
      'has_archive' => true,
      'rewrite' => array('slug' => 'exhibition'),
    )
  );
  register_post_type('project',
  // CPT Options
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'project' )
      ),
      'public' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-format-gallery',
      'taxonomies' => array('student', 'graduate'),
      'supports' => array('title', 'editor', 'thumbnail'),
      'has_archive' => true,
      'rewrite' => array('slug' => 'project'),
    )
  );
}
function pg_create_taxonomies() {
  register_taxonomy('student', 'project', array(
    'labels' => array(
        'name' => __('Students'),
        'menu_name' => __('Students'),
        'add_new_item' => __('Add New Student')
      ),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'students')
  ));
  register_taxonomy('graduate', 'project', array(
    'labels' => array(
        'name' => __('Graduates'),
        'menu_name' => __('Graduates'),
        'add_new_item' => __('Add New Graduate')
      ),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'graduates')
  ));
}
function cleanse_rewrite() {
  flush_rewrite_rules();
}

// Hooking up our function to theme setup
add_action( 'init', 'pg_create_posttypes' );
add_action( 'init', 'pg_create_taxonomies' );
add_action( 'init', 'cleanse_rewrite' );

// Remove comments from sidebar
add_action('admin_menu', 'my_remove_menu_pages');
function my_remove_menu_pages() {
  remove_menu_page('edit-comments.php');
  remove_menu_page('edit.php?post_type=custom_type');
  remove_menu_page('themes.php');
  remove_menu_page('tools.php');
  remove_menu_page('plugins.php');
}

// Connect Simple Fields.
function pg_sf_connect($connector, $post) {
  if ( "contact" === $post->post_name ) {
    $connector = "sf_for_contact";
  }
  return $connector;
}
add_filter("simple_fields_get_selected_connector_for_post", "pg_sf_connect", 10, 2);

// Hide Simple Fields in Admin.
function pg_sf_hide($post) {
  return false;
}
add_filter("simple_fields_add_post_edit_side_field_settings", "pg_sf_hide", 10, 2);

// get taxonomies terms links
function list_custom_taxonomies() {
  // get post by post id
  $post = get_post( $post->ID );

  // get post type by post
  $post_type = $post->post_type;

  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = array();
  foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

    // get the terms related to post
    $terms = get_the_terms( $post->ID, $taxonomy_slug );

    if ( !empty( $terms ) ) {
      foreach ( $terms as $term ) {
        $out[] = $term->name;
      }
    }
  }

  return implode('', $out );
}

function mce_disable_buttons( $opt ) {
  $opt['block_formats'] = "Paragraph=p;Header 1=h1;Header 2=h2";
  $opt["toolbar1"] = "formatselect | bold italic bullist numlist | link unlink image | pastetext removeformat | preview fullscreen code";
  return $opt;
}
add_filter('tiny_mce_before_init', 'mce_disable_buttons');

/* DON'T DELETE THIS CLOSING TAG */ ?>
