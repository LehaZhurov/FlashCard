<?php

namespace Tests\Feature\Voiceover;

use App\Voiceover\Voiceover;
use Tests\TestCase;

class VoiceoverTest extends TestCase
{

    public function test_British_Daniel()
    {
        $word = 'green';
        $pronunciation = "British";
        $announcer = 'Daniel';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_British_Kate()
    {
        $word = 'green';
        $pronunciation = "British";
        $announcer = 'Kate';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_British_Malcolm()
    {
        $word = 'green';
        $pronunciation = "British";
        $announcer = 'Malcolm';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_British_Oliver()
    {
        $word = 'green';
        $pronunciation = "British";
        $announcer = 'Oliver';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_British_Serena()
    {
        $word = 'green';
        $pronunciation = "British";
        $announcer = 'Oliver';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_British_Stephanie()
    {
        $word = 'green';
        $pronunciation = "British";
        $announcer = 'Stephanie';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_American_Ava()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Ava';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_American_Evan()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Evan';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_American_Nathan()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Nathan';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_American_Samantha()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Samantha';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_American_Tom()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Tom';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_American_Zoe()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Zoe';
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
        $this->assertIsString($voiceoverUrl);
    }

    public function test_not_found_announcer()
    {
        $word = 'green';
        $pronunciation = "American";
        $announcer = 'Finger';
        $this->expectException(\Exception::class);
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
    }

    public function test_not_found_pronunciation()
    {
        $word = 'green';
        $pronunciation = "France";
        $announcer = 'Zoe';
        $this->expectException(\Exception::class);
        $voiceoverUrl = Voiceover::voice($word, $pronunciation, $announcer)->get();
    }
}
