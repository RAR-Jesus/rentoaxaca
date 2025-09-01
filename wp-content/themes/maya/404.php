<?php
/**
 * The 404 template
 *
 * @package WordPress
 * @subpackage Maya
 *
 */

// Load Header
get_header();

?>

<div id="page" class="page">
        
    <div class="header-page marg-top-100 padd-y-75 bg-gr1-clr">
                
        <div class="title-page padd-x-25 fs-clr"><?php _e('Oops!.. Something went wrong', UN); ?></div>
          
    </div>  
    
    <div class="post-wrap padd-top-50 padd-bott-200 boxed">
               
        <article id="content-full">
        
            <div class="post-content padd-x-25">
            
 				<div class="contain padd-top-100" style="background-image: url('<?php echo UN_THEME_URI.'assets/img/404.png' ?>');">
     
                	<div class="icon-404 fs-clr marg-bott-50"><i class="icon-ban"></i></div>
                    
                    <h3 class="center"><?php _e('The page you are looking for could not be found.', UN); ?><h3>
                    <h4 class="center"><?php _e('Use the search field below to find the right road.', UN); ?></h4>
                                    
                    <div class="marg-50">
                        <form role="search" method="get" class="search-form" action="<?php echo site_url(); ?>">
                            <label>
                                <span class="screen-reader-text">Search for:</span>
                                <input type="search" class="search-field" placeholder="<?php _e('Search', UN); ?>" value="" name="s" title="Search for:">
                            </label>
                        </form>
                    </div>
                
                </div>                
                
            </div>
            
        </article>
        
        <div class="clear"></div>
                                            
    </div>
          
</div>

<?php

// Load Footer
get_footer();