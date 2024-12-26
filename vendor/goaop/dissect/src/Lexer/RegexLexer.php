<?php

declare(strict_types=1);

namespace Dissect\Lexer;

use Dissect\Lexer\TokenStream\ArrayTokenStream;
use Dissect\Lexer\TokenStream\TokenStream;
use Dissect\Parser\Parser;

/**
 * Fast regex lexer, adapted from Doctrine.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author Jonathan Wage <jonwage@gmail.com>
 * @author Roman Borschel <roman@code-factory.org>
 * @author Jakub Lédl <jakubledl@gmail.com>
 * @see \Dissect\Lexer\RegexLexerTest
 */
abstract class RegexLexer implements Lexer
{
    /**
     * {@inheritDoc}
     */
    public function lex(string $string): TokenStream
    {
        static $regex;

        if (!isset($regex)) {
            $regex = '/(' . implode(')|(', $this->getCatchablePatterns()) . ')|'
                . implode('|', $this->getNonCatchablePatterns()) . '/i';
        }

        $string = strtr($string, ["\r\n" => "\n", "\r" => "\n"]);

        $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
        $matches = preg_split($regex, $string, -1, $flags);
        $tokens = [];
        $line = 1;
        $oldPosition = 0;

        foreach ($matches as $match) {
            list ($value, $position) = $match;

            $type = $this->getType($value);

            if ($position > 0) {
                $line += substr_count($string, "\n", $oldPosition, $position - $oldPosition);
            }

            $oldPosition = $position;

            $tokens[] = new CommonToken($type, $value, $line);
        }

        $tokens[] = new CommonToken(Parser::EOF_TOKEN_TYPE, '', $line);

        return new ArrayTokenStream(...$tokens);
    }

    /**
     * The patterns corresponding to tokens.
     */
    abstract protected function getCatchablePatterns(): array;

    /**
     * The patterns corresponding to tokens to be skipped.
     */
    abstract protected function getNonCatchablePatterns(): array;

    /**
     * Retrieves the token type.
     */
    abstract protected function getType(string &$value): string;
}
