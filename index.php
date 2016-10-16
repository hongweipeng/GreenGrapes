<?php
/**
 * 绿葡萄的主题
 *
 * @package GreenGrapes
 * @author hongweipeng
 * @version 0.0.1
 * @link https://github.com/hongweipeng/GreenGrapes
 */
$this->need('header.php');
?>

<div id="m-container" class="container">
    <div class="col-md-8">
        <div id="article-list">
            <?php while($this->next()): ?>
            <article class="post-article clearfix">
                <section class="">
                    <div class="category-cloud"><?php $this->category(''); ?></div>
                    <h3>
                        <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <?php $this->content(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="pull-right post-info">
                        <span><i class="fa fa-calendar"></i> 03月29日, 2015</span>
                        <span><i class="fa fa-user"></i> <a href="http://www.linuxhot.com/author/admin" title="由admin发布" rel="author">admin</a></span>
                        <span><i class="fa fa-eye"></i> 652 views次</span>
                        <span><i class="fa fa-comment"></i> <a href="http://www.linuxhot.com/saltstack-runners.html#comments">0</a></span>
                    </div>
                </section>
            </article>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="col-md-4">
        <?php $this->need('sidebar.php'); ?>
    </div>

</div>












<?php $this->need('footer.php');
