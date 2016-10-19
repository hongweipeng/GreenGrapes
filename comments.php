<div id="comments">
    <?php if($this->allow('comment')): ?>
        <div class="block">
            <!-- 多说评论框 start -->
            <div class="ds-thread" data-thread-key="<?php echo $this->cid;?>" data-title="<?php echo $this->title;?>" data-author-key="<?php echo $this->authorId;?>" data-url=""></div>
            <!-- 多说评论框 end -->
        </div>

    <?php else: ?>

        <div class="block">
            <p class="ui ribbon label <?php $this->options->labelColor() ?>"><?php _e('楼主残忍的关闭了评论'); ?></p>
        </div>

    <?php endif; ?>
</div>