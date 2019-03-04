
<?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
        <a href="<?php echo e(('/detail')); ?>?goods_id=<?php echo e($list->goods_id); ?>" class="g-pic">
            <img class="lazy" name="goodsImg" data-original="<?php echo e(URL::asset($list->goods_img)); ?>" src="<?php echo e(URL::asset($list->goods_img)); ?>" width="136" height="136">
        </a>
        <p class="g-name"><?php echo e($list->sku_name); ?></p>
        <ins class="gray9">价值：￥<?php echo e($list->sku_price); ?></ins>
        <div class="Progress-bar">
            <p class="u-progress">
                <span class="pgbar" style="width: 96.43076923076923%;">
                    <span class="pging"></span>
                </span>
            </p>
        </div>
        <div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
            <a href="/skuAttr" class="buy-btn" codeid="12751965">立即购买</a>
            <div class="gRate" codeid="12751965" canbuy="58">
                <a href="javascript:;"></a>
            </div>
        </div>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>