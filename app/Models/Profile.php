<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Model;

class Profile extends Model 
{
    use HasBlocks, HasSlug, HasMedias, HasFiles;

    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'is_admin',
        'tkd_member',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public $slugAttributes = [
        'name',
    ];
    
}
