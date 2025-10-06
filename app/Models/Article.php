<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';
    public $timestamps = false;

    protected $fillable = [
        'link',
        'title',
        'photo',
        'date',
        'top',
        'text',
        'published',
    ];

    protected $casts = [
        'top' => 'boolean',
        'published' => 'boolean',
    ];

    public function getDateAttribute($value)
    {
        return $value ? Carbon::createFromTimestamp($value) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->timestamp;
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }

    public function scopeTop(Builder $query): void
    {
        $query->where('top', true);
    }
}
