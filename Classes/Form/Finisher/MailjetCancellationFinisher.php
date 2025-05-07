<?php

namespace Ujamii\MailjetSubscription\Form\Finisher;

use Neos\Form\Core\Model\AbstractFinisher;
use Psr\Log\LoggerInterface;
use t3n\MailJetAdapter\Service\MailJetService;
use t3n\MailJetAdapter\ValueObject\MailJetContactEmail;

class MailjetCancellationFinisher extends AbstractFinisher
{
    public function __construct(
        private readonly MailJetService $mailjetService,
        private readonly LoggerInterface $logger,
    ) {}

    protected function executeInternal(): void
    {
        $formRuntime = $this->finisherContext->getFormRuntime();
        $formValues = $formRuntime->getFormState()->getFormValues();
        $email = new MailJetContactEmail($formValues['email']);

        $contact = $this->mailjetService->getContactByEmail($email, false);

        if (null === $contact) {
            $this->logger->debug('No contact found in Mailjet for email '. $email);
            return;
        }

        try {
            foreach ($formValues['lists'] as $listId) {
                $result = $this->mailjetService->manageContactListForContact($contact, $listId, 'unsub');
                $this->logger->debug('Unsubscribing '.$email.' as contact to list '. $listId .': '. ($result ? 'Success' : 'Failed' ) );
            }
        } catch (\Exception $exception) {
            $this->logger->error('Failed to manage contact lists: '. $exception->getMessage());
        }
    }
}
