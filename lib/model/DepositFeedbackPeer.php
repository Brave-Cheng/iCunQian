<?php

/**
 * Subclass for performing query and update operations on the 'deposit_feedback' table.
 *
 * 
 *
 * @package lib\model
 */ 
class DepositFeedbackPeer extends BaseDepositFeedbackPeer
{

    /**
     * Create feedback
     *
     * @param string $email   email 
     * @param string $message feedback content
     *
     * @return object DepositFeedback
     *
     * @issue 2641
     */
    public function createFeedback($email, $message) {
        try {
            $feedback = new DepositFeedback();
            $feedback->setEmail($email);
            $feedback->setContent($message);
            $feedback->save();
            self::sendFeedbackEmail($feedback);
            return $feedback;
        } catch (Exception $e) {
            throw $e;
                                    
        }
        
    }

    /**
     * Send feedback email
     *
     * @param object $feedback DepositFeedback
     * 
     * @return void
     *
     * @issue 2641
     */
    public function sendFeedbackEmail($feedback) {
        try {
            if ($feedback->getEmail()) {
                $mailer = $feedback->getEmail();
            } else {
                $mailer = $feedback->getDepositMembers()->getEmail();
            }
            $mailTemplate = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'iCunQian-Feedback.html';
            $body = file_get_contents($mailTemplate);
            if (empty($body)) {
                throw new ObjectsException(
                    ObjectsException::$error2002,
                    sprintf(
                        util::getMultiMessage('Fetch mail template (%s) error.'),
                        $mailTemplate
                    )
                );
            }
            
            $body = str_replace('{email}', $mailer, $body);
            $body = str_replace('{datetime}', date('Y-m-d'), $body);

            $subject = util::getMultiMessage('Tanks For Feedback');
            util::mailTo($mailer, $subject, $body);
            $feedback->setMailSendStatus(DepositMembersPeer::YES);
            $feedback->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

    


}
