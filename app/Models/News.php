<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use App\Models\Base\Model;

class News extends Model 
{
    use HasBlocks, HasSlug;

    protected $fillable = [
        'published',
        'title',
        'publish_start_date',
    ];
    
    public $slugAttributes = [
        'title',
    ];

    public array $publicAttributes = [
        'title',
        'blocks',
        'publish_start_date',
    
    ];
}
