<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Canyon Themes
 * @subpackage Better Health
 */
$better_health_breadcrump_option = better_health_get_option('better_health_breadcrumb_setting_option');
$better_health_designlayout      = get_post_meta(get_the_ID(), 'better_health_sidebar_layout', true  );
$hide_top_title                  =   better_health_get_option( 'better_health_hide_top_title_single_option');
get_header();
?>
<section id="inner-title" class="inner-title"  <?php echo $header_style; ?>>
    <div class="container">
        <div class="row">
          <?php
              if( $hide_top_title == "hide-button-title")
              { ?>
                <div class="col-md-7">
                    <h2><?php the_title(); ?></h2>
                </div>
              
            <?php
             }
            if ($better_health_breadcrump_option == "enable") {
                ?>
                <div class="col-md-<?php if( $hide_top_title == "hide-top-tile")
              { echo "7"; } else { echo "5";} ?>">
                    <div class="breadcrumbs">
                        <?php breadcrumb_trail(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<section id="section14" class="section-margine blog-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-<?php if ($better_health_designlayout == 'no-sidebar') {
                echo "12";
            } else {
                echo "12";
            } ?> col-md-<?php if ($better_health_designlayout == 'no-sidebar') {
                echo "12";
            } else {
                echo "9";
            } ?> left-block">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', 'single');
                    the_post_navigation(array(
                        'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next', 'better-health') . '</span> ' .
                            '<span class="screen-reader-text">' . esc_html__('Next post:', 'better-health'),
                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Previous', 'better-health') . '</span> ' .
                            '<span class="screen-reader-text">' . esc_html__('Previous post:', 'better-health'),
                    ));
                    echo '<div class="comment-form-container wow fadeInLeft">';
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                    echo '</div>';
                endwhile; // End of the loop.
                ?>
            </div>
            <?php if ( $better_health_designlayout != 'no-sidebar') { ?>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php
get_footer(); ?>
