<?php
namespace App\Action\Card;

use App\Action\User\AddToTheBalanceAction;
use App\Models\Card;
use App\Verification\Card\ThisCardBelongsToTheUser;
use Exception;

class SprayCardAction
{

/*
За карты разного уровня при удаление начисляется
разное количество пыли.Уровень зависит от количества
повторений.
'Уровень' => 1,
'кол-во повторений' => 0,
'стоимость при распыление' => 200,

'Уровень' => 2,
'кол-во повторений' => 2000,
'стоимость при распыление' => 400,

'Уровень' => 3,
'кол-во повторений' => 5000,
'стоимость при распыление' => 600,

'Уровень' => 4,
'кол-во повторений' => 10000,
'стоимость при распыление' => 1000,
 */

    public static function execute(int $userId, int $cardId): void
    {

        $card = Card::query()->findOrFail($cardId);

        if (!ThisCardBelongsToTheUser::check($card, $userId)) {
            throw new Exception('Данная карта(id:' . $cardId . ') не пренадлежит пользователю(id:' . $userId . ')');
        }

        $card->decks()->detach($card);
        $card->delete();

        $amountОfDustPerCard = [0, 200, 400, 500, 1000];
        $amount = $amountОfDustPerCard[$card->level];
        AddToTheBalanceAction::execute($card->user_id, $amount);
    }

}
