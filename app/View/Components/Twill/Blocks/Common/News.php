<?php

namespace App\View\Components\Twill\Blocks\Common;

use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\DatePicker;
use Illuminate\Contracts\View\View;

class News extends Base
{

    public function getForm(): Form
    {
        return Form::make([
            Input::make()->name('title'),
            DatePicker::make()->name('date')->label('Event Date'),
            Wysiwyg::make()->name('description'),
            Medias::make()
                ->name('image')
                ->max(1),
            Input::make()->name('label')->label('Button Label')
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
        return __('News');
    }
    public static function getBlockIcon(): string
    {
        return 'news';
    }
}
