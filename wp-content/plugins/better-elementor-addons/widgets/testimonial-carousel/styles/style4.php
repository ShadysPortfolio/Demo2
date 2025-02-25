<div class="better-testimonial style-4 creative">
    <div class="slic-item">
        <?php foreach ($settings['testi_list'] as $item): ?>
            <div class="item">
                <span class="quote-icon">
                    <img src="<?php echo esc_url(plugins_url('/assets/img/quote.svg', dirname(__FILE__, 3))); ?>" alt="">
                </span>
                <p><?php echo esc_html($item['text']); ?></p>
                <div class="info">
                    <div class="cont">
                        <div class="author">
                            <div class="lxleft">
                                <div class="img">
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
                                </div>
                            </div>
                            <div class="fxright">
                                <h6 class="author-name"><?php echo esc_html($item['title']); ?></h6>
                                <span class="author-details"><?php echo esc_html($item['position']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="control">
        <span class="prev"><i class="pe-7s-angle-left"></i></span>
        <span class="next"><i class="pe-7s-angle-right"></i></span>
    </div>
</div>
