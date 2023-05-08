<?php

namespace App\Domain\News\Models;

use App\Domain\News\Models\Tests\Factories\NewsFactory;
use App\Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function newFactory(): NewsFactory
    {
        return NewsFactory::new();
    }
}
