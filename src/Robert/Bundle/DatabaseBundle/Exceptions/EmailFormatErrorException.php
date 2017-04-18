<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 3/4/17
 * Time: 12:42 PM
 */

namespace Robert\Bundle\DatabaseBundle\Exceptions;

class EmailFormatErrorException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Invalid Email Format");
    }
}