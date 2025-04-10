<?php

namespace Ujamii\MailjetSubscription\Form\Finisher;

use Neos\Form\Core\Model\AbstractFinisher;
use t3n\MailJetAdapter\Service\MailJetService;
use t3n\MailJetAdapter\ValueObject\MailJetContactEmail;

class MailjetSubscriptionFinisher extends AbstractFinisher
{
    public function __construct(private readonly MailJetService $mailjetService)
    {
    }

    protected function executeInternal(): void
    {
        $formRuntime = $this->finisherContext->getFormRuntime();
        $formValues = $formRuntime->getFormState()->getFormValues();
        $email = new MailJetContactEmail($formValues['email']);

        $contact = $this->mailjetService->getContactByEmail($email, false);
        if (null === $contact) {
            $contact = $this->mailjetService->addNewContact($email, $formValues['firstname'].' '.$formValues['lastname']);
        }

        foreach ($this->parseOption('lists') as $listId) {
            $this->mailjetService->manageContactListForContact($contact, $listId);
        }
    }
}
