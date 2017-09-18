<?php

namespace Ecomitize\Command;

use Framework\Command\AbstractCommand;

class FlyCommand extends AbstractCommand
{
    /**
     * This method will be invoked after Actual Command's execution
     */
    public function postExecution()
    {
        echo PHP_EOL ;
    }

    protected function processCommand(): bool
    {
        echo 'FLY';

        return true;
    }

}
