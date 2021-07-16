<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\OrdersShopaholic\Models\Cart;
use Lovata\OrdersShopaholic\Models\CartPosition;
use Lovata\OrdersShopaholic\Models\Order;
use Lovata\OrdersShopaholic\Models\OrderPosition;
use Lovata\OrdersShopaholic\Models\OrderPositionProperty;
use Lovata\OrdersShopaholic\Models\OrderPromoMechanism;
use Lovata\OrdersShopaholic\Models\OrderProperty;
use Lovata\OrdersShopaholic\Models\PaymentMethod;
use Lovata\OrdersShopaholic\Models\PaymentRestriction;
use Lovata\OrdersShopaholic\Models\PromoMechanism;
use Lovata\OrdersShopaholic\Models\ShippingRestriction;
use Lovata\OrdersShopaholic\Models\ShippingType;
use Lovata\OrdersShopaholic\Models\Status;
use Lovata\OrdersShopaholic\Models\Task;
use Lovata\Ordersshopaholic\Models\UserAddress;

class OrdersShopaholic extends BaseCleaner
{
    const MODELS = [
        Cart::class,
        CartPosition::class,
        Order::class,
        OrderPosition::class,
        OrderPositionProperty::class,
        OrderPromoMechanism::class,
        OrderProperty::class,
        PaymentMethod::class,
        PaymentRestriction::class,
        PromoMechanism::class,
        ShippingRestriction::class,
        ShippingType::class,
        Status::class,
        Task::class,
        UserAddress::class,
    ];
    const PLUGIN_NAME = 'Lovata.OrdersShopaholic';

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

        DB::table('lovata_ordersshopaholic_payment_restrictions_link')->truncate();
        $this->response[] = 'Truncated table lovata_ordersshopaholic_payment_restrictions_link';

        DB::table('lovata_ordersshopaholic_shipping_restrictions_link')->truncate();
        $this->response[] = 'Truncated table lovata_ordersshopaholic_shipping_restrictions_link';
    }
}
