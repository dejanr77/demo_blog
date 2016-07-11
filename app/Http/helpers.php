<?php

function shortenText($text, $words_count, $marker = '...')
{
    if(str_word_count($text, 0) > $words_count)
    {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);

        $text = substr($text, 0, $pos[$words_count]).$marker;
    }

    return $text;
}

