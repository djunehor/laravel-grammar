<?php

namespace Djunehor\Grammar\Test;

use Djunehor\Grammar\Word;

class GrammarTest extends TestCase
{
    /**
     * Identify Object.
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

    /**
     * Test if Identify can be constructed.
     */
    public function testGrammarCanBeConstructed()
    {
        $this->assertInstanceOf(Word::class, $this->grammar);
    }

    /**
     * Test if Os is constructed on Identify Object created.
     */
    public function testPartsOfSpeechCanBeRetrieved()
    {
        $partsOfSpeech = $this->grammar->getPartsOfSpeech();
        $this->assertTrue(is_array($partsOfSpeech));
        $this->assertTrue(count($partsOfSpeech) == 8);
    }

    /**
     * Test if Device is constructed on Identify Object created.
     */
    public function testCanGetWordPartOfSpeech()
    {
        $this->assertTrue(is_array($this->grammar->getWordPartOfSpeech('boy')));
    }

    /**
     * Test if Device is constructed on Identify Object created.
     */
    public function testCorrectWordPartOfSpeech()
    {
        $wordPart = $this->wordPart[rand(0, 1)];
        $receivedPart = $this->grammar->getWordPartOfSpeech($wordPart['word']);
        $this->assertTrue(in_array($wordPart['part'], $receivedPart));
    }

    /**
     * Test if Device is constructed on Identify Object created.
     */
    public function testCheckPartOfSpeech()
    {
        $nounWord = 'Boy';
        $this->grammar->getWordPartOfSpeech($nounWord);

        $this->assertTrue($this->grammar->checkIs('Noun'));
    }

    /**
     * Test if Device is constructed on Identify Object created.
     */
    public function testIsAdjective()
    {
        $adjWord = 'Look';
        $this->grammar->getWordPartOfSpeech($adjWord);

        $this->assertTrue($this->grammar->isAdjective());
    }
}
