<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goods extends Model
{
    use HasFactory;
    /**
     * Goods model has no need in timestamp to be created
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'goods_name',
        'goods_price',
        'goods_description',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
