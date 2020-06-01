<?php
/**
 * 说说
 *
 * @package custom
 */
$this->need('header.php');
?>
    <div id="m-container" class="container">
        <div class="row ml-0 mr-0">
            <div class="col-md-8 pl-1 pr-1">
                <?php
                    $page = (int) $this->request->get('page', 1);
                    $page_size = 20;
                    $total = MicroTalk_Plugin::totalShowCount();
                    $talks = MicroTalk_Plugin::talkPosts($page, $page_size);
                ?>
                <ul class="tk-timeline">
                    <?php $year = ''; ?>
                    <?php foreach ($talks as $talk) : ?>
                    <li class="line">
                        <time class="tk-time" datetime="">
                            <?php if ($year !== date('Y', $talk['created'])) :?>
                            <span class="tk-time-lg"><?php _e(date('Y', $talk['created'])); ?></span>
                            <?php endif; ?>
                            <span><?php _e(date('m-d', $talk['created'])); ?></span>
                        </time>
                        <div class="tk-icon">
                            <img class="author-gravatar" src="<?php _e(Typecho_Common::gravatarUrl($talk['mail'], 40, 'X', 'mm', $this->request->isSecure())); ?>" alt="<?php _e($talk['author']); ?>" />
                        </div>
                        <div class="tk-label">
                            <div class="index-text post-content">
                                <?php _e($talk['content']); ?>
                            </div>
                        </div>
                    </li>
                    <?php $year = date('Y', $talk['created']); ?>
                    <?php endforeach; ?>
                    <li class="line">
                        <div class="tk-icon fa-icon fa fa-ellipsis-h"></div>
                        <div class="page-nav">
                            <nav>
                            <?php
                                //分页
                                $query = $this->request->makeUriByRequest('page={page}');
                                $pange_nav = new Typecho_Widget_Helper_PageNavigator_Box($total, $page, $page_size,$query);
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
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <?php $this->need('sidebar.php'); ?>
            </div>
        </div>

    </div>
<?php $this->need('footer.php');
