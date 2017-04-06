<?php

namespace Robert\Bundle\AppBundle\Controller;

use Robert\Bundle\AppBundle\Exceptions\EmailFormatErrorException;
use Robert\Bundle\AppBundle\Exceptions\EmailMessageTooShortException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    /**
     * get into home page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('RobertAppBundle:Default:index.html.twig');
    }

    /**
     * valid email format
     */
    public function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
    }

    /**
     * send message action
     *
     * @return JsonResponse
     */
    public function applyMessageAction()
    {
        // get form input information
        $full_name = $this->get('Request')->get('full_name') ? $this->get('Request')->get('full_name') : null;
        $email_address = $this->get('Request')->get('email_address') ? $this->get('Request')->get('email_address') : null;
        $apply_message = $this->get('Request')->get('apply_message') ? $this->get('Request')->get('apply_message') : null;
        $translator = $this->get('translator');
        try {
            // verify email is valid
            if (!$this->isValidEmail($email_address)) {
                throw new EmailFormatErrorException();
            }
            // verify message length
            if (strlen($apply_message) < 10) {
                throw new EmailMessageTooShortException();
            }

            //create email template and send email
            $message = \Swift_Message::newInstance()
                ->setSubject("New Contact Information from " . $full_name . " !")
                ->setFrom($email_address)// my email info
                ->setTo("robertrennn@gmail.com")// my email info
                ->setBody("name: " . $full_name
                    . "\r\n email: " . $email_address
                    . "\r\n message: " . $apply_message
                );
            // send email
            $this->get('mailer')->send($message);
        } catch (\Exception $e) {
            return new JsonResponse(array('msg' => $translator->trans($e->getMessage())));
        }
        $success_msg = $translator->trans('pre_msg') . $full_name . $translator->trans('sub_msg');
        return new JsonResponse(array('msg' => $success_msg));
    }
}
