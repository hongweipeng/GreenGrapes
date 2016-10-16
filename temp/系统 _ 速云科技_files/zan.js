/**
 * ZanBlog JavaScript File
 *
 * 为了提高用户使用ZanBlog时的用户体验。
 *
 * Author: 佚站互联（YEAHZAN）
 *
 * Site: http://www.yeahzan.com/
 */


jQuery(window).load(function() {
  zan.flexslider();
});

jQuery(function() {
	zan.init();
});

audiojs.events.ready(function() {
    var as = audiojs.createAll();
});

var zan = {

	//初始化函数
	init: function() {
		this.dropDown();
		this.setImgHeight();
    this.addAnimation();
    this.archivesNum();
    this.scrollTop();
    this.ajaxCommentsPage();
    this.ajaxCommentsReply();
    this.ajaxPage();
    this.postLike();
    this.lazyload();
    this.commentValidate();
    this.goTop();
	},

	goTop: function() {
		jQuery(window).scroll(function() {
			jQuery(this).scrollTop() > 200 ? jQuery("#zan-gotop").css({
				bottom: "110px"
			}) : jQuery("#zan-gotop").css({
				bottom: "-110px"
			});
		});

		jQuery("#zan-gotop").click(function() {
			return jQuery("body,html").animate({
				scrollTop: 0
			}, 800), !1
		});
	},

	// 设置导航栏子菜单下拉交互
	dropDown: function() {
		var dropDownLi = jQuery('.nav.navbar-nav li');

		dropDownLi.mouseover(function() {
			jQuery(this).addClass('open');
		}).mouseout(function() {
			jQuery(this).removeClass('open');
		});
	},

	// 等比例设置文章图片高度
	setImgHeight: function() {
		var relatedImg = jQuery("#post-related .post-related-img img"),
		  	thumbImg = jQuery("#article-list .zan-thumb img"),
				articleImg = jQuery(".zan-article img");

		eachHeight(relatedImg);
		eachHeight(thumbImg);
		eachHeight(articleImg);

		function  eachHeight(data) {
			data.each(function() {
				var $this 		 = jQuery(this),
						attrWidth  = $this.attr('width'),
						attrHeight = $this.attr('height'),
						width 		 = $this.width(),
						scale      = width / attrWidth,
						height     = scale * attrHeight;

				$this.css('height', height);

			});
		}
	},

  // 为指定元素添加动态样式
  addAnimation: function() {
    var animations = jQuery("[data-toggle='animation']");

    animations.each(function() {
      jQuery(this).addClass("animation", 2000);
    });
  },

	// 设置首页幻灯片
	flexslider: function() {
		jQuery('.flexslider').flexslider({
	    animation: "slide"
	  });
	},

	// 设置每月文章数量
	 archivesNum: function() {
		jQuery('#archives .panel-body').each(function() {
			var num = jQuery(this).find('p').size();
			var archiveA = jQuery(this).parent().siblings().find("a");
			var text = archiveA.text();

			archiveA.html(text + ' <small>(' + num + '篇文章)</small>');
		});
 	},

 	//头部固定
 	scrollTop: function() {
		//获取要定位元素距离浏览器顶部的距离 
		var navH = jQuery("#zan-nav").offset().top; 

		//滚动条事件 
		jQuery(window).scroll(function() { 
			//获取滚动条的滑动距离 
			var scroH = jQuery(this).scrollTop(); 

			//滚动条的滑动距离大于等于定位元素距离浏览器顶部的距离，就固定，反之就不固定 
			if( scroH >= navH ){ 
				jQuery("#zan-nav").addClass("navbar-fixed-top"); 
				jQuery("#zan-bodyer").addClass("margin-top");

			} else if( scroH < navH ) { 
				jQuery("#zan-nav").removeClass("navbar-fixed-top"); 
				jQuery("#zan-bodyer").removeClass("margin-top");
			} 

		}); 
	},

	// ajax评论分页
	ajaxCommentsPage: function() {
		var $ = jQuery.noConflict();

		$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');
		// 点击分页导航链接时触发分页
		$('#comment-nav a').live('click', function(e) {
		    e.preventDefault();
		    $.ajax({
		        type: "GET",
		        url: $(this).attr('href'),
		        beforeSend: function(){
		            $('#comment-nav').remove();
		            $('.commentlist').remove();
		            $('#loading-comments').slideDown();
		            $body.animate({scrollTop: $('#comments-title').offset().top - 65 }, 800 );
		        },
		        dataType: "html",
		        success: function(out){
		            result = $(out).find('.commentlist');
		            nextlink = $(out).find('#comment-nav');

		            $('#loading-comments').slideUp('fast');
		            $('#loading-comments').after(result.fadeIn(500));
		            $('.commentlist').after(nextlink);
		            zan.ajaxCommentsReply();
		        }
		    });
		    return false;
		});
	},

	// ajax评论回复
	ajaxCommentsReply :function() {
		var $ = jQuery.noConflict();

		var $commentform = $('#commentform'),
		    txt1 = '<div id="loading"><i class="fa fa-spinner fa-spin"></i> 正在提交, 请稍候...</div>',
		    txt2 = '<div id="error">#</div>',
				cancel_edit = '取消编辑',
				num = 1,
				$comments = $('#comments-title'),
				$cancel = $('#cancel-comment-reply-link'),
				cancel_text = $cancel.text(),
				$submit = $('#commentform #submit');

				$submit.attr('disabled', false),
				$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body'),
				comm_array = [];
				comm_array.push('');
				
        $('#comment').after(txt1 + txt2);
				$('#loading').hide();
				$('#error').hide();

		$(document).on("submit", "#commentform",
		  function() {
				$submit.attr('disabled', true).fadeTo('slow', 0.5);
				$('#loading').slideDown();

				$.ajax({
					url: $("#comments").attr("data-url"),
					data: $(this).serialize() + "&action=ajax_comment",
					type: $(this).attr('method'),
					error: function(request) {
						$('#loading').hide();
						$("#error").slideDown().html(request.responseText);
						setTimeout(function() {
							$submit.attr('disabled', false).fadeTo('slow', 1);
							$('#error').slideUp();
						},
						3000);
					},
					success: function(data) {
						$('#loading').hide();
						comm_array.push($('#comment').val());
						$('textarea').each(function() {
							this.value = ''
						});

						var t = addComment,
						cancel = t.I('cancel-comment-reply-link'),
						temp = t.I('wp-temp-form-div'),
						respond = t.I(t.respondId);
						post = t.I('comment_post_ID').value,
						parent = t.I('comment_parent').value;

						if ($comments.length) {
							n = parseInt($comments.text().match(/\d+/));
							$comments.text($comments.text().replace(n, n + 1));
						}

						new_htm = '" id="new-comm-' + num + '"></';
						new_htm = (parent == '0') ? ('\n<ol class="commentlist' + new_htm + 'ol>') : ('\n<ol class="children' + new_htm + 'ol>');
						div_ = (document.body.innerHTML.indexOf('div-comment-') == -1) ? '': ((document.body.innerHTML.indexOf('li-comment-') == -1) ? 'div-': '');
						
						$('#respond').before(new_htm);
						$('#new-comm-' + num).append(data);

						zan.lazyload();
						
						$body.animate({
							scrollTop: $('#new-comm-' + num).offset().top - 65
						}, 800);
						
						countdown();
						num++;
						cancel.style.display = 'none';
						cancel.onclick = null;
						t.I('comment_parent').value = '0';

						if (temp && respond) {
							temp.parentNode.insertBefore(respond, temp);
							temp.parentNode.removeChild(temp)
						}
					}
				});
				return false;
			}
		);
		addComment = {
			moveForm: function(commId, parentId, respondId, postId, num) {
				var t = this,
				div,
				comm = t.I(commId),
				respond = t.I(respondId),
				cancel = t.I('cancel-comment-reply-link'),
				parent = t.I('comment_parent'),
				post = t.I('comment_post_ID');

				num ? (
					t.I('comment').value = comm_array[num], 
					$new_sucs = $('#success_' + num), 
					$new_sucs.hide(), $new_comm = $('#new-comm-' + num), 
					$cancel.text(cancel_edit)
				) : $cancel.text(cancel_text);

				t.respondId = respondId;
				postId = postId || false;

				zan.lazyload();

				if (!t.I('wp-temp-form-div')) {
					div = document.createElement('div');
					div.id = 'wp-temp-form-div';
					div.style.display = 'none';
					respond.parentNode.insertBefore(div, respond)
				} 

				!comm ? (
					temp = t.I('wp-temp-form-div'), 
					t.I('comment_parent').value = '0', 
					temp.parentNode.insertBefore(respond, temp), 
					temp.parentNode.removeChild(temp)
				) : comm.parentNode.insertBefore(respond, comm.nextSibling);

				$body.animate( {
					scrollTop: $('#respond').offset().top - 200
				}, 400 );

				if (post && postId) post.value = postId;

				parent.value = parentId;
				cancel.style.display = '';

				cancel.onclick = function() {
					var t = addComment,
					temp = t.I('wp-temp-form-div'),
					respond = t.I(t.respondId);
					t.I('comment_parent').value = '0';

					if (temp && respond) {
						temp.parentNode.insertBefore(respond, temp);
						temp.parentNode.removeChild(temp);
					}
					this.style.display = 'none';
					this.onclick = null;
					return false;
				};

				try {
					t.I('comment').focus();
				}
				catch(e) {}
				return false;
			},

			I: function(e) {
				return document.getElementById(e);
			}
		};

		var wait = 10,
		submit_val = $submit.val();

		function countdown() {
			if (wait > 0) {
				$submit.val(wait);
				wait--;
				setTimeout(countdown, 1000);
			} else {
				$submit.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
				wait = 10;
			}
		};
	},

  // ajax分页
	ajaxPage: function() {
		var $ = jQuery.noConflict();
		$body=(window.opera)?(document.compatMode=="CSS1Compat"?$('html'):$('body')):$('html,body');

		$("#zan-page a").live("click", function() {
        $.ajax({
  				type: "POST",
          url: $(this).attr("href") + "#mainstay",
          beforeSend: function() {
          	$("#mainstay").addClass("load").prepend("<div id='loading-article'><i class='fa fa-spinner fa-spin'></i></div>");
        		$('#loading-article').slideDown();
            $body.animate( { scrollTop: $('#zan-header').offset().top }, 800 );
          },
          dataType: "html",
          success: function(data){
            result = $(data).find("#article-list");
            page = $(data).find("#zan-page");
            $('#mainstay').empty();

            $("#mainstay").append(result.fadeIn(300),page.fadeIn(300)).removeClass("load");
            zan.lazyload();
            zan.setImgHeight();
          }
        });
        return false;
    });
	},

	// 喜欢功能
  postLike: function() {
		var $ = jQuery.noConflict();
    
    jQuery(document).on("click", ".favorite",
		function() {
	  	if ($(this).hasClass('done')) {
		      return false;
	    } else {
	      $(this).addClass('done');
	      var id = $(this).data("id"),
	      action = $(this).data('action'),
	      url = $(this).data('url'),
	      rateHolder = $(this).children('.count');
	      var ajax_data = {
	        action: "zan_like",
	        um_id: id,
	        um_action: action
	      };
	      $.post(url, ajax_data,
	      	function(data) {
	          $(rateHolder).html(data);
	      });
	      return false;
	    }
	  });
	},

  // 延时加载图片功能
	lazyload: function() {
		jQuery("#sidebar img.lazy").lazyload({ threshold : 500});
		jQuery("#smilelink img.lazy").lazyload({ threshold : 500});
		jQuery("#mainstay img.lazy").lazyload({ effect : "fadeIn" ,threshold : 200,skip_invisible : false});
	},

	// 评论验证
	commentValidate: function() {
	  jQuery( '#commentform' ).validate( {
	    rules: {
	      author: {
	        required: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      url: {
	        url:true
	      },
	      comment: {
	        required: true
	      }
	    },
	    messages: {
	      author: {
	        required: "用户名不能为空！"
	      },
	      email: {
	        required: "邮箱不能为空！",
	        email: "邮箱格式不正确！"
	      },
	      url: {
	        url: "输入的网址不正确！"
	      },
	      comment: {
	        required: "留言内容不能为空！"
	      }
	    }
	  } );
	}
}