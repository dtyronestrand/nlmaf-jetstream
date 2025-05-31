<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Tkdmenu;

class TkdmenuRepository extends ModuleRepository
{
    use HandleTranslations, HandleNesting;
protected $jsonRepeaters = [
        'submenu',
    ];
    public function __construct(Tkdmenu $model)
    {
        $this->model = $model;
    }
}
