<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 18/4/17
 * Time: 5:11 PM
 */

namespace Robert\Bundle\DatabaseBundle\Exceptions;

class PasswordNotSameException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Input passwords are not same.");
    }
}