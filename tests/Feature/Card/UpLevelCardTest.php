<?php

namespace Tests\Feature\Card;

use App\Models\Card;
use App\Action\Card\UpLevelAction;
use Tests\TestCase;

class UpLevelCardTest extends TestCase
{
    public function test_if_repeats_over_0()
    {
        $card = Card::factory()
            ->state(['repeats' => rand(0, 1999), 'level' => 1])
            ->create();
        $card = UpLevelAction::execute($card);
        $this->assertEquals($card->level, 1);
    }
    public function test_if_repeats_over_2000()
    {
        $card = Card::factory()
            ->state(['repeats' => rand(2000, 4999), 'level' => 1])
            ->create();
        $card = UpLevelAction::execute($card);
        $this->assertEquals($card->level, 2);
    }

    public function test_if_repeats_over_5000()
    {
        $card = Card::factory()
            ->state(['repeats' => rand(5000, 9999), 'level' => 2])
            ->create();
        $card = UpLevelAction::execute($card);
        $this->assertEquals($card->level, 3);
    }

    public function test_if_repeats_over_10000()
    {
        $card = Card::factory()
            ->state(['repeats' => rand(10000, 99999), 'level' => 3])
            ->create();
        $card = UpLevelAction::execute($card);
        $this->assertEquals($card->level, 4);
    }
}