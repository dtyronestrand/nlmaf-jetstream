<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Input;


class Hero extends Base
{


    public function getForm(): Form
    {
        return Form::make([
            Select::make()
            ->name('variant')
            ->label(__('Variant'))
            ->options(
                Options::make([
                    Option::make('default', 'Default'),
                Option::make('cta', 'Call to Action'),
                ])
                ),
            BlockEditor::make()->name('heading')
            ->blocks(['common-heading']),
            Medias::make()
            ->name('image')
            ->label(__('Image'))
            ->max(1),
            Input::make()
            ->name('button_link')
            ->label('Button Link')
            ->translatable(),
            Input::make()
            ->name('button_text')
            ->label('Button Text')
            ->translatable(),
        ]);
    }
    public static function getCrops(): array
    {
        return [
            'image'=>[
                'default'=>[
                    [
                        'name' => 'default',
                        'ratio'=>'free'
                    ],
                ],
            ],
        ];
    }
    public static function getBlockTitle(): string
    {
        return __('Hero');
    }
    public static function getBlockIcon(): string{
        return 'image';
    }
}
