$(document).ready(function () {
//+1
$.fn.postLike = function() {
    if ($(this).hasClass('done')) {
        return false;
    } else {
        $(this).addClass('done');
        var id = $(this).data("id"),
        action = $(this).data('action'),
        rateHolder = $(this).children('.count');
        var ajax_data = {
            action: "fashao_like",
            um_id: id,
            um_action: action
        };
        $.post(""+fashao.ajaxurl+"/wp-admin/admin-ajax.php", ajax_data,
        function(data) {
            $(rateHolder).html(data);
        });
        return false;
    }
}
$(document).on("click", ".favorite",function() {
    $(this).postLike();
	$('.c-like-text').html('已关注');
	$('.p-like-text').html('已喜欢');
})

	var settings = {//mp3
		progressbarWidth: '80%',
		progressbarHeight: '4px',
		progressbarColor: '#f2626f',
		progressbarBGColor: '#eeeeee',
		defaultVolume: 0.8
	};
	$(".player").player(settings);
	
});


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
	
/*!comment*/
jQuery(document).ready(function(a) {
	if (0 < a("#comment_form").length) {
		var l = [];
		a("#smilies a.smilie").each(function() {
			l.push(a(this).attr("data-surl"))
		});
		var t = a("#comment_form"),
			h = fashao.ajaxurl,
			u = h + "wp-admin/images/no.png",
			v = '<div id="loading"><img src="' + (h + "wp-admin/images/loading.gif") + '" style="vertical-align:-2px;" alt=""/> \u6b63\u5728\u63d0\u4ea4, \u8bf7\u7a0d\u5019...</div>',
			w = '"><img src="' + (h + "wp-admin/images/yes.png") + '" style="vertical-align:-2px;" alt=""/> \u63d0\u4ea4\u6210\u529f',
			i, f = 0,
			m = [],
			n = a("#cancel-comment-reply-link"),
			x = n.text(),
			e = a("#submit");
		e.attr("disabled", !1);
		$body = window.opera ? "CSS1Compat" == document.compatMode ? a("html") : a("body") : a("html,body");
		a("#author_error").append(v + '<div id="error"></div>');
		a("#loading, #error").hide();
		a(".commentlist").length || a(".comments-container").append('<ol class="commentlist"></ol>');
		t.submit(function() {
			a("#loading").slideDown();
			e.attr("disabled", !0).fadeTo("slow", 0.5);
			i && a("#comment").$ter('<input type="text" name="edit_id" id="edit_id" value="' + i + '" style="display:none;" />');
			var b = a("#comment").find("img");
			0 < b.length && b.each(function() {
				0 > a.inArray(a(this).attr("src"), l) && $(this).remove()
			});
			a("#comment").find("br").remove();
			a.ajax({
				url: h,
				data: a(this).serialize() + "&action=fsthemes_ajax_comment&comment=" + a("#comment").html(),
				type: a(this).attr("method"),
				error: function(b) {
					a("#loading").slideUp();
					a("#error").slideDown().html('<img src="' + u + '" style="vertical-align:-2px;" alt=""/> ' + b.responseText.replace(/<(?!p).*?>(?:.*?<\/.*?>)?/gi, "").replace(/<[^>].*?>/g, ""));
					setTimeout(function() {
						e.attr("disabled", !1).fadeTo("slow", 1);
						a("#error").slideUp()
					}, 3E3)
				},
				success: function(b) {
					a("#loading").hide();
					m.push(a("#comment").html());
					a("#comment").empty();
					var c = addComment,
						o = c.I("cancel-comment-reply-link"),
						g = c.I("wp-temp-form-div"),
						p = c.I(c.respondId);
					c.I("comment_post_ID");
					var e = c.I("comment_parent").value;
					new_htm = ' id="new_comm_' + f + '"></';
					new_htm = "0" == e ? '<div class="new-comment" ' + new_htm + 'div>' : '\n<ul class="children new-comment"' + new_htm + "ul>";
					ok_htm = '\n<span id="success_' + f + w;
					ok_htm += "</span><span></span>\n";
					"0" == e ? a(".commentlist").before(new_htm) : a("#respond").before(new_htm);
					a("#new_comm_" + f).hide().append(b);
					a("#new_comm_" + f + " li").append(ok_htm);
					a("#new_comm_" + f).show();
					a("#comments-number").text(parseInt(a("#comments-number").text()) + 1);
					$body.scrollTop(a("#new_comm_" + f).offset().top - 200);
					q();
					f++;
					i = "";
					a("*").remove("#edit_id");
					a("#comment").empty();
					o.style.display = "none";
					o.onclick = null;
					c.I("comment_parent").value = "0";
					g && p && (g.parentNode.insertBefore(p, g), g.parentNode.removeChild(g))
				}
			});
			return !1
		});
		addComment = {
			moveForm: function(b, d, c, e, g) {
				var b = this.I(b),
					f = this.I(c),
					h = this.I("cancel-comment-reply-link"),
					k = this.I("comment_parent"),
					j = this.I("comment_post_ID");
				i && r();
				0 < m.length && g ? (this.I("comment").value = m[g], i = this.I("new_comm_" + g).innerHTML.match(/(comment-)(\d+)/)[2], $new_sucs = a("#success_" + g), $new_sucs.hide(), $new_comm = a("#new_comm_" + g), $new_comm.hide(), n.text("\u53d6\u6d88\u7f16\u8f91")) : n.text(x);
				this.respondId = c;
				e = e || !1;
				this.I("wp-temp-form-div") || (c = document.createElement("div"), c.id = "wp-temp-form-div", c.style.display = "none", f.parentNode.insertBefore(c, f));
				!b ? (temp = this.I("wp-temp-form-div"), this.I("comment_parent").value = "0", temp.parentNode.insertBefore(f, temp), temp.parentNode.removeChild(temp)) : b.parentNode.insertBefore(f, b.nextSibling);
				$body.scrollTop(a("#respond").offset().top - 180);
				j && e && (j.value = e);
				k.value = d;
				h.style.display = "";
				h.onclick = function() {
					i && r();
					var a = addComment,
						b = a.I("wp-temp-form-div"),
						c = a.I(a.respondId);
					a.I("comment_parent").value = "0";
					b && c && (b.parentNode.insertBefore(c, b), b.parentNode.removeChild(b));
					this.style.display = "none";
					this.onclick = null;
					return !1
				};
				try {
					this.I("comment").focus()
				} catch (l) {}
				return !1
			},
			I: function(a) {
				return document.getElementById(a)
			}
		};
		var r = function() {
				$new_comm.show();
				$new_sucs.show();
				a("textarea").each(function() {
					this.value = ""
				});
				i = ""
			},
			k = 3,
			y = e.val(),
			q = function() {
				0 < k ? (e.val(k), k--, setTimeout(q, 1E3)) : (e.val(y).attr("disabled", !1).fadeTo("slow", 1), k = 3)
			}
	}
	var j = a(".comments-container"),
		z = fashao.postid,
		s = fashao.ajaxurl,
		A = '<div style="padding-bottom:20px;"><img src="' + s + 'wp-admin/images/loading.gif" style="vertical-align:-2px;">  \u6b63\u5728\u52a0\u8f7d\u4e2d, \u8bf7\u7a0d\u5019...</div>';
	j.on("click", ".comment-topnav a.page-numbers", function(b) {
		b.preventDefault();
		var b = a(this).attr("href"),
			d = 1;
		/comment-page-/i.test(b) ? d = b.split(/comment-page-/i)[1].split(/(\/|#|&).*$/)[0] : /cpage=/i.test(b) && (d = b.split(/cpage=/)[1].split(/(\/|#|&).*$/)[0]);
		a.ajax({
			url: s + "?action=fsthemes_ajax_pagenavi&post=" + z + "&page=" + d,
			beforeSend: function() {
				j.html(A)
			},
			error: function(a) {
				window.console && console.log(a.responseText)
			},
			success: function(b) {
				j.html(b);
				a("body, html").scrollTop(j.offset().top - 80)
			}
		})
	});
	a(".post-tabli").click(function() {
		var b = a(this);
		if (!b.hasClass("selected")) {
			var d = b.closest(".post-cardbox"),
				c = d.children(".post-tab").children(".post-tabul").children(".post-tabli"),
				d = d.children(".post-card").children(".post-cardul").children(".post-cardli"),
				e = c.index(b);
			c.removeClass("selected");
			b.addClass("selected");
			d.removeClass("selected");
			d.eq(e).addClass("selected")
		}
		return !1
	});
	var B = function(a) {
			a = a[0];
			a.focus();
			if ($.browser.msie) {
				var d = document.selection.createRange();
				this.last = d;
				d.moveToElementText(a);
				d.select();
				document.selection.empty()
			} else d = document.createRange(), d.selectNodeContents(a), d.collapse(!1), a = window.getSelection(), a.removeAllRanges(), a.addRange(d)
		};
	a("#smilies a.smilie").click(function() {
		var b = a(this).attr("data-surl");
		a("#comment").append('<img src="' + b + '" />');
		B(a("#comment"))
	});
	a(window).load(function() {
		a("#smilies a.smilie").each(function() {
			a(this).html('<img src="' + a(this).attr("data-surl") + '" />')
		})
	})
});
/*!jplayer*/
$(function(){
	var jpmp3url = $("#jp_container").attr('rel');
	$("#jquery_jplayer").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				mp3:jpmp3url
			}).jPlayer("play");
		},
		solution:"html, flash", 
		supplied: "mp3,wma,m4a",
		swfPath: "http://jplayer.org/latest/js",		
		wmode: "window",
		timeupdate: function(event) {
				if(event.jPlayer.status.currentTime==0){
					time = "";
				}else {
					time = event.jPlayer.status.currentTime;
				}
				$( '.jp_control' ).each(function(){
					if($(this).attr('rel') == 1){
						$( '#jquery_jplayer' ).jPlayer('play');
					}
				})
				$( '.jp-pause' ).click(function(){
					$( '.jp_control' ).attr('rel','0')
				})
			},
			play: function(event) {
				if(event.jPlayer.status.currentTime==0){
					$("#jquery_jplayer").jPlayer("pause",1);
				}
				
				if($('#lrc_content').val()!==""){
				$.lrc.start($('#lrc_content').val(), function() {
					return time;
				});
				}
				$( '#pic' ).addClass('rotate');
			},
			pause: function(event) {
				$( '#pic' ).removeClass('rotate');
			},
			ended: function (event) {
				$(this).jPlayer("play");
				$( '#pic' ).removeClass('rotate');
			}
	});
})

if( $('#pagination').length ){
	//  分页功能（异步加载）
	$("#pagination a").on("click",function(){
        $(this).addClass("loading").text("文章列表加载中...");
        $.ajax({
    type: "POST",
            url: $(this).attr("href") + "#thumbs",
            success: function(data){
                result = $(data).find("#thumbs .post");
                nextHref = $(data).find("#pagination a").attr("href");
                // 渐显新内容
                $("#thumbs").append(result.fadeIn(300));
                $("#pagination a").removeClass("loading").text("点击加载更多");
                if ( nextHref != undefined ) {
                    $("#pagination a").attr("href", nextHref);
                } else {
                // 若没有链接，即为最后一页，则移除导航
                    $("#pagination").remove();
                }
            }
        });
        return false;
    });
}

/* 
 * baidushare
 * ====================================================
*/
if( $('.bdsharebuttonbox').length ){

    if ($('.single-content').length) $('.single-content img').data('tag', 'bdshare')

    window._bd_share_config = {
        common: {
            "bdText": '',
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": '',
            "bdStyle": "0",
            "bdSize": "24"
        },
        share: [{
            // "bdSize": 12,
            bdCustomStyle: fashao.url + '/css/share.css'
        }]
    }

    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
}

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
	fssilde();
});