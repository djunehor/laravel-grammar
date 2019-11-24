<?php

namespace Djunehor\Grammar;

class Word
{
    private $string;

    private $partsOfSpeech = [
        'prep.' => 'Preposition',
        'n.' => 'Noun',
        'v.' => 'Verb',
        'a.' => 'Adjective',
        'adv.' => 'Adverb',
        'pron.' => 'Pronoun',
        'interj.' => 'Interjection',
        'conj.' => 'Conjunction',
    ];

    private $table;

    public function __construct($string = null)
    {
        if ($string) {
            $this->string = $string;
        }
        $this->table = config('laravel-grammar.table', 'entries');
    }

    public function getPartsOfSpeech()
    {
        return array_values($this->partsOfSpeech);
    }

    public function getWordPartOfSpeech($string)
    {
        $this->string = $string;
        $row = \DB::table($this->table)->where('word', ucfirst($this->string))->first();

        return $row ? json_decode($row->word_type, true) : [];
    }

    public function checkIs($part)
    {
        return in_array($part, $this->getWordPartOfSpeech($this->string));
    }

    public function isNoun()
    {
        return $this->checkIs('Noun');
    }

    public function isPronoun()
    {
        return $this->checkIs('Pronoun');
    }

    public function isAdjective()
    {
        return $this->checkIs('Adjective');
    }

    public function isAdverb()
    {
        return $this->checkIs('Adverb');
    }

    public function isPreposition()
    {
        return $this->checkIs('Preposition');
    }

    public function isConjunction()
    {
        return $this->checkIs('Conjunction');
    }

    public function isInterjection()
    {
        return $this->checkIs('Interjection');
    }

    public function isVerb()
    {
        return $this->checkIs('Verb');
    }
}
