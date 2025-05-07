<?php

namespace Ujamii\MailjetSubscription\Form\Finisher;

use Neos\Form\Core\Model\AbstractFinisher;
use Psr\Log\LoggerInterface;
use t3n\MailJetAdapter\Service\MailJetService;
use t3n\MailJetAdapter\ValueObject\MailJetContactEmail;

class MailjetSubscriptionFinisher extends AbstractFinisher
{
    private const string DEFAULT_CONTACT_NAME = '';

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
        try {
            if (null === $contact) {
                $contact = $this->mailjetService->addNewContact($email, self::DEFAULT_CONTACT_NAME);
            }

            foreach ($formValues['lists'] as $listId) {
                $result = $this->mailjetService->manageContactListForContact($contact, $listId);
                $this->logger->debug('Subscribing '.$email.' as contact to list '. $listId .': '. ($result ? 'Success' : 'Failed' ) );
            }
        } catch (\Exception $exception) {
            $this->logger->error('Failed to manage contact lists: '. $exception->getMessage());
        }
    }
}
