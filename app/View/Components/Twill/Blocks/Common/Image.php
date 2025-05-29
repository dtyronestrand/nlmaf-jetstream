<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Medias;



class Image extends Base
{
    public function getForm(): Form
    {
        return Form::make([
            Medias::make()
                ->name('image')
                ->label(__('Image'))
                ->max(1)
        ]);
    }

    public static function getCrops(): array
    {
        return [
            'image' => [
                'default' => [
                    [
                        'name' => 'default',
                        'ratio' => 'free',
                    ],
                ],
            ],
        ];
    }

    public static function getBlockTitle(): string
    {
        return __('Image');
    }

    public static function getBlockIcon(): string
    {
        return 'image';
    }
}
