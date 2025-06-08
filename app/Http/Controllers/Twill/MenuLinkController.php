<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Form;
use App\Http\Controllers\Twill\Base\ModuleController as BaseModuleController;
use App\Models\Base\Model;
class MenuLinkController extends BaseModuleController
{
    protected $moduleName = 'menuLinks';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->enableReorder();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);
       $form->add(
            Input::make()
            ->name('title')
            ->label('Title')
            ->translatable()
       );
       $form->add(
            Input::make()
            ->name('url')
            ->label('URL')
       
      );
      $form->add(
        Checkbox::make()
        ->name('has_submenu')
        ->label('Has Submenu')
      
      );
      $form->add(
        InlineRepeater::make()
        ->name('submenu')
        ->label('Sub Menu Item')
        ->triggerText('Add Sub Menu Item')
        ->fields([
            Input::make()
            ->name('title')
            ->label('Title'),
       
            Input::make()
            ->name('url')
            ->label('URL')
    
      ])->connectedTo('has_submenu', true)
        );
            return $form;

    
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
  
}
