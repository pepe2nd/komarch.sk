<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Search\AccentInsensitiveTokenizer;

class AccentInsensitiveTokenizerTest extends TestCase
{
    protected $tokenizer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tokenizer = new AccentInsensitiveTokenizer();
    }

    public function test_tokenize_removes_accents_in_slovak()
    {
        $text = 'Ľúbim slivovicu, čučoriedky, a žlté hrušky';
        $expectedTokens = ['lubim', 'slivovicu', 'cucoriedky', 'a', 'zlte', 'hrusky'];

        $tokens = $this->tokenizer->tokenize($text);

        $this->assertEquals($expectedTokens, $tokens);
    }

    public function test_tokenize_handles_slovak_with_punctuation()
    {
        $text = 'Čo sa stalo s ďatelinou, kde je môj kôň?';
        $expectedTokens = ['co', 'sa', 'stalo', 's', 'datelinou', 'kde', 'je', 'moj', 'kon'];

        $tokens = $this->tokenizer->tokenize($text);

        $this->assertEquals($expectedTokens, $tokens);
    }

    public function test_tokenize_handles_mixed_case_in_slovak()
    {
        $text = 'Stretneme sa na Štrkoveckom jazere';
        $expectedTokens = ['stretneme', 'sa', 'na', 'strkoveckom', 'jazere'];

        $tokens = $this->tokenizer->tokenize($text);

        $this->assertEquals($expectedTokens, $tokens);
    }

    public function test_tokenize_removes_accents_from_slovak_names()
    {
        $text = 'Žofia išla k Jozefovi a Ľubomír tam nebol';
        $expectedTokens = ['zofia', 'isla', 'k', 'jozefovi', 'a', 'lubomir', 'tam', 'nebol'];

        $tokens = $this->tokenizer->tokenize($text);

        $this->assertEquals($expectedTokens, $tokens);
    }
}
