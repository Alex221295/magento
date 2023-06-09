<?php
declare(strict_types=1);

namespace AlexYe\LayoutDebug\Observer;

class Layout 
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer): void
    {
        $xml = $observer->getEvent()->getData('layout')->getXmlString();
        $writer = new \Zend\Log\Writer\Stream(BP . '/pub/layout_block.xml');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($xml);
    }
}
