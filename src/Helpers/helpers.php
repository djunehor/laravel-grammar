<?php

if (! function_exists('part_of_speech')) {
    function part_of_speech($word)
    {
        return (new \Djunehor\Grammar\Word())->getWordPartOfSpeech($word);
    }
}

if (! function_exists('parts_of_speech')) {
    function parts_of_speech()
    {
        return (new \Djunehor\Grammar\Word())->getPartsOfSpeech();
    }
}
