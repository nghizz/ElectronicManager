<?php

declare(strict_types=1);

namespace Dissect\Parser\LALR1\Dumper;

/**
 * A table dumper for production
 * environment - the dumped table
 * is compact, whitespace-free and
 * without any comments.
 *
 * @author Jakub Lédl <jakubledl@gmail.com>
 * @see \Dissect\Parser\LALR1\Dumper\ProductionTableDumperTest
 */
class ProductionTableDumper implements TableDumper
{
    /**
     * {@inheritDoc}
     */
    public function dump(array $table): string
    {
        $writer = new StringWriter();

        $this->writeIntro($writer);

        foreach ($table['action'] as $num => $state) {
            $this->writeState($writer, $num, $state);
            $writer->write(',');
        }

        $this->writeMiddle($writer);

        foreach($table['goto'] as $num => $map) {
            $this->writeGoto($writer, $num, $map);
            $writer->write(',');
        }

        $this->writeOutro($writer);

        $writer->write("\n"); // eof newline

        return $writer->get();
    }

    protected function writeIntro(StringWriter $writer)
    {
        $writer->write("<?php return ['action'=>[");
    }

    protected function writeState(StringWriter $writer, $num, $state)
    {
        $writer->write($num . '=>[');

        foreach ($state as $trigger => $action) {
            $this->writeAction($writer, $trigger, $action);
            $writer->write(',');
        }

        $writer->write(']');
    }

    protected function writeAction(StringWriter $writer, $trigger, $action)
    {
        $writer->write(sprintf(
            "'%s'=>%d",
            $trigger,
            $action
        ));
    }

    protected function writeMiddle(StringWriter $writer)
    {
        $writer->write("],'goto'=>[");
    }

    protected function writeGoto(StringWriter $writer, $num, $map)
    {
        $writer->write($num . '=>[');

        foreach ($map as $trigger => $destination) {
            $writer->write(sprintf(
                "'%s'=>%d",
                $trigger,
                $destination
            ));

            $writer->write(',');
        }

        $writer->write(']');
    }

    protected function writeOutro(StringWriter $writer)
    {
        $writer->write(']];');
    }
}
