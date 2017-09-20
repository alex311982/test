<?php

namespace Ecomitize\Command;

use Framework\Command\AbstractCommand;

/**
 * Class StartCommand
 * @package Ecomitize\Command
 */
class StartCommand extends AbstractCommand
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
        echo 'START';

        return true;
    }

}
