<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 18/4/17
 * Time: 5:18 PM
 */

namespace Robert\Bundle\DatabaseBundle\Exceptions;

class EmailNotAvailableException extends \Exception
{
    public function __construct()
    {
        parent::__construct("This email has already been used.");
    }
}