<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit(0);
$this->need('header.php');
?>

    <div id="m-container" class="container pl-0 pr-0">
        <div class="error-page">
            <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>
            <p><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></p>
            <form method="post">
                <p>
                    <label>
                        <input type="text" name="s" class="text" autofocus />
                    </label>
                </p>
                <p><button type="submit" class="submit btn btn-skin"><?php _e('搜索'); ?></button></p>
            </form>
        </div>

    </div><!-- end #content-->
<?php $this->need('footer.php'); ?>