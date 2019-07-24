<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Form\Handler;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

class RegistrationFormHandler  extends BaseHandler
{
   
    /**
     * @param boolean $confirmation
     */
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        if ($confirmation) {
            //$user->setEnabled(false);
            if (null === $user->getConfirmationToken()) {
                $user->setConfirmationToken($this->tokenGenerator->generateToken());
            }

            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
            //$user->setEnabled(true);
        }

        $this->userManager->updateUser($user);
    }

    
}
