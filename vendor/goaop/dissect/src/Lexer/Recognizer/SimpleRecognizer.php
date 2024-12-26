<?php

declare(strict_types=1);

namespace Dissect\Lexer\Recognizer;

/**
 * SimpleRecognizer matches a string by a simple
 * strpos match.
 *
 * @author Jakub Lédl <jakubledl@gmail.com>
 * @see \Dissect\Lexer\Recognizer\SimpleRecognizerTest
 */
class SimpleRecognizer implements Recognizer
{
    protected string $string;

    /**
     * Constructor.
     *
     * @param string $string The string to match by.
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * {@inheritDoc}
     */
    public function match(string $string, ?string &$result = null): bool
    {
        if (strncmp($string, $this->string, strlen($this->string)) === 0) {
            $result = $this->string;

            return true;
        }

        return false;
    }
}
