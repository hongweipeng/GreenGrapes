<?php if ($this->options->allow_user_change_color) : ?>
<div id="switch_color">
    <div class="colorful"></div>
    <div class="d-flex border border-light">
        <?php
            $current_color = get_theme_color();
            $theme_colors = get_theme_color_array();

        ?>
        <?php foreach ($theme_colors as $color=>$color_name) : ?>
        <div class="color-<?php _e($color)?> flex-fill m-1 <?php if($current_color === $color) _e('active'); ?>" data-color="<?php _e($color); ?>"><?php if($current_color === $color) : ?><i class="fa fa-fw fa-check"></i><?php endif; ?></div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<div id="back-to-top" class="red" title="返回顶部" data-scroll="body" style="display: none;">
    <svg id="point-up" version="1.1" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
        <path d="M23.588 17.637c-0.359-0.643-0.34-1.056-2.507-3.057 0.012-7.232-4.851-12.247-5.152-12.55 0-0.010 0-0.015 0-0.015s-0.003 0.003-0.007 0.007l-0.007-0.007c0 0 0 0.005 0 0.015-0.299 0.305-5.141 5.342-5.097 12.575-2.158 2.010-2.138 2.423-2.493 3.068-0.65 1.178-0.481 5.888 0.132 6.957 0.613 1.069 1.629 0.293 1.977-0.004 0.348-0.298 1.885-2.264 2.263-2.176 0 0 0.465-0.090 0.989 0.414 0.518 0.498 1.462 0.966 2.27 1.033 0 0.001 0 0.002-0 0.003 0.005-0.001 0.010-0.001 0.015-0.002 0.005 0 0.010 0.001 0.015 0.001 0-0.001-0-0.002 0-0.003 0.808-0.070 1.749-0.543 2.265-1.043 0.522-0.507 0.988-0.419 0.988-0.419 0.378-0.090 1.923 1.869 2.272 2.165 0.35 0.296 1.369 1.067 1.977-0.005 0.608-1.072 0.756-5.783 0.101-6.958v0 0zM15.95 14.86c-1.349 0.003-2.445-1.112-2.448-2.492-0.003-1.38 1.088-2.5 2.437-2.503 1.349-0.003 2.445 1.112 2.448 2.492 0.003 1.379-1.088 2.5-2.437 2.503v0 0zM17.76 24.876c-0.615 0.474-1.236 0.633-1.801 0.626-0.566 0.009-1.187-0.147-1.804-0.617-0.553-0.403-1.047-0.348-1.308 0.003-0.261 0.351-0.169 2.481 0.152 2.939 0.321 0.458 0.697-0.298 1.249-0.327 0.552-0.028 1.011 1.103 1.221 1.75 0.107 0.331 0.274 0.633 0.5 0.654 0.226-0.023 0.392-0.326 0.497-0.657 0.207-0.648 0.661-1.781 1.213-1.756 0.553 0.026 0.932 0.78 1.251 0.321 0.319-0.459 0.401-2.59 0.139-2.94-0.262-0.35-0.757-0.403-1.308 0.003v0 0z" fill="#CCCCCC"></path>
    </svg>
</div>
<footer id="m-footer">
    <div class="Copyright">
        <div>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
        <?php _e('All Rights Reserved. 版权所有.<br>'); auto_increase_index_show_count(); ?>
            <script type="text/javascript">var cnzz_protocol = (("https:" === document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1257015934'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1257015934%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
        </div>
        <div class="beian">
            <a href="http://www.beian.miit.gov.cn/" target="_blank" rel="noopener">闽ICP备15027255号-1</a>
            <img src="<?php $this->options->themeUrl('img/ghs.png'); ?>" style="display: inline-block;vertical-align: top;" alt="" />
        </div>
    </div>
</footer>

<script src="<?php $this->options->themeUrl('js/jquery.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/popper.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/bootstrap.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/jquery.cookie.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/functionall.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/tagcanvas.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/particles.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/headerCanvas.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/home.js'); ?>"></script>

<script>
    // 外链新窗口打开以及添加noopener
    jQuery('.article-content a').each(function() {
        if (this.hostname !== window.location.hostname) {
            jQuery(this).attr({
                target: '_blank',
                rel: 'noopener'
            });
        }
    });
</script>

<?php $this->footer(); ?>

<script id="cy_cmt_num" src="https://changyan.sohu.com/upload/plugins/plugins.list.count.js?clientId=cysUkopEY"></script>
<!--<script type="text/javascript" charset="utf-8" src="https://changyan.itc.cn/js/lib/jquery.js"></script>-->
<script type="text/javascript" charset="utf-8" src="https://changyan.sohu.com/js/changyan.labs.https.js?appid=cysUkopEY"></script>
<?php if($this->is('post') or $this->is('single')): ?>
    <!-- 畅言 start-->
    <script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
    <script type="text/javascript">
        window.changyan.api.config({
            appid: 'cysUkopEY',
            conf: 'prod_8f6d81c51c4b8363fb45c8879c0d9ca5'
        });
    </script>
    <!-- 畅言 end-->
<?php endif; ?>

</body>
</html>
