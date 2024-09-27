<?php

namespace App\Search;

use Illuminate\Support\Str;
use TeamTNT\TNTSearch\Support\TokenizerInterface;

class AccentInsensitiveTokenizer implements TokenizerInterface
{
    static protected $pattern = '/[\s,\.]+/';

    public function tokenize($text, $stopwords = [])
    {
        $text = Str::ascii($text);
        $text = $this->removePunctuation($text);
        $tokens = preg_split($this->getPattern(), strtolower($text));
        return array_filter($tokens);
    }

    private function removePunctuation($text)
    {
        return preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
    }
    
    public function getPattern()
    {
        return self::$pattern;
    }
    
}
