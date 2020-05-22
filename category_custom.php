<?php
/**
 * 分类导航
 *
 * @package custom
 */
$this->need('header.php');

?>
<div id="m-container" class="container">
    <div class="row ml-0 mr-0">
        <div class="col-md-8 pl-0 pr-0">
            <div class="alert alert-info">
                这是本博客分类文章的导航
            </div>
            <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
            <?php while($category->next()): ?>
            <article class="post-article clearfix">
                <h3 class="title series-title"><a <?php if($this->is('category', $category->slug)): ?> class="title series-title"<?php endif; ?> href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></h3>

                <?php
                $this->widget('Widget_Archive@index_'.$category->mid, 'pageSize=6&type=category', 'mid='.$category->mid)->parse('<li><a href="{permalink}">{title}</a></li>');
                ?>

            </article>
            <?php endwhile; ?>

        </div>
        <div class="col-md-4">
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>

</div>
<?php $this->need('footer.php');
