jQuery(function($){
	
	$(window).load(function() {
		
		var tpl_selected = $('#page_template').val();
		
		// TPL PAGE SECTIONS/HOME
		
		if(tpl_selected == 'page-sections.php' || tpl_selected == 'page-home.php'){
			
			$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
			$('#un_page_intro_section_meta_metabox').fadeIn(500);
			$('#un_page_other_section_meta_metabox').fadeIn(500);
			
		}
		
		$('#page_template').change(function() {
			
			tpl_selected = $('#page_template').val();
			
			if(tpl_selected == 'page-sections.php' || tpl_selected == 'page-home.php'){
			
				$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
				$('#un_page_intro_section_meta_metabox').fadeIn(500);
				$('#un_page_other_section_meta_metabox').fadeIn(500);
			
			}	
			
		});
		
		
		// TPL PAGE CONTACT
		
		if(tpl_selected === 'page-contact.php'){
			
			$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
			$('#un_post_page_meta_metabox').fadeIn(500);
			$('#un_page_contact_meta_metabox').fadeIn(500);
			
		}
		
		$('#page_template').change(function() {
			
			tpl_selected = $('#page_template').val();
			
			if(tpl_selected === 'page-contact.php'){
			
				$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
				$('#un_post_page_meta_metabox').fadeIn(500);
				$('#un_page_contact_meta_metabox').fadeIn(500);
			
			}	
			
		});
		
		
		// TPL PAGE PORTFOLIO
		
		if(tpl_selected === 'page-port1.php' || tpl_selected === 'page-port2.php' || tpl_selected === 'page-port3.php' || tpl_selected === 'page-port4.php'){
			
			$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
			$('#un_post_page_meta_metabox').fadeIn(500);
			$('#un_page_portfolio_meta_metabox').fadeIn(500);
			
		}
		
		$('#page_template').change(function() {
			
			tpl_selected = $('#page_template').val();
			
			if(tpl_selected === 'page-port1.php' || tpl_selected === 'page-port2.php' || tpl_selected === 'page-port3.php' || tpl_selected === 'page-port4.php'){
			
				$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
				$('#un_post_page_meta_metabox').fadeIn(500);
				$('#un_page_portfolio_meta_metabox').fadeIn(500);
			
			}	
			
		});
		
		
		// OTHER TPL
		
		if(tpl_selected != 'page-sections.php' && tpl_selected != 'page-contact.php' && tpl_selected != 'page-home.php' && tpl_selected != 'page-port1.php' && tpl_selected != 'page-port2.php' && tpl_selected != 'page-port3.php' && tpl_selected != 'page-port4.php'){
			
			$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
			$('#un_post_page_meta_metabox').fadeIn(500);
			
		}
		
		$('#page_template').change(function() {
			
			tpl_selected = $('#page_template').val();
			
			if(tpl_selected != 'page-contact.php' && tpl_selected != 'page-sections.php' && tpl_selected != 'page-home.php' && tpl_selected != 'page-port1.php' && tpl_selected != 'page-port2.php' && tpl_selected != 'page-port3.php' && tpl_selected != 'page-port4.php'){
			
				$('#un_post_page_meta_metabox, #un_page_intro_section_meta_metabox, #un_page_other_section_meta_metabox, #un_page_contact_meta_metabox, #un_page_portfolio_meta_metabox').hide();
				$('#un_post_page_meta_metabox').fadeIn(500);
			
			}	
			
		});
		
		
		
	});
});