<?php
/**
 * 说说
 *
 * @package custom
 */
$this->need('header.php');
$options = Typecho_Widget::widget('Widget_Options');
?>
    <style>
        .tmtimeline {
            position: relative;
            margin: 30px 0 0;
            padding: 0;
            list-style: none
        }

        .tmtimeline .line {
            position: relative;
            min-height: 80px
        }

        .tmtimeline .line:last-child {
            min-height: 0
        }

        .tmtimeline:before {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 15%;
            margin-left: -10px;
            width: 10px;
            background: #afdcf8;
            content: ''
        }

        .tmtimeline > .line .tmtime {
            position: absolute;
            display: block;
            padding-right: 100px;
            width: 20%
        }

        .tmtimeline > .line .tmtime span {
            display: block;
            text-align: right
        }

        .tmtimeline > .line .tmtime span:first-child {
            color: #bdd0db;
            font-size: .9em
        }

        .tmtimeline > .line .tmtime span:last-child {
            color: #3594cb;
            font-size: 2.9em
        }

        .tmtimeline > .line:nth-child(odd) .tmtime span:last-child {
            color: #6cbfee
        }

        .tmtimeline > .line .tmlabel {
            position: relative;
            margin: 0 0 15px 20%;
            padding: 2em;
            border-radius: 4px;
            background: #3594cb;
            color: #fff;
            font-weight: 300;
            font-size: 16px;
            line-height: 1.4
        }

        .tmtimeline .box {
            margin: 5px 0 15px 20%
        }

        .tmtimeline > .line:nth-child(odd) .tmlabel {
            background: #6cbfee
        }

        .tmtimeline > .line .tmlabel h2 {
            margin-top: 0;
            padding: 0 0 10px;
            border-bottom: 1px solid rgba(255, 255, 255, .4);
            color: #fff;
            font-size: 22px
        }

        .tmtimeline > .line .tmlabel:after {
            position: absolute;
            top: 10px;
            right: 100%;
            width: 0;
            height: 0;
            border: solid transparent;
            border-width: 10px;
            content: " ";
            pointer-events: none;
            border-right-color: #3594cb
        }

        .tmtimeline > .line:nth-child(odd) .tmlabel:after {
            border-right-color: #6cbfee
        }

        .tmtimeline > .line .tmicon {
            position: absolute;
            top: 0;
            left: 15%;
            margin: 0 0 0 -25px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #46a4da;
            box-shadow: 0 0 0 8px #afdcf8;
            color: #fff;
            text-align: center;
            text-transform: none;
            font-weight: 400;
            font-style: normal;
            font-variant: normal;
            font-size: 1.4em;
            line-height: 40px;
            speak: none;
            -webkit-font-smoothing: antialiased
        }
    </style>
    <div id="m-container" class="container">
        <div class="row ml-0 mr-0">
            <div class="col-md-8 pl-0 pr-0">
                <?php
                var_dump($this->request);
                    $page = 1;
                    $page_size = 20;
                    $total = MicroTalk_Plugin::totalCount();
                    $talks = MicroTalk_Plugin::talkPosts($page, $page_size);
                ?>
                <ul class="tmtimeline" id="timeline">
                    <?php foreach ($talks as $talk) : ?>
                    <li class="line">
                        <time class="tmtime" datetime=""><span><?php _e($talk['created']); ?></span> <span title="">'H:i'</span></time>
                        <div class="tmicon fa fa-comment-o"></div>
                        <div class="tmlabel">
                            <h2><?php _e($talk['author']); ?></h2>
                            <div class="index-text post-content">
                                <p><?php _e($talk['content']); ?></p>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <li class="line">
                        <div class="tmicon fa fa-ellipsis-h"></div>
                        <div class="page-nav">
                            <nav>
                            <?php
                                //分页
                                $currUrl = $this->request->getRequestUri();
                                parse_str($_SERVER['QUERY_STRING'], $parseUrl);
                                unset($parseUrl['page']);
                                $query = $currUrl.'?'.http_build_query($parseUrl);
                                $pange_nav = new Typecho_Widget_Helper_PageNavigator_Box($total, $page, $page_size,$query.'&page={page}');
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
