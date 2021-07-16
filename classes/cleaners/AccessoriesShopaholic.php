<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use DB;
use System\Classes\PluginManager;

class AccessoriesShopaholic extends BaseCleaner
{
    const PLUGIN_NAME = 'Lovata.AccessoriesShopaholic';

    public function run()
    {
        if (!self::PLUGIN_NAME) {
            throw new \Exception('Required PLUGIN_NAME const');
        }

        if (PluginManager::instance()->hasPlugin(self::PLUGIN_NAME)) {
            DB::table('lovata_accessories_shopaholic_link')->truncate();
            $this->response[] = 'Truncated table lovata_accessories_shopaholic_link';
        } else {
            $this->response = ['Undefined plugin '.self::PLUGIN_NAME];
        }
        return $this->response;
    }
}
