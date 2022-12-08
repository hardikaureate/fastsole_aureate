// samehieght function
(function($) {
    "use strict";
    $.fn.sameHeight = function() {
        var selector = this;
        var heights = [];
        this.css("height", "auto");
        selector.each(function() {
            var height = $(this).height();
            heights.push(height);
        });
        var maxHeight = Math.max.apply(null, heights);
        selector.each(function() {
          $(this).height(maxHeight);
        });
    };

    $(window).on('load resize', function() {
        $('.deal-single').sameHeight();
        if(window.innerWidth < 990){
            $('.single-sneaker').sameHeight();
            $('.footer-menu .col-xs-6').sameHeight();
        }
    });
    $('#btnn').click(function(){
        if(window.innerWidth < 991){
            setTimeout(function(){
                $('.single-sneaker').sameHeight();
                $('.footer-menu .col-xs-6').sameHeight();
            }, 1000);
        }
    });
    
    setTimeout(function(){
        if( $('.fs_animation_down_arrow').length < 1 ){
            $('#btnn, #wpas-load-btn').append('&nbsp; <div class="fs_animation_down_arrow"><i class="fa fa-chevron-down"></i></div>');
        }
        
    }, 1000);
   
})(jQuery);

// $('.single-sneaker').sameHeight();




//Owl Carousel


jQuery(document).ready(function() {


    // add placeholder
    $('#daterangecheckid').attr('placeholder', 'Click to pick date');

    jQuery("#on-focus, .related-product, #coming-soon-carousel, #in-stock-carousel").owlCarousel({
        responsive:{
            0:{
                items:2 ,
            },
            480:{
                items:3, // from 480 to 677 
            },
            678:{
                items:3, 
            },
            960:{
                items:4,  
            },
            1200:{
                items:5,
            }
        },
        loop:true,
        margin:0,
        autoplay:false,
        autoplayTimeout:3000,
        stopOnHover:true,
        nav:true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'], 
        autoplayHoverPause:true,
        autoplaySpeed:1000,
        animateIn: 'fadeIn',

    });

    var releasesTabCarouselOptions = {
		responsive:{
			0:{
				items:1 
			},
			480:{
				items:1
			},
			768:{
				items: 1 
			},
			992:{
				items:4,  
			}
		},
		loop:true,
		margin:0,
		autoplay:true,
		autoplayTimeout:3000,
		stopOnHover:true,
		nav:true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'], 
		autoplayHoverPause:true,
		autoplaySpeed:1000
    };

	jQuery(".instock").owlCarousel(releasesTabCarouselOptions);
	jQuery(".coming-soon").owlCarousel(releasesTabCarouselOptions);
	jQuery(".this-week").owlCarousel(releasesTabCarouselOptions);
	jQuery(".best-seller").owlCarousel(releasesTabCarouselOptions);
	jQuery(".new-arrivals").owlCarousel(releasesTabCarouselOptions);


	var brandsTabCarouselOptions = {
		responsive:{
			0:{
				items:1 
			},
			480:{
				items:1,
			},
			768:{
				items:1, 
			},
			992:{
				items:4,
			}
		},
		loop:true,
		margin:0,
		autoplay:true,
		autoplayTimeout:3000,
		stopOnHover:true,
		nav:true,
		navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'], 
		autoplayHoverPause:true,
		autoplaySpeed:1000
    };

	jQuery(".nike").owlCarousel(brandsTabCarouselOptions);
	jQuery(".adidas").owlCarousel(brandsTabCarouselOptions);
	jQuery(".eqt").owlCarousel(brandsTabCarouselOptions),
	jQuery(".puma").owlCarousel(brandsTabCarouselOptions),
	jQuery(".yeezy").owlCarousel(brandsTabCarouselOptions);
	


    var relatedProductCarouselOptions = {
        responsive:{
            0:{
                items:1 
            },
            480:{
                items:2,
            },
            768:{
                items:3, 
            },
            992:{
                items:4,
            }
        },
        loop:true,
        margin:0,
        autoplay:true,
        autoplayTimeout:3000,
        stopOnHover:true,
        nav:true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'], 
        autoplayHoverPause:true,
        autoplaySpeed:1000
    };

    jQuery(".related-product").owlCarousel(relatedProductCarouselOptions);

    jQuery(".release-sidebar-slider").owlCarousel({
        items:1,
        loop:true,
        margin:0,
        autoplay:true,
        autoplayTimeout:3000,
        stopOnHover:true,
        nav:false, 
        autoplayHoverPause:true,
        autoplaySpeed:1000,
    });

	//wow.js animation
	new WOW().init();


    //preloder
    jQuery(".fakeloader1").fakeLoader({
        timeToHide:1200,
        bgColor:"#fff",
        spinner:"spinner2"
    }); 
       
    // Stellar nav responsive menu
    jQuery('.stellarnav').stellarNav({
        theme: 'light'
    });

}),

 

//main slider

 jQuery(window).load(function() {
    jQuery('#slider').nivoSlider({
       effect: "random",
       pauseTime: 5e3,
     });
    
    jQuery('#release-slider').nivoSlider({
       effect: "random",
       pauseTime: 5e3,
     });
});




//Responsive nav tabs
jQuery(document).ready(function() {

    // DEPENDENCY: https://github.com/flatlogic/bootstrap-tabcollapse


    // if the tabs are in a narrow column in a larger viewport
    jQuery('.brands-sidebar-tabs').tabCollapse({
        tabsClass: 'visible-tabs',
        accordionClass: 'hidden-tabs'
    });
    jQuery('.releases-sidebar-tabs').tabCollapse({
        tabsClass: 'visible-tabs',
        accordionClass: 'hidden-tabs'
    });

    // if the tabs are in wide columns on larger viewports
    // jQuery('.content-tabs').tabCollapse();

    // initialize tab function
    jQuery('.nav-tabs a').click(function(e) {
        e.preventDefault();
        jQuery(this).tab('show');
    });

    // slide to top of panel-group accordion
    jQuery('.panel-group').on('shown.bs.collapse', function() {
		var panel = jQuery(this).find('.in');
        jQuery('html, body').animate({
            scrollTop: panel.offset().top + (-60)
        }, 500);
    });

    /**
     * Fix two accoudion collapsed at a time issue
     */
	jQuery(document).on('click', '.js-tabcollapse-panel-heading', function(event){
		jQuery(this).parents('.panel').siblings().each(function(index, accorTab){
			jQuery(accorTab).find('a.js-tabcollapse-panel-heading').addClass('collapsed');
			jQuery(accorTab).find('.panel-collapse').removeClass('in');
		});
	}); // 

});
   

/*
|--------------------------------
| Sourov Scripts
|--------------------------------
*/
jQuery(document).ready(function(jQuery){

    $('.has-sub').on('mouseenter', function(){
        $('.header-section').next('div').addClass('is-dropdown-opened');
    });
    $('.has-sub').on('mouseout', function(){
        $('.header-section').next('div').removeClass('is-dropdown-opened');
    });

    $('#wpas-tax_department').hide();

    /*if( $('.content-tag').length > 0 ){
        var currentTags = $('.content-tag').find('p').text().split('Tags:').join();
        $('.content-tag').find('p').append()
    }   */

    // custom excerpt for mobile
    // custom excerpt
    var customExcerpt = function (selector, showChar, ellipsesText, moreLabel, lessLabel) {
        $(selector).each(function () {
            var content = $(this).html();
            if (content.length > showChar) {
                var show_string = content.substr(0, showChar),
                    hidden_string = content.substr(showChar, content.length - showChar),
                    html = show_string + '<span class="more_ellipses">' + ellipsesText + '&nbsp;</span><span class="more_content"><span>' + hidden_string + '</span>&nbsp;&nbsp;<a href="#" class="more_link">' + moreLabel + '</a></span>';
                $(this).html(html);
            }
        });
        $('.more_content span').hide();
        $(".more_link").click(function (e) {
            e.preventDefault();
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moreLabel);
            } else {
                $(this).addClass("less");
                $(this).html(lessLabel);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
        });
    }

    if( window.innerWidth < 768 ){
        (function($){
            $('.long-text').hide();
            $('.short-text .read-more-btn').append(' &raquo;');
            $('.short-text .read-more-btn').click(function(e){
                e.preventDefault();
                $('.long-text').toggle();
                $('.short-text').toggle();
            });
            $('.long-text .read-less-btn').click(function(e){
                e.preventDefault();
                $('.long-text').toggle();
                $('.short-text').toggle();
                window.scrollTo(0, $('.product-details').offset().top - 180);
            });
        })(jQuery)
        // customExcerpt('.product-details', 90, "...", "&rarr; More", "Less &larr;");
    }



    /**
     * Sticky sneaker stocklist
     */

     $.fn.isInViewport = function() {
        let elementTop = $(this).offset().top,
            elementBottom = elementTop + $(this).outerHeight(),
            viewportTop = $(window).scrollTop(),
            viewportBottom = (viewportTop + $('#sneaker-main-info').height() + 40);
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    // $('.stockist-items').css({
    //     maxHeight: $(window).height() - 80,

    // });

    var stickyStocklist = function(){
        let stocklistOffset = $('.stockist').offset().top,
            stickyHeaderHeight = $('#sticky-header').height(),
            winHeight = $(window).height(),
            sneakerContainer = $('#product_side_affix'),
            sneakerElement = $('#sneaker-main-info'),
            stocklistHeight = $('.stockist').height(),
            relatedProductOffset = $('.related-product-slider').offset().top;

        if( window.innerWidth >= 991 && $('.stockist').height() > sneakerElement.height() ){
            if( $(window).scrollTop() >= stocklistOffset - stickyHeaderHeight && $(window).scrollTop() < $('#sneaker-description').offset().top && $('#sneaker-description').isInViewport() == false ){
                sneakerElement.addClass('affix');
                sneakerElement.css({
                    width: sneakerContainer.width(),
                });
            }else if( $('#sneaker-description').isInViewport() ){
                sneakerElement.removeClass('affix');
                sneakerElement.css({
                    position: 'relative',
                    top: ( $('.stockist').height() - $('#sneaker-main-info').height() ) + 20,
                });
            }else {
                sneakerElement.removeClass('affix');
                sneakerElement.css({
                    width: 'auto',
                    top: 'initial',
                    position: 'static'

                });
            }
        }
    }
        
    $(window).on('load scroll', function(){
        if( $('.stockist').length > 0 ){
            stickyStocklist();
        }
    })


    /**
     * Sticky menu
     */
    jQuery("#sticky-header").sticky({topSpacing:0});

    /**
     * Left Side Nav
     */
    jQuery('.open-left-menu').click(function(){
        jQuery('body').addClass('leftmenu-opened');
    });

    /**
     * Right Side Nav
     */
    jQuery('.open-right-menu').click(function(){
        jQuery('body').addClass('rightmenu-opened');
    });

    /**
     * Remove side menu
     */
    jQuery('.content-wrapper-overlay').click(function(){
    	jQuery('body').removeClass('leftmenu-opened');
    	jQuery('body').removeClass('rightmenu-opened');
    });
    jQuery('.left-side-menu .close-sidenav').click(function(){
    	jQuery('body').removeClass('leftmenu-opened');
    });
    jQuery('.right-side-menu .close-sidenav').click(function(){
    	jQuery('body').removeClass('rightmenu-opened');
    });

    /**
     * Handle submenu of sidenav
     */
    var allMenus = jQuery('ul.sidenav-menu li');
	allMenus.each(function(){
	    if(jQuery('ul',this).length){
	        jQuery(this).addClass('has-submenu');
	    }
	})
    
    /*jQuery('ul.sidenav-menu li.has-submenu').click(function(){
    	var clickedLi = jQuery(this);
    	clickedLi.children('ul').slideToggle(500);
    	setTimeout(function(){
    		clickedLi.toggleClass('opened');
    	}, 400);
    });*/

    jQuery('.sub-menu').hide();
    jQuery('ul.sidenav-menu li.has-submenu > a').click(function(e){
        var self = this;
        e.preventDefault();
        $(self).next('ul').slideToggle(500);
        setTimeout(function(){
            $(self).parent().toggleClass('opened');
        }, 100);
    });

    var snsLength = jQuery('.mobile_social_icons ul li').length;
    jQuery('.mobile_social_icons ul li').css('width', (100 / snsLength) + '%');

    /**
     * Toggle search box in mobile
    
    jQuery('.xs-search-icon').click(function(){
    	jQuery(this).siblings('.navbar-form').slideToggle();
    	jQuery(this).toggleClass('sboxopened');
    });
     */
	
}); // Document ready

jQuery('.totop').tottTop({
    duration: 400,
    scrtollTopBtnDuration: 400,


});


$('.armore').readmore({
    collapsedHeight: (window.innerWidth > 991 ? 130 : 155),
    speed: 75,
    moreLink: '<div class="btn-readmore"><a href="#">Read more</a></div>',
    lessLink: '<div class="btn-readmore"><a href="#">Read less</a><div class="btn-readmore">'
});