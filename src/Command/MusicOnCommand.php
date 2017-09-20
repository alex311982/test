<?php

namespace Ecomitize\Command;

use Framework\Command\AbstractCommand;

/**
 * Class MusicOnCommand
 * @package Ecomitize\Command
 */
class MusicOnCommand extends AbstractCommand
{
    /**
     * This method will be invoked after Actual Command's execution
     */
    public function postExecution()
    {
        echo PHP_EOL ;
    }

    /**
     * @return bool
     */
    protected function processCommand(): bool
    {
        echo 'MUSIC ON';

        return true;
    }

}
