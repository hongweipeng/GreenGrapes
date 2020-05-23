/**
 * author: hongweipeng
 */
(function($) {
    "use strict";

    let GIF = function() {
        this.gif_src = '';
        this.blob_src = '';
        this.loaded  = false;
        this.tip = $("<ins class='play-gif'>GIF</ins>");
    };

    $.fn.gif = function() {
        let obj = $(this);
        let src = obj.attr('src');
        let width = obj.width();
        let height = obj.height();
        let gif = new GIF();
        let img = new Image();
        img.setAttribute("crossOrigin",'Anonymous');
        gif.gif_src = img.src = src;
        img.onload = function () {
            var canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

            // 设置 gif 所需要的数据源
            gif.blob_src = canvas.toDataURL("image/gif");
            gif.gif_src = src;
            obj.attr('src', gif.blob_src);
            gif.tip.css({
                'top' : height / 2 - gif.tip.height() / 2,
                'left' : width / 2 - gif.tip.width() / 2,
            });
            gif.tip.click(function() {
                obj.trigger('click');
            });
            gif.tip.insertAfter(obj);

            canvas = null;  // 回收
            img = null;
        };

        obj.click(function () {
            gif.loaded = !gif.loaded;
            obj.attr('src', gif.loaded ? gif.gif_src : gif.blob_src);
            if (gif.loaded) {
                gif.tip.hide();
            } else {
                gif.tip.show();
            }
        });

    };
})(jQuery);