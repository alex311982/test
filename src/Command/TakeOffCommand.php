<?php

namespace Ecomitize\Command;

use Framework\Command\AbstractCommand;

/**
 * Class TakeOffCommand
 * @package Ecomitize\Command
 */
class TakeOffCommand extends AbstractCommand
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
        echo 'TAKE OFF';

        return true;
    }

}
