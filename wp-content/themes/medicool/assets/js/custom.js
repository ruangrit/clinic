jQuery(document).ready(function($) {
    "use strict";
    $(".owl-slide-gallery.v1").each(function(){
        $(this).owlCarousel({
            navigation : true,
            items : 4,
            itemsDesktop : [1199,3],
            itemsDesktopSmall : [979,3]
        });
    });
    $(".owl-slide-gallery.v2").each(function(){
        $(this).owlCarousel({
            navigation : true,
            items : 5,
            itemsDesktop : [1199,4],
            itemsDesktopSmall : [979,3]
        });
    });
   /* $(".zoom.bravo_list_gallery").each(function(){
        $(this).fancybox();
    });*/
    $(".zoom.bravo_list_gallery").fancybox();

    $('.widget_categories').each(function(){
        $(this).addClass("categories");
        $(this).find("ul").addClass("notype category-nav");

    });
    $('.widget_tag_cloud').each(function(){

        $(this).find(".tagcloud").addClass("list-inline bullet-lists");
        $(this).find(".sidebar-heading").addClass("widget-title");

    });
    $('.comment-reply-link').each(function(){
        $(this).addClass("medical-button medical-button-xs");

    });
    $('.comment-form .submit-small').each(function(){
        $(this).addClass("medical-button");

    });



    $.each($(".st_google_map"),function(i,value){
        var address,icon,v,saturation,lightness,gamma,map_config;
        v=$(value);
        address= v.data('address');
        icon= v.data('marker');
        saturation=v.data('saturation');
        lightness=v.data('lightness');
        gamma=v.data('gamma');

        map_config={ map:{
            options:{
                styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}],
                zoom: v.data('zoom'),
                scrollwheel:false,
                draggable: true }
        }

        };

        if(v.data('type')==1)
        {
            map_config.marker={
                address:v.data('address')

            };
            map_config.map.address= v.data('address');
        }else
        {
            map_config.marker={
                latLng: [v.data('lat'), v.data('lng')]

            };
            map_config.map.options.center=[v.data('lat'), v.data('lng')];
        }
        map_config.marker.options={
            icon:icon
        };
        try
        {

            v.gmap3(map_config);

            var index= v.parents('.ui-tabs-panel').index();
            index--;
            var item_click=v.parents('.ui-tabs').children('.nav-tabs').find('li:eq('+index+')');
            console.log(item_click);
            if(item_click.length)
            {
                item_click.click(function(){
                    v.gmap3({trigger:"resize"});

                    v.gmap3('get').setCenter({
                        lat:parseFloat(v.data('lat')),
                        lng:parseFloat(v.data('lng'))
                    });
                });
            }

            var index2= $('.vc_tta-tabs-list');
            if(index2.length)
            {
                index2.click(function(){
                    setTimeout(function(){
                        console.log(index2);
                        v.gmap3({trigger:"resize"});
                        v.gmap3('get').setCenter({
                            lat:parseFloat(v.data('lat')),
                            lng:parseFloat(v.data('lng'))
                        });
                    },200)
                });
            }

            //$('.nav-tabs>li>a').click(function(){
            //    v.gmap3({trigger:"resize"});
            //});

            $(document).on('click','.nav-tabs>li>a',function(){
                $(window).trigger('resize');

                window.setTimeout(function(){
                    v.gmap3({trigger:"resize"});
                },500);
            });

        }catch(e){
            console.log(e);
        }

    });


    $('.btn_search_menu').click(function(){
        $(this).addClass('open');
        var container = $(this).closest('.nav-item');
        container.find('.hidden_menu_search').fadeIn(100);
    });

    var $check = false;
    $('.btn_search_menu').hover(function() {
        $check = false;
        $(this).addClass('open');
        var container = $(this).closest('.nav-item');
        container.find('.hidden_menu_search').fadeIn(100);
    }, function() {
        var container = $(this).closest('.nav-item');
        setTimeout(function(){
            if($check == false){
                container.find('.hidden_menu_search').fadeOut(100);
            }
        },200);
    });
    $('.hidden_menu_search').hover(function() {
        $check = true
    }, function() {
        $(this).fadeOut(100);
    });







    var $check = false;
    $('.btn_extra_menu').hover(function() {
        $check = false;
        $(this).addClass('open');
        var container = $(this).closest('.nav-item');
        container.addClass('open');;
    }, function() {
        var container = $(this).closest('.nav-item');
        container.removeClass('open');;
    });

});