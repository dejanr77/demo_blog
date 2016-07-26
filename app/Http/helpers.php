<?php
/**
 * Get a shortened text.
 *
 * @param $text
 * @param $words_count
 * @param string $marker
 * @return string
 */
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

/**
 * Get a classes string depending on the path.
 *
 * @param $path
 * @param $active
 * @return string
 */
function set_active($path, $active = 'active', $inactive = 'inactive')
{
    return Request::is($path) ? $active  : $inactive;
}
