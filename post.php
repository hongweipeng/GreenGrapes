<?php $this->need('header.php'); ?>
<?php
$hidden_sidebar =  !empty($this->options->ShowBlock) && in_array('SidebarHiddenInDetail', $this->options->ShowBlock);
?>
<div id="m-container" class="container">
    <div class="no-lr-padding col-md-<?php echo $hidden_sidebar? '12' : '8' ?>">
        <div id="article-list">
            <article class="post-article clearfix">
                <div>
                    <h2 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                    <p class="post-big-info">
                        <span class="label label-green"><i class="fa fa-fw fa-user"></i> <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                        <span class="label label-green"><i class="fa fa-fw fa-tags"></i> <?php $this->category(','); ?></span>
                        <span class="label label-green"><i class="fa fa-fw fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
                        <span class="label label-green"><i class="fa fa-fw fa-eye"></i> <?php $this->viewsNum(); ?> 次浏览</span>
                        <span class="label label-green"><i class="fa fa-fw fa-thumbs-o-up"></i> <span class="like-num-show"><?php $this->likesNum(); ?></span> 次点赞</span>

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
                <?php if($this->allow('ping')): ?>
                    <div class="article-copyright">
                        <div class="article-license">
                            <img height="24" src="<?php $this->options->themeUrl('img/creativecommons-cc.png'); ?>" class="mb5"><br>
                            <div class="license-item text-muted">
                                本文由 <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> 创作，采用 <a class="alert-link" target="_blank" href="http://creativecommons.org/licenses/by/3.0/cn">知识共享署名 3.0</a>，可自由转载、引用，但需署名作者且注明文章出处。
                            </div>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(class_exists('Reward_Plugin') && isset($this->options->plugins['activated']['Reward'])): ?>
                    <?php
                    $extra_str = '';
                    if (class_exists('TeStat_Plugin')) {
                        $extra_str = '<button class="btn btn-info btn-like" type="button" data-cid="' . $this->cid . '"><i class="fa fa-fw fa-thumbs-o-up"></i> 仅点赞 <span class="like-num-show">' . $this->likesNum . '</span></button>';
                    }
                    ?>
                    <?php Reward_Plugin::show_reward($extra_str); ?>
                    <?php Reward_Plugin::show_modal(); ?>
                <?php endif; ?>
            </article>

        </div>
        <?php
        /*
        <div style="margin: 10px 0 10px 0">
            <script type="text/javascript">
                document.write('<a style="display:none!important" id="tanx-a-mm_117570917_17204454_198760034"></a>');
                tanx_s = document.createElement("script");
                tanx_s.type = "text/javascript";
                tanx_s.charset = "gbk";
                tanx_s.id = "tanx-s-mm_117570917_17204454_198760034";
                tanx_s.async = true;
                tanx_s.src = "//p.tanx.com/ex?i=mm_117570917_17204454_198760034";
                tanx_h = document.getElementsByTagName("head")[0];
                if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
            </script>
        </div>*/
        ?>
    <?php if (!empty($this->options->ShowBlock) && in_array('ShowPostBottomBar', $this->options->ShowBlock)): ?>
        <div class="block">
            <ul class="post-near">
                <li>上一篇: <?php $this->thePrev('%s','没有了'); ?></li>
                <li>下一篇: <?php $this->theNext('%s','没有了'); ?></li>
            </ul>
        </div>
    <?php endif; ?>
        <?php $this->need('comments.php'); ?>

    </div>

<?php if (!$hidden_sidebar): ?>
    <div class="col-md-4">
        <?php $this->need('sidebar.php'); ?>
    </div>
<?php endif; ?>
</div>
<?php $this->need('footer.php');
