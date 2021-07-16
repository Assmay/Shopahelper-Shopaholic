<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\PropertiesShopaholic\Models\Group;
use Lovata\PropertiesShopaholic\Models\Property;
use Lovata\PropertiesShopaholic\Models\PropertySet;
use Lovata\PropertiesShopaholic\Models\PropertyValueLink;
use Lovata\PropertiesShopaholic\Models\PropertyValue;

class PropertiesShopaholic extends BaseCleaner
{
    const MODELS = [
        Group::class,
        Property::class,
        PropertySet::class,
        PropertyValue::class,
        PropertyValueLink::class,
    ];
    const PLUGIN_NAME = 'Lovata.PropertiesShopaholic';

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

        DB::table('lovata_properties_shopaholic_set_category_link')->truncate();
        $this->response[] = 'Truncated table lovata_properties_shopaholic_set_category_link';

        DB::table('lovata_properties_shopaholic_variant_link')->truncate();
        $this->response[] = 'Truncated table lovata_properties_shopaholic_variant_link';

        DB::table('lovata_properties_shopaholic_variant_link')->truncate();
        $this->response[] = 'Truncated table lovata_properties_shopaholic_variant_link';

        DB::table('lovata_properties_shopaholic_set_offer_link')->truncate();
        $this->response[] = 'Truncated table lovata_properties_shopaholic_set_offer_link';

        DB::table('lovata_properties_shopaholic_set_product_link')->truncate();
        $this->response[] = 'Truncated table lovata_properties_shopaholic_set_product_link';
    }
}
