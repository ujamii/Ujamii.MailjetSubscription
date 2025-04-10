<?php

namespace Ujamii\MailjetSubscription\DataSource;

use Mailjet\Client;
use Mailjet\Resources;
use Neos\Flow\Annotations as Flow;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Neos\Service\DataSource\AbstractDataSource;

class MailJetListDataSource extends AbstractDataSource
{
    protected static $identifier = 'ujamii-mailjet-subscription-list';

    /**
     * @var Client
     */
    #[Flow\Inject]
    protected $mailjetClient;

    public function getData(?NodeInterface $node = null, array $arguments = []): array
    {
        $options = [];
        $response = $this->mailjetClient->get(Resources::$Contactslist, ['filters' => ['IsDeleted' => false, 'Limit' => 100, 'Sort' => 'Name']]);

        if (true === $response->success()) {
            $data = $response->getData();
            foreach ($data as $list) {
                $options[] = [
                    'label' => $list['Name'],
                    'value' => $list['ID'],
                ];
            }
        }

        return $options;
    }
}
