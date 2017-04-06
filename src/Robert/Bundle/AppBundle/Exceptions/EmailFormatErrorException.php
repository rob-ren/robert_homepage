<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 3/4/17
 * Time: 12:42 PM
 */

namespace Robert\Bundle\AppBundle\Exceptions;

class EmailFormatErrorException extends \Exception
{
    public function __construct()
    {
        parent::__construct("invalid_email");
    }
}