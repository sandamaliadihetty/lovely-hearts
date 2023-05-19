<?php

namespace App\Models\Adopt;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopt extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
