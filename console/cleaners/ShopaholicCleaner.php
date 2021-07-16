<?php namespace BizMark\Shopahelper\Console\Cleaners;

use Illuminate\Console\Command;


class ShopaholicCleaner extends Command
{

    const AVAILABLE_PLUGINS = [
        'Shopaholic',
        'OrdersShopaholic',
        'PropertiesShopaholic',
        'CouponsShopaholic',
        'DiscountsShopaholic',
        'MightySeo',
        'ReviewsShopaholic',
        'TagsShopaholic',
        'AccessoriesShopaholic',
        'RelatedProductsShopaholic',
    ];

    /**
     * @var string The console command name.
     */
    protected $name = 'shopahelper:clean.shopaholic';

    /**
     * @var string The console command description.
     */
    protected $description = 'Does something cool.';

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $sPluginNames = $this->choice('Select a plugin for cleaning', self::AVAILABLE_PLUGINS, null, null, true);

        $bImgDrop = false;
        if ($this->confirm('Do you wish to clear images? [yes|no]')) {
            $bImgDrop = true;
        }

        if ($this->confirm('Do you wish to continue? [yes|no]'))
        {
            foreach ($sPluginNames as $sPluginName) {
                $sClassName = '\BizMark\Shopahelper\Classes\Cleaners\\'.$sPluginName;

                $obCleander = new $sClassName($bImgDrop);
                $obCleander->run();
                $this->output->writeln($sClassName.': cleared!');
            }
        }
    }
}
