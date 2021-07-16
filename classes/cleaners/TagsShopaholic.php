<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\TagsShopaholic\Models\Tag;

class TagsShopaholic extends BaseCleaner
{
    const MODELS = [
        Tag::class,
    ];
    const PLUGIN_NAME = 'Lovata.TagsShopaholic';

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

        DB::table('lovata_tagsshopaholic_tag_product')->truncate();
        $this->response[] = 'Truncated table lovata_tagsshopaholic_tag_product';
    }
}
