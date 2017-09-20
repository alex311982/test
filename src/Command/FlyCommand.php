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

    public function __construct(?string $delimiter)
    {
        if (is_null($delimiter)) {
            $delimiter = '';
        }
        $this->delimiter = $delimiter;
    }

    /**
     * This method will be invoked after Actual Command's execution
     */
    public function postExecution()
    {
        echo $this->delimiter;
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
