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
    <div class="row ml-0 mr-0">
        <div class="col-md-8 pl-0 pr-0">
            <div class="alert alert-info">
                这是本博客系列文章的导航
            </div>
            <?php $series_step = 1; ?>
            <?php while ($series->next()): ?>
                <?php $series_posts = $meta_series->midSeriesPosts($series->mid);?>
                <?php if ($series_posts): ?>
            <article class="clearfix mb-4">
                    <h3 class="title"><?php _e($series_step . '. ' . $series->name); $series_step++;?></h3>
                    <div class="list-group">
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
                        <a href="<?php _e($post['permalink']); ?>" class="list-group-item list-group-item-action" target="_blank"><span class="series-a"><?php _e($post['title']); ?></span><span class="float-right"><?php _e(date('Y-m-d', $post['created'])); ?></span></a>
                        <?php endforeach;?>
                    </div>
            </article>
                <?php endif;?>
            <?php endwhile;?>
        </div>
        <div class="col-md-4">
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>

</div>
<?php $this->need('footer.php');
