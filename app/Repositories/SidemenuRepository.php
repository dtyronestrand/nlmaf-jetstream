<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleJsonRepeaters;
use A17\Twill\Repositories\Behaviors\HandleNesting;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Sidemenu;

class SidemenuRepository extends ModuleRepository
{
    use HandleTranslations, HandleJsonRepeaters, HandleNesting;
protected $jsonRepeaters = [
        'submenu',
    ];
    
    public function __construct(Sidemenu $model)
    {
        $this->model = $model;
    }
}
