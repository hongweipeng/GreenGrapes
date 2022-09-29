<?php

/**
 * 文章归档页
 *
 * @package custom
 */

class RecentSplitPage extends \Widget\Contents\Post\Recent {
    private $total = 0; // 所有文章个数

    public function getTotal() {
        return $this->total;
    }

    public function execute(){
        $this->parameter->setDefault([
            'pageSize' => $this->options->postsListSize,
            'currentPage' => 1,
        ]);
        $select = $this->select()
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', $this->options->time)
            ->where('table.contents.type = ?', 'post');
        // 记录总数
        $cloneSql = clone $select;
        $this->total = $this->size($cloneSql);
        $this->db->fetchAll($select
            ->order('table.contents.created', Typecho\Db::SORT_DESC)
            ->page($this->parameter->currentPage, $this->parameter->pageSize), [$this, 'push']);
    }
}

$page = (int) $this->request->get('page', 1);
$page_size = 20;
$recent = RecentSplitPage::alloc(['pageSize' => $page_size, 'currentPage' => $page]);
$total = $recent->getTotal();
$this->need('header.php');
?>
    <div id="m-container" class="container">
        <div class="row">
            <div class="col-md-8 archive-timeline">
                <div class="alert alert-info">共有 <?php _e($total); ?> 篇文章</div>
                <div class="bg-white pt-1 pb-1">
                    <div class="archive-content">
                        <?php $year = ''; ?>
                        <?php while ($recent->next()): ?>
                            <?php if ($year !== date('Y', $recent->created)) :?>
                                <?php $year = date('Y', $recent->created); ?>
                                <div class="timeline-big-dot">
                                    <span class="timeline-year mt-4 mb-4 ms-3"><?php _e($year); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="line">
                                <div class="d-flex line-item">
                                    <div class="small me-2">
                                        <time datetime="<?php $recent->date("Y-m-d H:i:s"); ?>" content="<?php $recent->date('Y-m-d'); ?>" data-bs-toggle="tooltip" title="<?php $recent->date("Y-m-d H:i:s"); ?>">
                                            <?php $recent->date('m-d'); ?>
                                        </time>
                                    </div>
                                    <div class="d-inline flex-grow-1">
                                        <a href="<?php $recent->permalink() ?>" data-bs-trigger="hover" data-bs-content="<?php $recent->excerpt() ?>" data-bs-toggle="popover" itemprop="url" target="_blank" rel="noopener noreferrer">
                                            <?php $recent->title() ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <div class="page-nav timeline-big-dot">
                            <nav class="ms-3">
                                <?php
                                //分页
                                $query = $this->request->makeUriByRequest('page={page}');
                                $pange_nav = new Typecho\Widget\Helper\PageNavigator\Box($total, $page, $page_size,$query);
                                echo '<ul class="pagination">';
                                $pange_nav->render('&laquo;', '&raquo;', 3, '...', array(
                                    'itemTag'       =>  'li',
                                    'textTag'       =>  'span',
                                    'currentClass'  =>  'page-item disabled',
                                    'prevClass'     =>  'prev',
                                    'nextClass'     =>  'next',
                                ));
                                echo '</ul>';
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php $this->need('sidebar.php'); ?>
            </div>
        </div>

    </div>
<?php $this->need('footer.php');
