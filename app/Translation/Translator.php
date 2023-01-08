<?php

namespace App\Translation;

use HeadlessChromium\Browser;
use HeadlessChromium\Communication\Connection;
use HeadlessChromium\Page;

class Translator
{

    private $tranurl = 'https://www.deepl.com/translator#';
    private $translate = ['dictionary' => [], 'translate' => [],'powered' => 'deepl.com'];
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
        sleep(3);
        return $page;
    }

    private function getTranslationHTMLPage(string $word, string $sourceLang = 'en', string $targetLang = 'ru'): string
    {
        $this->tranurl = $this->tranurl . $sourceLang . '/' . $targetLang . '/' . $word;
        $page = $this->getPage($this->tranurl);
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
        foreach ($html->find('div.lemma_content') as $lemmaConten) {
            $meaninggroup = $lemmaConten->find('div.meaninggroup', 0);
            $translationLines = $meaninggroup->find('div.translation_lines', 0);
            foreach ($translationLines->find('div.translation') as $translationLines) {
                $translationDesc = $translationLines->find('div.translation_desc', 0)->plaintext;
                // $tag_trans = $translationDesc->find('div.tag_trans',0)->plaintext;
                $translationDesc = str_replace('  ', ' ', $translationDesc);
                $translationDesc = explode(' ', $translationDesc);
                $str = '';
                foreach ($translationDesc as $value) {
                    if ($value != 'Прослушать') {
                        $str = $str . " " . $value;
                    }
                }
                $this->translate['dictionary'][$i]['translation'][] = $str;
            }
            $i++;
        }
        foreach ($html->find('button.lmt__translations_as_text__text_btn') as $button) {
            $this->translate['translate'][] = $button->plaintext;
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
