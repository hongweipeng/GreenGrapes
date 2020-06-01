<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit(0); ?><aside id="sidebar">
    <aside>
        <form method="get" id="searchform" class="form-inline clearfix" action="./">
            <input class="form-control" name="s" id="s" placeholder="搜索关键词..." type="text">
            <button class="btn btn-skin ml-1"><i class="fa fa-search"></i> 查找</button>
        </form>
    </aside>
    <aside>
        <div class="card widget-sets hidden-xs">
            <ul class="nav nav-pills">
                <li class=""><a class="nav-link active" href="#sidebar-new" data-toggle="tab">最新文章</a></li>
                <li class="ml-1"><a class="nav-link" href="#sidebar-comment" data-toggle="tab">最新评论</a></li>
                <li class="ml-1"><a class="nav-link" href="#sidebar-rand" data-toggle="tab">随机文章</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane nav bs-sidenav active in" id="sidebar-new">
                    <ul class="list-group">
                        <?php $this->widget('Widget_Contents_Post_Recent')
                            ->parse('<li class="list-group-item clearfix"><a href="{permalink}">{title}</a></li>'); ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="sidebar-comment">
                    <div id="cyReping" role="cylabs" data-use="reping"></div>
                </div>
                <div class="tab-pane nav bs-sidenav fade" id="sidebar-rand">
                    <?php theme_random_posts();?>
                </div>
            </div>
        </div>
    </aside>
    <aside>
        <div style="margin-bottom: 20px;">
            <!-- 侧边栏 -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-7489805328585400"
                 data-ad-slot="8357527080"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </aside>
    <?php if(class_exists('Links_Plugin') && isset($this->options->plugins['activated']['Links'])): ?>
    <aside>
        <div class="card card-skin hidden-xs">
            <div class="card-header"><i class="fa fa-link fa-fw"></i> 友情链接</div>
            <ul class="list-group">
                <?php Links_Plugin::output('<li class="list-group-item"><a href="{url}" target="_blank" rel="noopener noreferrer">{name}</a></li>', 10, NULL, true); ?>
            </ul>
        </div>
    </aside>
    <?php endif; ?>
    <?php if(!empty($this->options->ShowBlock) && in_array('ShowCategory', $this->options->ShowBlock)): ?>
    <aside>
        <div class="card card-skin hidden-xs">
            <div class="card-header"><i class="fa fa-book fa-fw"></i> 文章分类</div>
            <div class="list-group category">
                <ul class="widget-list">
                    <?php $this->widget('Widget_Metas_Category_List')->parse('<li><a href="{permalink}">{name} <span class="badge badge-secondary float-right">{count}</span></a></li>'); ?>
                </ul>
            </div>
        </div>
    </aside>
    <?php endif; ?>
    <?php if (!empty($this->options->ShowBlock) && in_array('ShowArchive', $this->options->ShowBlock)): ?>
    <aside>
        <div class="card card-skin hidden-xs">
            <div class="card-header"><i class="fa fa-book fa-fw"></i> <?php _e('归档'); ?></div>
            <div class="list-group category">
                <ul class="widget-list">
                    <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月')->parse('<li><a href="{permalink}">{date}<span class="badge badge-secondary float-right">{count}</span></a></li>'); ?>
                </ul>
            </div>
        </div>
    </aside>
    <?php endif; ?>
    <?php
    /*
    <aside>
        <div style="margin-bottom: 20px;">
            <script type="text/javascript">
                document.write('<a style="display:none!important" id="tanx-a-mm_117570917_17204454_198762180"></a>');
                tanx_s = document.createElement("script");
                tanx_s.type = "text/javascript";
                tanx_s.charset = "gbk";
                tanx_s.id = "tanx-s-mm_117570917_17204454_198762180";
                tanx_s.async = true;
                tanx_s.src = "//p.tanx.com/ex?i=mm_117570917_17204454_198762180";
                tanx_h = document.getElementsByTagName("head")[0];
                if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
            </script>
        </div>
    </aside>*/
    ?>
    <div id="fixed"></div>
    <aside class="fixsidebar">
        <div class="card card-skin hidden-xs">
            <div class="card-header"><i class="fa fa-tags fa-fw"></i> 标签云</div>
            <div id="meta-cloud">
            <canvas height="300" id="mycanvas" style="width: 100%">
                <p>标签云</p>
                <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
                <?php $this->widget('Widget_Metas_Tag_Cloud')->parse('<a href="{permalink}" class="tag">{name}</a>'); ?>
            </canvas>
            </div>
        </div>
    </aside>

</aside>
