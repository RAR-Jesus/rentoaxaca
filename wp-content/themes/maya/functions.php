<?php
/**
 * Maya Functions
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */


/* *************** */
/*   THEME INIT    */
/* *************** */


// Constants 
define( 'UN_THEME_URI', get_template_directory_uri().'/' );
define( 'UN_THEME_DIR', get_template_directory().'/' );
define( 'UN', 'uncommons' );

// Setup
require(UN_THEME_DIR.'inc/setup.php');

// Assets
require(UN_THEME_DIR.'inc/assets.php');

// Plugins
require(UN_THEME_DIR.'inc/plugins.php'); 

// Menus
require(UN_THEME_DIR.'inc/menus.php');

// Portfolio
require(UN_THEME_DIR.'inc/posttypes/un-portfolio.php');

// Sections
require(UN_THEME_DIR.'inc/posttypes/un-sections.php');

// Sidebars
require(UN_THEME_DIR.'inc/posttypes/un-sidebars.php');

// Functions
require(UN_THEME_DIR.'inc/theme-functions.php');

// Widgets
require(UN_THEME_DIR.'inc/widgets/widget-contacts.php');
require(UN_THEME_DIR.'inc/widgets/widget-facebook.php');
require(UN_THEME_DIR.'inc/widgets/widget-flickr.php');
require(UN_THEME_DIR.'inc/widgets/widget-mega-posts.php');
require(UN_THEME_DIR.'inc/widgets/widget-mega-projects.php');

// Init Framework
require(UN_THEME_DIR.'framework/bootstrap.php');

// Options
require(UN_THEME_DIR.'inc/options.php');

// Metaboxes
require(UN_THEME_DIR.'inc/metaboxes/post-page-proj.php');
require(UN_THEME_DIR.'inc/metaboxes/post-proj.php');
require(UN_THEME_DIR.'inc/metaboxes/sections.php');
require(UN_THEME_DIR.'inc/metaboxes/page-sections.php');
require(UN_THEME_DIR.'inc/metaboxes/page-contact.php');
require(UN_THEME_DIR.'inc/metaboxes/page-portfolio.php');
