<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Deck;

/**
 * App\Models\Card
 *
 * @property int $id
 * @property string $url
 * @property int $repeats
 * @property int $level
 * @property int $word_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CardFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Card newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card query()
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereRepeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereWordId($value)
 * @mixin \Eloquent
 */
class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'repeats',
        'level',
        'password',
    ];

    public function decks()
    {
        return $this->belongsToMany(Deck::class);
    }
}