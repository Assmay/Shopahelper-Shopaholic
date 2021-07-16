<?php namespace BizMark\Shopahelper\Classes\Cleaners;

use Lovata\MightySeo\Models\SeoParam;
use Lovata\MightySeo\Models\SeoTemplate;

class MightySeo extends BaseCleaner
{
    const MODELS = [
        SeoParam::class,
        SeoTemplate::class,
    ];
    const PLUGIN_NAME = 'Lovata.MightySeo';
}
