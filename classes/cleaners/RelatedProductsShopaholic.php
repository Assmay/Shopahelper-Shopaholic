<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use DB;
use System\Classes\PluginManager;

class RelatedProductsShopaholic extends BaseCleaner
{
    const PLUGIN_NAME = 'Lovata.RelatedProductsShopaholic';

    public function run()
    {
        if (!self::PLUGIN_NAME) {
            throw new \Exception('Required PLUGIN_NAME const');
        }

        if (PluginManager::instance()->hasPlugin(self::PLUGIN_NAME)) {
            DB::table('lovata_related_products_shopaholic_link')->truncate();
            $this->response[] = 'Truncated table lovata_related_products_shopaholic_link';
        } else {
            $this->response = ['Undefined plugin '.self::PLUGIN_NAME];
        }
        return $this->response;
    }
}
