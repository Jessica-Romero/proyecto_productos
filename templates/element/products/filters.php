<div class="p-3">
    <h5 class="sidebar-title"><?= __('Filters') ?></h5>
    <p class="sidebar-desc"><?= __('Products filters') ?></p>

    <hr>


    <div class="sidebar-content" id="products-filters">
        <ul class="products-filters-list">
            <li class="mb-2"><?= $this->Form->select('brand_id', $brands, ['empty' => ['0' => __('Select a brand')], 'value' => array_key_exists('brand_id', $products_filters)?$products_filters['brand_id']:0]); ?></li>
        </ul>
        <button type="button" class="btn btn-block btn-success" id="products-filters-apply"><?= __('Apply filters') ?></button>
    </div>
</div>
