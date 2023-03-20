<?php

namespace App\Voiceover;

use App\Voiceover\VoiceoverAbstract;
use HeadlessChromium\Browser;
use HeadlessChromium\Communication\Connection;
use \HeadlessChromium\Page;

class Voiceover extends VoiceoverAbstract
{
    protected $url = 'https://ttsdemo.voicereader.org/VoiceReaderHome22_VoicesDemo/';
    private $devtoolsUrl = "ws://chrome:3000/";
    protected $handless = false;
    protected $languageInputPossibleValue = [
        'British' => 'English (British)',
    ];
    protected $possibleAnnouncers = [
        'Daniel' => 'Daniel',
        'Kate' => 'Kate',
        'Malcolm' => 'Malcolm',
        'Oliver' => 'Oliver',
        'Serena' => 'Serena',
        'Stephanie' => 'Stephanie',
    ];
    public $text;
    public $pronunciation;
    public $announcer;

    public function __construct(string $text, string $pronunciation, string $announcer)
    {
        $this->text = $text;
        $this->pronunciation = $pronunciation;
        $this->announcer = $announcer;
    }

    protected function getPage(): Page
    {
        $connection = new Connection($this->devtoolsUrl);
        $connection->connect();
        $browser = new Browser($connection);
        $page = $browser->createPage();
        $page->navigate($this->url)->waitForNavigation();
        return $page;
    }

    protected function setValue(Page $page, string $cssSelector, string $value)
    {
        $script = $page->evaluate('document.querySelector("' . $cssSelector . '").value="' . $value . '"');
        return $script->getReturnValue();
    }

    protected function getSrc(Page $page, string $cssSelector): string
    {
        $script = $page->evaluate('document.querySelector("' . $cssSelector . '").src');
        return $script->getReturnValue();
    }

    protected function click(Page $page, string $cssSelector)
    {
        $script = $page->evaluate("document.querySelector('" . $cssSelector . "').click()");
        return $script->getReturnValue();
    }

    protected function choiceLanguage(Page $page): bool
    {
        try {
            $inputValue = $this->languageInputPossibleValue[$this->pronunciation];
        } catch (Exception $e) {
            throw new Exception("Error: Такое произнощение не найдено");
        }
        $inputId = '#Content_MainCallbackPanel_MainFormLayout_languagesCombo_I';
        $this->setValue($page, $inputId, $inputValue);
        return true;
    }

    protected function choiceAnnouncer(Page $page): bool
    {
        try {
            $inputValue = $this->possibleAnnouncers[$this->announcer];
        } catch (Exception $e) {
            throw new Exception("Error: Такой диктор не найден");
        }
        $inputId = '#Content_MainCallbackPanel_MainFormLayout_voicesCombo_I';
        $this->setValue($page, $inputId, $inputValue);
        return true;
    }

    protected function inputText(Page $page): bool
    {
        $textareaId = '#Content_MainCallbackPanel_MainFormLayout_demoTextEdit_I';
        $this->setValue($page, $textareaId, $this->text);
        return true;
    }

    protected function clickListenButton(Page $page)
    {
        $buttonId = '#Content_MainCallbackPanel_MainFormLayout_playButton_CD';
        $this->click($page, $buttonId);
        return true;
    }

    public function get(): string
    {
        $page = $this->getPage();
        $choicedLanguage = $this->choiceLanguage($page);
        $choicedAnnouncer = $this->choiceAnnouncer($page);
        $inputedText = $this->inputText($page);
        if ($choicedLanguage && $choicedAnnouncer && $inputedText) {
            $this->clickListenButton($page);
        }
        sleep(1);
        return $this->getSrc($page, '#audioObject');
    }

    public static function newClient(string $text, string $pronunciation, string $announcer = 'Malcolm')
    {
        return (new self($text, $pronunciation, $announcer));
    }
}
