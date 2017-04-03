<?php

namespace Robert\Bundle\AppBundle\Controller;

use Robert\Bundle\AppBundle\Exceptions\EmailFormatErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * get into home page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('RobertAppBundle:Default:index.html.twig', array(
            'enquire_msg' => null
        ));
    }

    /**
     * valid email format
     */
    public function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    /**
     * apply message action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function applyMessageAction()
    {
        // get form input information
        $full_name = $this->get('Request')->get('full_name') ? $this->get('Request')->get('full_name') : null;
        $email_address = $this->get('Request')->get('email_address') ? $this->get('Request')->get('email_address') : null;
        $apply_message = $this->get('Request')->get('apply_message') ? $this->get('Request')->get('apply_message') : null;
        $enquire_msg = "apply_successfully";
        try {
            //create email template and send email
            $message = \Swift_Message::newInstance()
                ->setSubject("New Contact Information from " . $full_name . " !")
                ->setFrom("robertrennn@gmail.com")// my email info
                ->setTo("robertrennn@gmail.com")// my email info
                ->setBody("name: " . $full_name
                    . "\r\n email: " . $email_address
                    . "\r\n message: " . $apply_message
                );

            // verify email is valid
            if (!$this->isValidEmail($email_address)) {
                $enquire_msg = "invalid_email_format";
                throw new EmailFormatErrorException();
            }
            // send email
            $this->get('mailer')->send($message);


        } catch (\Exception $e) {
            return $this->render("RobertAppBundle:Default:index.html.twig", array(
                'enquire_msg' => $enquire_msg
            ));
        }
        return $this->render("RobertAppBundle:Default:index.html.twig", array(
            'enquire_msg' => $enquire_msg
        ));
    }
}
