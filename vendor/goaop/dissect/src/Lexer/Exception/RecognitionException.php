<?php

declare(strict_types=1);

namespace Dissect\Lexer\Exception;

use RuntimeException;

/**
 * Thrown when a lexer is unable to extract another token.
 *
 * @author Jakub Lédl <jakubledl@gmail.com>
 */
class RecognitionException extends RuntimeException
{
    protected int $sourceLine;

    /**
     * Constructor.
     *
     * @param int $line The line in the source.
     */
    public function __construct(int $line)
    {
        $this->sourceLine = $line;

        parent::__construct(sprintf("Cannot extract another token at line %d.", $line));
    }

    /**
     * Returns the source line number where the exception occured.
     *
     * @return int The source line number.
     */
    public function getSourceLine(): int
    {
        return $this->sourceLine;
    }
}
