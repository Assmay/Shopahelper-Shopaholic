<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\Shopaholic\Models\Tax;
use Lovata\Shopaholic\Models\Brand;
use Lovata\Shopaholic\Models\Offer;
use Lovata\Shopaholic\Models\Measure;
use Lovata\Shopaholic\Models\Product;
use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Models\Currency;
use Lovata\Shopaholic\Models\PriceType;
use Lovata\Shopaholic\Models\Warehouse;
use Lovata\Shopaholic\Models\PromoBlock;

class Shopaholic extends BaseCleaner
{
    const MODELS = [
        Brand::class,
        Category::class,
        Currency::class,
        Measure::class,
        Offer::class,
        PriceType::class,
        Product::class,
        PromoBlock::class,
        Tax::class,
        Warehouse::class,
    ];
    const PLUGIN_NAME = 'Lovata.Shopaholic';
}
