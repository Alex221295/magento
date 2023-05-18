<?php

namespace AlexYe\EmailDemo\Model;

use Magento\Framework\App\Area;

class Email
{
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     */
    private $transportBuilder;

    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     */
    private $inlineTranslation;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    private $storeManager;

    /**
     * Initialize dependencies.
     *
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
    }

    /**
     * Send demo email from controller
     *
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function send(): void
    {
        $templateVariables = [
            'name' => 'Alex Ye',
            'email' => 'email@example.com'
        ];

        $this->inlineTranslation->suspend();

        try {
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('alex_ye_email_demo')
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId()
                    ]
                )
                ->setTemplateVars($templateVariables)
                ->setFromByScope('support')
                // Must get recipient from config instead of hardcoding the email
                ->addTo('recipient@example.com')
                ->setReplyTo('TKDLexa3@meta.ua', 'Alex Alex')
                ->getTransport();

            $transport->sendMessage();
        } finally {
            $this->inlineTranslation->resume();
        }
    }
}
