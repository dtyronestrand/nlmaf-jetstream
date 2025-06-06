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
                Option::make('text', 'Text and Image'),
                ])
                ),
            BlockEditor::make()->name('heading')
            ->blocks(['common-heading'])
            ->label(__('Heading'))
            ->connectedTo('variant', ['default', 'cta']),
            Medias::make()
            ->name('image')
            ->label(__('Image'))
            ->max(1)
            ->connectedTo('variant', ['default', 'cta', 'text']),
            Input::make()
            ->name('button_link')
            ->label('Button Link')
            ->translatable()
            ->connectedTo('variant', ['default', 'cta']),
            Input::make()
            ->name('button_text')
            ->label('Button Text')
            ->translatable()
            ->connectedTo('variant', ['default', 'cta']),
            Input::make()
            ->name('heading')
            ->label(__('Heading'))
            ->connectedTo('variant', 'text'),
            Input::make()
            ->name('subheading')
            ->label(__('Subheading'))
            ->connectedTo('variant', 'text')

        ]);
    }
    public static function getCrops(): array
    {
        return [
            'image'=> [
                'desktop'=>[
                    [
                        'name' => 'desktop',
                        'ratio'=> 16/9,
    
                    ],
                ],
                'tablet'=>[
                    [
                        'name' => 'tablet',
                        'ratio'=> 4/3,
                    ],
                ],
                'mobile'=>[
                    [
                        'name' => 'mobile',
                        'ratio'=> 1,
                    ],
                ]
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
