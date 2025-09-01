<?php
/**
 * The template for displaying the footer
 *
 * Contains Maya footer
 *
 * @package WordPress
 * @subpackage Maya
 * 
 */
?>

<footer>
	
    <div class="footer-content">
    
    	<div class="footer-layer bg-nd-clr">
        
        	<div class="boxed">
    
                <div class="footer-icons">
                    <ul>
                    	
						<?php if(un_option('facebook')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('facebook'), false); ?>" target="_blank" data-curtain="false"><i class="icon-facebook"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('twitter')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('twitter'), false); ?>" target="_blank" data-curtain="false"><i class="icon-twitter"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('gplus')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('gplus'), false); ?>" target="_blank" data-curtain="false"><i class="icon-googleplus"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('flickr')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('flickr'), false); ?>" target="_blank" data-curtain="false"><i class="icon-flickr"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('pinterest')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('pinterest'), false); ?>" target="_blank" data-curtain="false"><i class="icon-pinterest"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('linkedin')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('linkedin'), false); ?>" target="_blank" data-curtain="false"><i class="icon-linkedin"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('tumblr')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('tumblr'), false); ?>" target="_blank" data-curtain="false"><i class="icon-tumblr"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('instagram')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('instagram'), false); ?>" target="_blank" data-curtain="false"><i class="icon-instagram"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('picasa')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('picasa'), false); ?>" target="_blank" data-curtain="false"><i class="icon-picasa"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('soundcloud')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('soundcloud'), false); ?>" target="_blank" data-curtain="false"><i class="icon-soundcloud"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('youtube')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('youtube'), false); ?>" target="_blank" data-curtain="false"><i class="un-social-youtube-1"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('vimeo')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('vimeo'), false); ?>" target="_blank" data-curtain="false"><i class="icon-vimeo"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('behance')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('behance'), false); ?>" target="_blank" data-curtain="false"><i class="icon-behance"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('github')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('github'), false); ?>" target="_blank" data-curtain="false"><i class="un-social-github"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('paypal')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('paypal'), false); ?>" target="_blank" data-curtain="false"><i class="un-social-paypal-1"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('yahoo')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('yahoo'), false); ?>" target="_blank" data-curtain="false"><i class="un-social-yahoo-1"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('codepen')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('codepen'), false); ?>" target="_blank" data-curtain="false"><i class="un-social-codepen"></i></a></li>
                        <?php } ?>
                        
                        <?php if(un_option('twitch')){ ?>
                       	 <li><a href="<?php echo un_kses(un_option('twitch'), false); ?>" target="_blank" data-curtain="false"><i class="un-social-twitch"></i></a></li>
                        <?php } ?>

                    </ul>
                </div>
        
                <div id="footer-copy" class="padd-x-25"><?php echo un_kses(un_option('copy'), true); ?></div>
                
                <div class="clear"></div>
            
            </div>
        
        </div>
        
    </div>
    
</footer>

<?php if(un_option('backtop') == 1){ ?>
<div class="btn-up brd-wh-clr bg-wh-clr fs-clr nd-clr-hov">        
	<i class="icon-arrow-up"></i>
</div>
<?php } ?>

<div id="curtain"></div>

<?php 
// Custom Code
$custom_footer_code =  un_kses(un_option('foot_code'), true);
if(!empty($custom_footer_code)) { echo $custom_footer_code; } 
?>

<?php wp_footer(); ?>

</body>

</html>
