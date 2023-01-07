<?php

namespace App\Translation;

use HeadlessChromium\Browser;
use HeadlessChromium\Communication\Connection;
use HeadlessChromium\Page;

class Translator
{

    private $tranurl = 'https://www.deepl.com/translator#';
    private $translate = [];
    private $devtoolsUrl = "ws://chrome:3000/";
    public function __construct()
    {
        require_once 'SHD.php';
    }

    private function getPage(string $url): Page
    {
        $connection = new Connection($this->devtoolsUrl);
        $connection->connect();
        $browser = new Browser($connection);
        $page = $browser->createPage();
        $page->navigate($url)->waitForNavigation();
        $page->addPreScript('example', ['onLoad' => true]);
        $screenshot = $page->screenshot([
            'captureBeyondViewport' => true,
            'clip' => $page->getFullPageClip(),
            'format' => 'jpeg', // default to 'png' - possible values: 'png', 'jpeg',
        ]);

        // save the screenshot
        $screenshot->saveToFile('./file.png');
        return $page;
    }

    private function getTranslationHTMLPage(string $word, string $sourceLang = 'en', string $targetLang = 'ru'): string
    {
        $this->tranurl = $this->tranurl . $sourceLang . '/' . $targetLang . '/' . $word;
        $page = $this->getPage($this->tranurl);
        sleep(1);
        $html = $page->getHtml();
        $page->close();
        return $html;
    }

    public function pars(string $html): void
    {
        $html = str_get_html($html);
        $i = 0;
        foreach ($html->find('span.tag_lemma') as $tagLemma) {
            $value = $tagLemma->find('a.dictLink', 0);
            if ($value) {
                $words["value"] = $value->plaintext;
            }
            $chatSpeech = $tagLemma->find('span.tag_wordtype', 0);
            if ($chatSpeech) {
                $words["chat_speech"] = $chatSpeech->plaintext;
            }
            $context = $tagLemma->find('span.tag_lemma_context', 0);
            if ($context) {
                $words["context"] = $context->plaintext;
            }
            $this->translate['dictionary'][$i] = $words;
            $i++;
        }
        $i = 0;
        foreach ($html->find('div.lemma_content') as $lemma_content) {
            $meaninggroup = $lemma_content->find('div.meaninggroup', 0);
            $translation_lines = $meaninggroup->find('div.translation_lines', 0);
            foreach ($translation_lines->find('div.translation') as $translation_lines) {
                $translation_desc = $translation_lines->find('div.translation_desc', 0)->plaintext;
                // $tag_trans = $translation_desc->find('div.tag_trans',0)->plaintext;
                $translation_desc = str_replace('  ', ' ', $translation_desc);
                $translation_desc = explode(' ', $translation_desc);
                $str = '';
                foreach ($translation_desc as $value) {
                    if ($value != 'Прослушать') {
                        $str = $str . " " . $value;
                    }
                }
                $this->translate['dictionary'][$i]['translation'][] = $str;
            }
            $i++;
        }
        foreach ($html->find('li.lmt__translations_as_text__item') as $li) {
            $this->translate['translate'][] = $li->plaintext;
        }
    }

    public function startTranslate(string $word, string $sourceLang = 'en', string $targetLang = 'ru'): array
    {
        $html = $this->getTranslationHTMLPage($word, $sourceLang, $targetLang);
        $this->pars($html);
        return $this->translate;
    }

    public static function translate(string $word, string $sourceLang = 'en', string $targetLang = 'ru'): array
    {
        return (new self)->startTranslate($word, $sourceLang, $targetLang);
    }

}
