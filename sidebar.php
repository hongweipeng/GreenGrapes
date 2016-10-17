<aside id="sidebar">
    <aside>
        <form method="get" id="searchform" class="form-inline clearfix" action="http://www.linuxhot.com">
            <input class="form-control" name="s" id="s" placeholder="搜索关键词..." type="text">
            <button class="btn btn-success btn-small"><i class="fa fa-search"></i> 查找</button>
        </form>
    </aside>
    <aside>
        <div class="panel panel-default hidden-xs">
            <div class="panel-heading">最新文章</div>
            <ul class="list-group">
                <?php $this->widget('Widget_Contents_Post_Recent')
                    ->parse('<li class="list-group-item clearfix"><a href="{permalink}">{title}</a></li>'); ?>
            </ul>
        </div>
    </aside>
    <aside>
        <div class="panel panel-green hidden-xs">
            <div class="panel-heading">文章分类</div>
            <div class="list-group category">
                <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
            </div>
        </div>
    </aside>
    <aside>
        <div id="meta-cloud">
            <canvas height="300" id="mycanvas" style="width: 100%">
                <p>标签云</p>
                <?php $this->widget('Widget_Metas_Category_List')->parse('<a href="{permalink}" class="tag">{name}</a>'); ?>
            </canvas>
        </div>
    </aside>
</aside>