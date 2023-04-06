<?php
namespace App\Action\Card;

use App\Models\Card;
use App\Verification\Card\ThisCardBelongsToTheUser;
use Exception;
use App\Action\Card\UpLevelAction;

class UpRepeatAction
{
    public static function execute(int $userId, int $cardId): Card
    {
        $card = Card::query()->findOrFail($cardId);

        if (!ThisCardBelongsToTheUser::check($card, $userId)) {
            throw new Exception('Данная карта(id:' . $cardId . ') не пренадлежит пользователю(id:' . $userId . ')');
        }

        $card->repeats = $card->repeats + 1;
        $card->save();
        UpLevelAction::execute($card);
        return $card;
    }

}