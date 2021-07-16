<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\ReviewsShopaholic\Models\Review;

class ReviewsShopaholic extends BaseCleaner
{
    const MODELS = [
        Review::class,
    ];
    const PLUGIN_NAME = 'Lovata.ReviewsShopaholic';
}
