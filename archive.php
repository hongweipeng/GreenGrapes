<?php $this->need('header.php'); ?>

    <div id="m-container" class="container">
        <div class="col-md-8">
            <div class="alert alert-success">
            <p><?php $this->archiveTitle(array(
                    'category'  =>  _t('分类 %s 下的文章'),
                    'search'    =>  _t('包含关键字 %s 的文章'),
                    'tag'       =>  _t('标签 %s 下的文章'),
                    'author'    =>  _t('%s 发布的文章')
                ), '', ''); ?></p>
            </div>
            <div id="article-list">
                <?php while($this->next()): ?>
                    <article class="post-article clearfix">
                        <section class="">
                            <div class="category-cloud"><?php $this->category(''); ?></div>
                            <h3 class="title">
                                <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                            </h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12 article-content">
                                    <?php $this->content(); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="pull-left">
                                <button class="btn btn-green">阅读全文</button>
                            </div>
                            <div class="pull-right post-info">
                                <span class="ds-thread-count" data-thread-key="<?php echo $this->cid;?>"></span>
                                <span><i class="fa fa-calendar"></i> <?php $this->date('Y-m-d'); ?></span>
                                <span><i class="fa fa-user"></i> <a href="http://www.linuxhot.com/author/admin" rel="author">admin</a></span>
                                <span><i class="fa fa-comment"></i> <a href="http://www.linuxhot.com/saltstack-runners.html#comments">0</a></span>
                            </div>
                        </section>
                    </article>
                <?php endwhile; ?>
            </div>
            <!-- 分页按钮 -->
            <div class="page-nav">
                <nav>
                    <?php $this->pageNav('&laquo;', '&raquo;', 3, '...', array(
                        'itemTag'       =>  'li',
                        'textTag'       =>  'span',
                        'currentClass'  =>  'disabled',
                        'prevClass'     =>  'prev',
                        'nextClass'     =>  'next',
                        'wrapTag'       =>  'ul',
                        'wrapClass'     =>  'pagination'
                    )); ?>
                </nav>
            </div>
        </div>
        <div class="col-md-4">
            <?php $this->need('sidebar.php'); ?>
        </div>

    </div>
<?php $this->need('footer.php');
