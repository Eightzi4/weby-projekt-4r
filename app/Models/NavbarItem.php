<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NavbarItem extends Model
{
    use HasFactory;

    protected $table = 'navbar_items';

    protected $fillable = [
        'title',
        'route',
        'parent_id',
        'order',
        'align',
        'is_admin_item',
        'requires_auth',
    ];

    /**
     * Vztah pro získání potomků (podpoložek).
     */
    public function children(): HasMany
    {
        return $this->hasMany(NavbarItem::class, 'parent_id')->orderBy('order');
    }

    /**
     * Vztah pro získání rodiče.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavbarItem::class, 'parent_id');
    }
}