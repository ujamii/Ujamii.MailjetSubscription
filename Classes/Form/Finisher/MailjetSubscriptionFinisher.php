<?php

namespace Ujamii\MailjetSubscription\Form\Finisher;

use Neos\Form\Core\Model\AbstractFinisher;

class MailjetSubscriptionFinisher extends AbstractFinisher
{
    protected function executeInternal(): void
    {
        $formRuntime = $this->finisherContext->getFormRuntime();
        $formValues = $formRuntime->getFormState()->getFormValues();
    }
}
