<?php

namespace App\Voiceover;

use App\Voiceover\VoiceoverAbstract;
use HeadlessChromium\Browser;
use HeadlessChromium\Communication\Connection;
use \HeadlessChromium\Page;

class Voiceover extends VoiceoverAbstract
{

    protected $url = 'https://ttsdemo.voicereader.org/VoiceReaderHome22_VoicesDemo/';
    protected $handless = false;
    private $devtoolsUrl = "ws://chrome:3000/";
    public $text;
    public $pronunciation;
    public $announcer;
    public $selectOptionsId = [
        //Доступные прозношения
        'British' => [
            'num' => 5,
            //Доступные дикторы
            'announcer' => [
                'Daniel' => 3,
                'Kate' => 4,
                'Malcolm' => 5,
                'Oliver' => 6,
                'Serena' => 7,
                'Stephanie' => 8,
            ],
        ],
        'American' => [
            'num' => 3,
            'announcer' => [
                'Ava' => 3,
                'Evan' => 5,
                'Nathan' => 5,
                'Samantha' => 6,
                'Tom' => 7,
                'Zoe' => 8,
            ],
        ],
    ];
    public function __construct(string $text, string $pronunciation, string $announcer)
    {
        $this->text = $text;
        $this->pronunciation = $pronunciation;
        $this->announcer = $announcer;
        $this->validate();
    }

    protected function validate()
    {
        if (!array_key_exists($this->pronunciation, $this->selectOptionsId)) {
            throw new Exception('Такое произношение не найдено ' . $this->pronunciation);
        }
        if (!array_key_exists($this->announcer, $this->selectOptionsId[$this->pronunciation]['announcer'])) {
            throw new Exception('Такой диктор не найден ' . $this->announcer);
        }
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

    protected function clickChoiceLanguageList(Page $page)
    {
        $selectId = "#Content_MainCallbackPanel_MainFormLayout_languagesCombo_B-1";
        $page->mouse()->find($selectId)->click();
        return true;
    }

    protected function choiceLanguage(Page $page)
    {
        $optionClass = '.dxeListBoxItemRow_iOS';
        $optionNum = $this->selectOptionsId[$this->pronunciation]['num'];
        $page->mouse()->find($optionClass, $optionNum)->click();
        return true;
    }

    protected function clickChoiceAnnouncerList(Page $page)
    {
        $selectId = "#Content_MainCallbackPanel_MainFormLayout_voicesCombo_B-1";
        $page->mouse()->find($selectId)->click();
        return true;
    }

    protected function choiceAnnouncer(Page $page)
    {
        $optionClass = '.dxeListBoxItemRow_iOS';
        $optionNum = $this->selectOptionsId[$this->pronunciation]['announcer'][$this->announcer];
        $page->mouse()->find($optionClass, $optionNum)->click();
        return true;
    }

    protected function clickListenButton(Page $page)
    {
        $buttonId = '#Content_MainCallbackPanel_MainFormLayout_playButton_CD';
        $this->click($page, $buttonId);
        return true;
    }

    protected function inputText(Page $page): bool
    {
        $textareaId = '#Content_MainCallbackPanel_MainFormLayout_demoTextEdit_I';
        $this->setValue($page, $textareaId, $this->text);
        return true;
    }

    public function get(): string
    {
        $page = $this->getPage();
        if ($this->pronunciation != 'American') {
            $listView = $this->clickChoiceLanguageList($page);
            $this->choiceLanguage($page);
            sleep(1);
        }
        $this->clickChoiceAnnouncerList($page);
        sleep(1);
        $this->choiceAnnouncer($page);
        sleep(1);
        $this->inputText($page);
        sleep(1);
        $this->clickListenButton($page);
        sleep(1);
        return $this->getSrc($page, '#audioObject');
    }

    public static function voice(string $text, string $pronunciation = 'British', string $announcer = 'Malcolm')
    {
        return (new self($text, $pronunciation, $announcer));
    }
}
