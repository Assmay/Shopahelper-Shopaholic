<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\CouponsShopaholic\Models\Coupon;
use Lovata\CouponsShopaholic\Models\CouponGroup;

class CouponsShopaholic extends BaseCleaner
{
    const MODELS = [
        Coupon::class,
        CouponGroup::class,
    ];
    const PLUGIN_NAME = 'Lovata.CouponsShopaholic';

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
        DB::table('lovata_coupons_shopaholic_coupon_cart')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_coupon_cart';

        DB::table('lovata_coupons_shopaholic_group_brand')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_group_brand';

        DB::table('lovata_coupons_shopaholic_group_category')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_group_category';

        DB::table('lovata_coupons_shopaholic_group_offer')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_group_offer';

        DB::table('lovata_coupons_shopaholic_group_product')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_group_product';

        DB::table('lovata_coupons_shopaholic_group_tag')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_group_tag';

        DB::table('lovata_coupons_shopaholic_order_coupon')->truncate();
        $this->response[] = 'Truncated table lovata_coupons_shopaholic_order_coupon';
    }
}
