<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 4/4/17
 * Time: 4:35 PM
 */

namespace Robert\Bundle\AppBundle\Exceptions;

class EmailMessageTooShortException extends \Exception
{
    public function __construct()
    {
        parent::__construct("invalid_message");
    }
}