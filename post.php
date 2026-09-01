<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit(0);
$this->need('header.php');
?>
<?php
$hidden_sidebar =  !empty($this->options->ShowBlock) && in_array('HiddenSidebarInDetail', $this->options->ShowBlock, true);
// 内容只渲染一次: ArticleCatalog 处理标题锚点的同时统计字数, 供徽章展示
$content_html = ArticleCatalog::instance()->renderHtml($this->content);
$word_count = function_exists('mb_strlen') ? mb_strlen(strip_tags($content_html), 'UTF-8') : strlen(strip_tags($content_html)); // 中文按字符数统计
$reading_minutes = max(1, (int) ceil($word_count / 400)); // 按每分钟约 400 字估算
?>
<div id="m-container" class="container">
    <div class="row">
        <div class="col-md-<?php echo $hidden_sidebar? '12' : '8' ?>">
            <div id="article-list">
                <article class="post-article clearfix">
                    <div class="article-header">
                        <h2 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                        <p class="post-big-info">
                            <span class="badge badge-skin"><i class="fa fa-fw fa-user"></i> <a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
                            <span class="badge badge-skin"><i class="fa fa-fw fa-tags"></i> <?php $this->category(','); ?></span>
                            <span class="badge badge-skin"><i class="fa fa-fw fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
                            <span class="badge badge-skin"><i class="fa fa-fw fa-file-text-o"></i> <?php _e(number_format($word_count)); ?> 字</span>
                            <span class="badge badge-skin"><i class="fa fa-fw fa-hourglass-2"></i> 约 <?php _e($reading_minutes); ?> 分钟</span>
                            <?php if (class_exists('TeStat_Plugin') && isset($this->options->plugins['activated']['TeStat'])): ?>
                            <span class="badge badge-skin"><i class="fa fa-fw fa-eye"></i> <?php $this->viewsNum(); ?> 次浏览</span>
                            <span class="badge badge-skin"><i class="fa fa-fw fa-thumbs-o-up"></i> <span class="like-num-show"><?php $this->likesNum(); ?></span> 次点赞</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="article-content clearfix">
                        <?php echo $content_html; ?>
                    </div>
                    <?php if($this->allow('ping')): ?>
                        <div class="article-copyright">
                            <div class="article-license">
                                <img height="24" src="<?php $this->options->themeUrl('img/creative-commons-cc.png'); ?>" class="mb5" alt="知识共享署名声明"><br>
                                <div class="license-item">
                                    本文由 <a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a> 创作，采用 <a class="alert-link" target="_blank" href="https://creativecommons.org/licenses/by/3.0/cn">知识共享署名 3.0</a>，可自由转载、引用，但需署名作者且注明文章出处。
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(class_exists('Reward_Plugin') && isset($this->options->plugins['activated']['Reward'])): ?>
                        <?php
                        $extra_str = '';
                        if (class_exists('TeStat_Plugin') && isset($this->options->plugins['activated']['TeStat'])) {
                            $extra_str = '<button class="btn btn-info btn-like text-white" type="button" data-cid="' . $this->cid . '"><i class="fa fa-fw fa-thumbs-o-up"></i> 仅点赞 <span class="like-num-show">' . $this->likesNum . '</span></button>';
                        }
                        ?>
                        <?php Reward_Plugin::show_reward($extra_str); ?>
                        <?php Reward_Plugin::show_modal(); ?>
                    <?php endif; ?>
                </article>

            </div>
        <?php if (empty($this->options->ShowBlock) || !in_array('HiddenPostBottomBar', $this->options->ShowBlock, true)): ?>
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
        <div id="sidebar" class="col-md-4">
            <?php $this->need('sidebar-post-catalog.php'); ?>
        </div>
    <?php endif; ?>
    </div>
</div>
<?php $this->need('footer.php');
