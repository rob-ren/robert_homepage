<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 18/4/17
 * Time: 3:04 PM
 */

namespace Robert\Bundle\DatabaseBundle\Command;

use Robert\Bundle\DatabaseBundle\Exceptions\EmailFormatErrorException;
use Robert\Bundle\DatabaseBundle\Business\UserBusinessModel;
use Robert\Bundle\DatabaseBundle\Entity\User;
use Robert\Bundle\DatabaseBundle\Exceptions\EmailNotAvailableException;
use Robert\Bundle\DatabaseBundle\Exceptions\PasswordNotSameException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{

    /**
     * set up configure information
     */
    protected function configure()
    {
        $this->setName('user:create')->setDescription('create user for the websites')->addArgument('email', InputArgument::REQUIRED, 'Input a valid email address.')->addArgument('password', InputArgument::REQUIRED, 'Type your password.')->addArgument('re-password', InputArgument::REQUIRED, 'Re-type your password.');
    }

    /**
     * valid email format
     */
    protected function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }


    /**
     * get User Business Model
     *
     * @return UserBusinessModel
     */
    protected function getUserBusinessModel()
    {
        return $this->getContainer()->get('user_business_model');

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // get input user info
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $re_password = $input->getArgument('re-password');
        $user_bm = $this->getUserBusinessModel();
        try {

            // check input info
            if (!$this->isValidEmail($email)) {
                throw new EmailFormatErrorException();
            }
            if ($password != $re_password) {
                throw new PasswordNotSameException();
            }
            if (!$user_bm->loadByEmail($email)) {
                throw new EmailNotAvailableException();
            }

            // create user actions
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setStatus(1);
            $user_bm->newUser($user);
            $output->writeln('You have create a new user successfully!');

        } catch (\Exception $e) {
            $output->writeln("Fail create." . $e->getMessage());
        }
    }
}