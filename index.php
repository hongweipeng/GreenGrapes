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
    <?php $this->need('sidebar.php'); ?>
    <div id="content" class="clearfix">
        <section id="primary">
            <div class="main" id="thumbs">
                <?php while($this->next()): ?>
                <article class="post post-article type-post status-publish format-standard hentry category-uncategorized">
                        <h2 class="title"><a class="slow" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                        <div class="textfoot">
                            <span class="textfoot-category"><?php $this->category(','); ?></span>
                            <span class="post-time"><?php $this->date('Y-m-d'); ?></span>
                            <span class="post-time"><a class="article-author" itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                        </div>
                        <div class="text">
                            <?php $this->content(); ?>
                        </div>
                        <div class="btn-area clearfix">
                            <a class="btn-read-line" href="<?php $this->permalink() ?>">阅读全文</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </section>
    </div>
</div>












<?php $this->need('footer.php');
