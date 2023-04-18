<?php

namespace AlexYe\Catalog\Controller\Foo\Bar;

use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;


class HtmlResponse extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{

    /**
     * @inheriDoc
     * https://magento-project.local/some-pretty-url/foo_bar/htmlResponse
     */

    public function execute()
    {
        /** @var Page $response */
        $response = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        return $response;

    }
}
