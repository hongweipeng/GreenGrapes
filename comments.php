<div id="comments">
    <?php if($this->allow('comment')): ?>
        <div class="block">
            <div id="SOHUCS" sid="<?php echo $this->cid;?>" ></div>
        </div>

    <?php else: ?>

        <div class="block">
            <p class="ui ribbon label <?php $this->options->labelColor() ?>"><?php _e('楼主残忍的关闭了评论'); ?></p>
        </div>

    <?php endif; ?>
</div>