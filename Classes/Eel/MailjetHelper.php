<?php

namespace Ujamii\MailjetSubscription\Eel;

use Neos\Flow\Annotations as Flow;
use Mailjet\Resources;
use Neos\Eel\ProtectedContextAwareInterface;
use Mailjet\Client;

class MailjetHelper implements ProtectedContextAwareInterface
{
    private const int MAILJET_CONNECTION_TIMEOUT = 10;

    /**
     * @var Client
     */
    #[Flow\Inject]
    protected $mailjetClient;


    public function getListName(int $listId): string
    {
        $lists = [];
        $this->mailjetClient->setConnectionTimeout(self::MAILJET_CONNECTION_TIMEOUT);
        $response = $this->mailjetClient->get(Resources::$Contactslist, ['filters' => ['IsDeleted' => false, 'Limit' => 100, 'Sort' => 'Name']]);

        if (true === $response->success()) {
            $data = $response->getData();
            foreach ($data as $list) {
                $lists[$list['ID']] = $list['Name'];
            }
        }

        return $lists[$listId] ?? '&lt;unknown&gt; List';
    }

    public function allowsCallOfMethod($methodName): bool
    {
        return true;
    }
}
