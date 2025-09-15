<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';

    /**
     * Laravel standardně očekává sloupce created_at a updated_at.
     * Pokud je vaše tabulka nemá, nastavte public $timestamps = false;
     */
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
        'date' => 'datetime',
        'top' => 'boolean',
        'published' => 'boolean',
    ];

    /**
     * Scope pro získání pouze publikovaných článků.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }

    /**
     * Scope pro získání pouze článků z kategorie "top".
     */
    public function scopeTop(Builder $query): void
    {
        $query->where('top', true);
    }
}