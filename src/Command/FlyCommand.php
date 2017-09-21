<?php

namespace Ecomitize\Command;

use Framework\Command\AbstractCommand;

/**
 * Class FlyCommand
 * @package Ecomitize\Command
 */
class FlyCommand extends AbstractCommand
{
    protected $delimiter;

    /**
     * This method will be invoked after Actual Command's execution
     */
    public function postExecution()
    {
        echo PHP_EOL;
    }

    /**
     * @return bool
     */
    protected function processCommand(): bool
    {
        echo 'FLY';

        return true;
    }

}
