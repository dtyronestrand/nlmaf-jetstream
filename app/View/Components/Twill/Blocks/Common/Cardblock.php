<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\InlineRepeater;
use A17\Twill\Services\Forms\Fields\Medias;


class Cardblock extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('heading'),
            Select::make()
            ->name('type')
            ->options(
                Options::make([
                    Option::make('default', 'Default'),
                    Option::make('profile', 'Profile'),
                    Option::make('stack', 'Stacked'),
                ])
                ),
                InlineRepeater::make()
                ->name('cards')
                ->fields([
                    Input::make()->name('heading'),
                    Input::make()->name('details'),
                    Medias::make()
                    ->name('image')
                    ->max(1)
                ])
        ]);
    }
}
