<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Checkbox;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Fields\Select;

use A17\Twill\Services\Listings\Columns\Boolean;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class ProfileController extends BaseModuleController
{
    protected $moduleName = 'profiles';
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected $titleColumnKey = 'name';
    protected $indexOptions =[
        'create' => false,
        'delete' => false,
    ];

    protected function setUpController(): void
    {
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Input::make()->name('bio')->label('Bio')
        );
        $form->add(
            Checkbox::make()->name('is_admin')->label('Is Admin')
        );
        $form->add(
            Checkbox::make()->name('tkd_member')->label('TKD Member')           
        );
        $form->add(
            Select::make()
                ->name('belt')
                ->label('Current Belt')
                ->options(
                    Options::make([
                        Option::make('white', 'White'),
                        Option::make('yellow', 'Yellow'),
                        Option::make('orange', 'Orange'),
                        Option::make('green', 'Green'),
                        Option::make('blue', 'Blue'),
                        Option::make('brown', 'Brown'),
                        Option::make('red', 'Red'),
                        Option::make('black', 'Black'),
                    ])
                )->connectedTo('tkd_member', true)
        );
        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
 protected function getIndexTableColumns(): TableColumns
    {
    $columns = new TableColumns();
    $columns->add(
        Text::make()
            ->field('name')
            ->title(__('Name'))
            ->sortable()
            ->linkToEdit()
    );
    $columns->add(
           Boolean::make() 
           ->field('tkd_member')
           ->title(__('TKD Member'))
    );
    $columns->add(
           Text::make()
            ->field('belt')
            ->title(__('Belt'))

    );
    return $columns;
    }
}
