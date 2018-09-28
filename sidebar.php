<aside id="sidebar">
    <aside>
        <form method="get" id="searchform" class="form-inline clearfix" action="./">
            <input class="form-control" name="s" id="s" placeholder="搜索关键词..." type="text">
            <button class="btn btn-green btn-small"><i class="fa fa-search"></i> 查找</button>
        </form>
    </aside>
    <aside>
        <div class="panel widget-sets hidden-xs">
            <ul class="nav nav-pills">
                <li class="active"><a href="#sidebar-new" data-toggle="tab">最新文章</a></li>
                <li class=""><a href="#sidebar-comment" data-toggle="tab">最新评论</a></li>
                <li class=""><a href="#sidebar-rand" data-toggle="tab">随机文章</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane nav bs-sidenav fade active in" id="sidebar-new">
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
    <?php if(class_exists('Links_Plugin') && isset($this->options->plugins['activated']['Links'])): ?>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-link fa-fw"></i> 友情链接</div>
            <ul class="list-group">
                <?php Links_Plugin::output('<li class="list-group-item"><a href="{url}" target="_blank" rel="noopener noreferrer">{name}</a></li>', 10, NULL, true); ?>
            </ul>
        </div>
    </aside>
    <?php endif; ?>
    <?php if(false): ?>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-book fa-fw"></i> 文章分类</div>
            <div class="list-group category">
                <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
            </div>
        </div>
    </aside>
    <?php endif; ?>
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
    </aside>
    <div id="fixed"></div>
    <aside class="fixsidebar">
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading"><i class="fa fa-tags fa-fw"></i> 标签云</div>
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
