<?php

namespace App\Models\Shop;

use App\Models\User;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    const ACTIVE = 1;
    const INACTIVE = 0;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
