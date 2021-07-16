<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use DB;
use System\Classes\PluginManager;

abstract class BaseCleaner
{
    const MODELS = [];
    const PLUGIN_NAME = 'asdsad';

    protected $response = [];

    protected $bImgDrop;

    public function __construct($bImgDrop = false)
    {
        $this->bImgDrop = $bImgDrop;
    }

    public function run()
    {
        if (!static::PLUGIN_NAME) {
            throw new \Exception('Required PLUGIN_NAME const');
        }
        if (empty(static::MODELS)) {
            throw new \Exception('Required MODELS const');
        }

        if (PluginManager::instance()->hasPlugin(static::PLUGIN_NAME)) {
            $this->clearModels();
        } else {
            $this->response = ['Undefined plugin '.static::PLUGIN_NAME];
        }
        return $this->response;
    }

    private function clearModels()
    {
        foreach (static::MODELS as $sClassName) {
            /** @var \Model $obModel */
            $obModel = new $sClassName();
            $sTableName = $obModel->getTable();
            if ($this->bImgDrop) {
                $this->dropImages($obModel);
            }
            $this->response[] = 'Deleted objects, model: '.$sClassName.', count: '.$sClassName::count();
            DB::table($sTableName)->truncate();
        }
    }

    protected function dropImages($obModel)
    {
        foreach (['attachOne', 'attachMany'] as $sRelType) {
            foreach ($obModel->$sRelType as $relationName => $relation) {
                $relation = $obModel->getRelationDefinition($relationName);
                $obImages = $relation[0]::where('field', $relationName)
                    ->where('attachment_type', get_class($obModel))
                    ->get();
                /**
                 * Отдельно дропаем каждый объект чтобы стриггерить событие физ. удаления
                 */
                $this->response[] = 'Deleted images, model: '.get_class($obModel).', count: '.$obImages->count();
                $obImages->each(function ($obImage) {
                    $obImage->delete();
                });
            }
        }
    }
}
