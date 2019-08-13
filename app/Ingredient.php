<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;
    /** @var array  */
    protected $fillable = ['name', 'description', 'kosher', 'ingredientcode', 'koshertype'];
}
