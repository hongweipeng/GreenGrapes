<?php
/**
 * 系列文章
 *
 * @package custom
 */
$this->need('MetasSeries.php');
$this->need('header.php');
$meta_series = Typecho_Widget::widget('MetasSeries');
$meta_series->to($series);
?>
    <div id="m-container" class="container">
        <div class="col-md-8">
            <div class="alert alert-info">
                <p>这是本博客系列文章的导航</p>
            </div>
            <?php while ($series->next()): ?>
                <?php $series_posts = $meta_series->midSeriesPosts($series->mid);?>
                <?php if ($series_posts): ?>
            <article class="post-article clearfix">
                    <h3 class="title"><?php _e($series->name);?></h3>
                    <ul>
                    <?php foreach ($series_posts as $post): ?>
                        <?php
                        /**
                         * 转成链接
                         */
                        $type = $post['type'];
                        $routeExists = (NULL != Typecho_Router::get($type));

                        $tmpSlug = $post['slug'];
                        //$tmpCategory = $post['category'];
                       // $tmpDirectory = $post['directory'];
                        $post['slug'] = urlencode($post['slug']);
                        //$post['category'] = urlencode($post['category']);
                        //$post['directory'] = implode('/', array_map('urlencode', $post['directory']));
                        /** 生成静态路径 */
                        $post['pathinfo'] = $routeExists ? Typecho_Router::url($type, $post) : '#';
                        /** 生成静态链接 */
                        $post['permalink'] = Typecho_Common::url($post['pathinfo'], $this->options->index);
                        ?>
                        <li><a href="<?php _e($post['permalink']); ?>" class="series-a" target="_blank"><?php _e($post['title']); ?></a></li>

                        <?php endforeach;?>
                    </ul>
            </article>
                <?php endif;?>
            <?php endwhile;?>
        </div>
        <div class="col-md-4">
            <?php $this->need('sidebar.php'); ?>
        </div>

    </div>
<?php $this->need('footer.php');
