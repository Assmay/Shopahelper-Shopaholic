<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\DiscountsShopaholic\Models\Discount;

class DiscountsShopaholic extends BaseCleaner
{
    const MODELS = [
        Discount::class,
    ];
    const PLUGIN_NAME = 'Lovata.DiscountsShopaholic';

    private function clearModels()
    {
        foreach (self::MODELS as $sClassName) {
            /** @var \Model $obModel */
            $obModel = new $sClassName();
            $sTableName = $obModel->getTable();
            if ($this->bImgDrop) {
                parent::dropImages($obModel);
            }
            $this->response[] = 'Deleted objects, model: '.$sClassName.', count: '.$sClassName::count();
            DB::table($sTableName)->truncate();
        }

        DB::table('lovata_discounts_shopaholic_discount_brand')->truncate();
        $this->response[] = 'Truncated table lovata_discounts_shopaholic_discount_brand';

        DB::table('lovata_discounts_shopaholic_discount_category')->truncate();
        $this->response[] = 'Truncated table lovata_discounts_shopaholic_discount_category';

        DB::table('lovata_discounts_shopaholic_discount_offer')->truncate();
        $this->response[] = 'Truncated table lovata_discounts_shopaholic_discount_offer';

        DB::table('lovata_discounts_shopaholic_discount_product')->truncate();
        $this->response[] = 'Truncated table lovata_discounts_shopaholic_discount_product';

        DB::table('lovata_discounts_shopaholic_discount_tag')->truncate();
        $this->response[] = 'Truncated table lovata_discounts_shopaholic_discount_tag';
    }
}
