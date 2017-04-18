<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 18/4/17
 * Time: 3:29 PM
 */

namespace Robert\Bundle\DatabaseBundle\Business;

use Robert\Bundle\DatabaseBundle\Common\SHAEncoder;
use Robert\Bundle\DatabaseBundle\Common\StringHelper;
use Robert\Bundle\DatabaseBundle\Entity\User;

class UserBusinessModel extends AbstractBusinessModel
{

    protected $encoder;

    public function __construct($doctrine)
    {
        parent::__construct($doctrine);
        $this->entity = new User();
        $this->encoder = new SHAEncoder();
    }

    /**
     * @param User $user
     * @return \Robert\Bundle\DatabaseBundle\Entity\User
     */
    public function newUser(User $user)
    {
        $salt = StringHelper::generateRandomString("10");
        $user->setUsername($user->getEmail());
        $user->setPassword($this->encoder->encodePassword($user->getPassword(), $salt));
        $user->setSalt($salt);
        $this->persistEntity($user);
        return $user;
    }

    /**
     * validate email is existed
     *
     * @param $email
     * @return bool
     */
    public function loadByEmail($email){
        $criteria = array (
            'email' => $email
        );
        $user = $this->getRepository ()->findOneBy ( $criteria );
        if ($user) {
            return false;
        }
        return $email;
    }
}