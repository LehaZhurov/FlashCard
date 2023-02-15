<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Deck
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\DeckFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deck newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deck query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereUserId($value)
 * @mixin \Eloquent
 */
class Deck extends Model
{
    use HasFactory;

    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }
}
