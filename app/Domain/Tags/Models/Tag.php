<?php

namespace App\Domain\Tags\Models;

use App\Domain\News\Models\News;
use App\Domain\Tags\Models\Tests\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class);
    }

    public static function newFactory(): TagFactory
    {
        return TagFactory::new();
    }
}
