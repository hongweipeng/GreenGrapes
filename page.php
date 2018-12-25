<?php $this->need('header.php'); ?>
<div id="m-container" class="container">
    <div class="no-lr-padding col-md-8">
        <div id="article-list">
            <article class="post-article clearfix">
                <div>
                    <h2 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <p class="post-big-info">
                        <span class="label label-green"><i class="fa fa-fw fa-user"></i> <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                        <span class="label label-green"><i class="fa fa-fw fa-tags"></i> <?php $this->category(','); ?></span>
                        <span class="label label-green"><i class="fa fa-fw fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
                        <span class="label label-green"><i class="fa fa-fw fa-eye"></i> <?php $this->viewsNum(); ?> 次浏览</span>
                    </p>
                </div>
                <div class="article-content clearfix">
                    <?php $this->content(); ?>
                </div>
                <!-- 文章页下方自适应 -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-7489805328585400"
                     data-ad-slot="8761847611"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </article>
        </div>
        <?php $this->need('comments.php'); ?>
    </div>
    <div class="col-md-4">
        <?php $this->need('sidebar.php'); ?>
    </div>

</div>
<?php $this->need('footer.php');
