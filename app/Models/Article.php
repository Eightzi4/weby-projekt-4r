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

    /**
     * Z vlastnosti $casts jsme ODEBRALI 'date' => 'timestamp',
     * protože ho nahrazujeme explicitními metodami níže.
     */
    protected $casts = [
        'top' => 'boolean',
        'published' => 'boolean',
    ];

    // ===================================================================
    // ==== ZDE JE NOVÉ A KOMPLETNÍ ŘEŠENÍ PRO PRÁCI S DATEM ====
    // ===================================================================

    /**
     * ACCESSOR (pro čtení z DB)
     * Laravel tuto metodu automaticky zavolá, když přistoupíte k $article->date.
     * Vezme celé číslo z databáze a vrátí plnohodnotný Carbon objekt.
     * TÍMTO OPRAVÍME CHYBU: "Call to a member function format() on int"
     *
     * @param int|null $value Hodnota ze sloupce 'date'
     * @return \Carbon\Carbon|null
     */
    public function getDateAttribute($value)
    {
        // Pokud je hodnota platné číslo (timestamp), vytvoří z ní Carbon objekt.
        // Jinak vrátí null, aby se předešlo chybám.
        return $value ? Carbon::createFromTimestamp($value) : null;
    }

    /**
     * MUTATOR (pro zápis do DB)
     * Laravel tuto metodu automaticky zavolá, když se pokusíte uložit hodnotu do $article->date.
     * Vezme příchozí hodnotu (např. text '2025-07-09' z formuláře) a převede ji na celé číslo (timestamp).
     * TÍMTO OPRAVÍME CHYBU: "Data truncated for column 'date'"
     *
     * @param string|\Carbon\Carbon $value Hodnota z formuláře nebo kódu
     * @return void
     */
    public function setDateAttribute($value)
    {
        // Převedeme příchozí hodnotu na Carbon objekt a z něj získáme timestamp.
        $this->attributes['date'] = Carbon::parse($value)->timestamp;
    }

    // ===================================================================
    // ================== KONEC NOVÉHO ŘEŠENÍ ==================
    // ===================================================================

    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }

    public function scopeTop(Builder $query): void
    {
        $query->where('top', true);
    }
}
