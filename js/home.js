(function ($) {
// 滚屏
$(document).ready(function($) {
    // 利用 data-scroll 属性，滚动到任意 dom 元素
    $.scrollto = function(scrolldom, scrolltime) {
        $(scrolldom).click( function(){
            var scrolltodom = $(this).attr("data-scroll");
            $(this).addClass("active").siblings().removeClass("active");
            $('html, body').animate({
                scrollTop: $(scrolltodom).offset().top
            }, scrolltime);
            return false;
        });
    };
    // 判断位置控制 返回顶部的显隐
    $(window).scroll(function() {
        if ($(window).scrollTop() > 500) {
            $("#back-to-top").fadeIn(600);
        } else {
            $("#back-to-top").fadeOut(600);
        }
    });
    $.scrollto("#back-to-top", 600);
});


function fssilde(){
	var mheader = document.getElementById( 'm-header' ),
		menuLeft = document.getElementById( 'm-nav' ),
		mcontainer = document.getElementById( 'm-container' ),
		mfooter = document.getElementById( 'm-footer' ),
		showLeftPush = document.getElementById( 'showLeftPush' );
	showLeftPush.onclick = function() {
		classie.toggle( mheader, 'm-header-open' );
		classie.toggle( menuLeft, 'm-nav-open' );
		classie.toggle( mcontainer, 'm-container-open' );
		classie.toggle( mfooter, 'm-footer-open' );
		disableOther( 'showLeftPush' );
	};
	function disableOther( button ) {
		if( button !== 'showLeftPush' ) {
			classie.toggle( showLeftPush, 'disabled' );
		}
			if( $('.m-container-open').length ){
		$(".container").click(function() {
			$( '#m-header' ).removeClass('m-header-open');
			$( '#m-nav' ).removeClass('m-nav-open');
			$( '#m-container' ).removeClass('m-container-open');
			$( '#m-footer' ).removeClass('m-footer-open');
		});
	}
	}

var eventClick = 'click';
var closeEnable = false;
	$('#search-trigger').bind(eventClick, function(event) {
		$('#search-form').addClass('active');
		closeEnable = false;
		setTimeout(function() {
			closeEnable = true;
		}, 500);
	});

	$('#search-input-s').bind('blur', function(event) {
		if ( closeEnable ) {
			$('#search-form').removeClass('active');
		}
	});

	$('#search-form-close').bind(eventClick, function(event) {
		event.preventDefault();
		if (closeEnable) {
			$('#search-form').removeClass('active');
			$('#search-input-s').blur();
			closeEnable = false;
		}
	});
}

$(document).ready(function () {
	// 分页
	$('.pagination a, .pagination span').addClass('page-link');
	$('form.protected').find('.text').addClass('form-control').end().find('.submit').addClass('btn btn-skin');

    if(!document.getElementById("sidebar")) {
    	return;
    }

	fssilde();

    // 若有显示标签云，设置动画
	if ( $("#mycanvas").length>0 ) {
		TagCanvas.Start('mycanvas', '', {
			textColour: '#000',
			//outlineColour: '#16a085',
			outlineColour: $('.skin-bg').css('background-color'),
			outlineThickness: 1,
			maxSpeed: 0.03,
			depth: 0.75,
			wheelZoom: false
		});
	}

	//边栏固定
	var $sidebar = $("#sidebar");
	// 最后一个 <aside> 添加固定，及前面添加 <div id="fixed"></div> 用于确定偏移
	var $fixside = $sidebar.find('aside').eq(-1);
	$fixside.addClass('fixsidebar').before('<div id="fixed"></div>');;
	var	$containner = $('#m-container'),
		$window = $(window),
		offset = $("#fixed").offset();
	if($window.width() > 768){
		$window.scroll(function() {
			if ($containner.height() - $sidebar.height() <= 40) {
				return;
			}
			if ($window.scrollTop() > offset.top) {
				var widths=$sidebar.width();
				$fixside.stop().animate({top:'20px'});
				$fixside.addClass('fix').css("width",widths);
			} else {
				$fixside.stop().animate({top:'1px'});
				$fixside.removeClass('fix');
			}
		});
	}

	// 归档页弹出框 hover 触发
	(function () {
		// 初始化弹出框
		$('[data-toggle="popover"]').popover();
		// 初始化提示框
		$('[data-toggle="tooltip"]').tooltip();
	})();
	
	// 切换主题
	$('#switch_color .flex-fill').click(function(e) {
	    var obj = $(this);
	    $.cookie('greengrapes_color', obj.data('color'));
	    location.reload();
    });
});
})(jQuery);
