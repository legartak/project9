<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Category model has no need in timestamp to be created
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['category_name'];

    public function goods(): HasMany
    {
        return $this->hasMany(Goods::class);
    }
}
