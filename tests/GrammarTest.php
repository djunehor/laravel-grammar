<?php

namespace Djunehor\Grammar\Test;

use Djunehor\Grammar\Word;

class GrammarTest extends TestCase
{
    /**
     * Grammar Object.
     * @var Word
     */
    protected $grammar;

    protected $wordPart = [
      0 => ['word' => 'Boy', 'part' => 'Noun'],
       1 => ['word' => 'Look', 'part' => 'Adjective'],
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->grammar = new Word();
    }

    public function testGrammarCanBeConstructed()
    {
        $this->assertInstanceOf(Word::class, $this->grammar);
    }

    public function testPartsOfSpeechCanBeRetrieved()
    {
        $partsOfSpeech = $this->grammar->getPartsOfSpeech();
        $this->assertTrue(is_array($partsOfSpeech));
        $this->assertTrue(count($partsOfSpeech) == 8);
    }

    public function testPartsOfSpeechCanBeRetrievedViaHelper()
    {
        $partsOfSpeech = parts_of_speech();
        $this->assertTrue(is_array($partsOfSpeech));
        $this->assertTrue(count($partsOfSpeech) == 8);
    }

    public function testCanGetWordPartOfSpeech()
    {
        $this->assertTrue(is_array($this->grammar->getWordPartOfSpeech('boy')));
    }

    public function testCanGetWordPartOfSpeechViaHelper()
    {
        $this->assertTrue(is_array(part_of_speech('boy')));
    }

    public function testCorrectWordPartOfSpeech()
    {
        $wordPart = $this->wordPart[rand(0, 1)];
        $receivedPart = $this->grammar->getWordPartOfSpeech($wordPart['word']);
        $this->assertTrue(in_array($wordPart['part'], $receivedPart));
    }

    public function testCheckPartOfSpeech()
    {
        $nounWord = 'Boy';
        $this->grammar->getWordPartOfSpeech($nounWord);

        $this->assertTrue($this->grammar->checkIs('Noun'));
    }

    public function testIsAdjective()
    {
        $adjWord = 'Look';
        $this->grammar->getWordPartOfSpeech($adjWord);

        $this->assertTrue($this->grammar->isAdjective());
    }
}
