<?php

namespace AlexYe\Catalog\Controller\Foo\Bar;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use \Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Redirect;


class RedirectExample extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    /**
     * @inheriDoc
     * https://magento-project.local/some-pretty-url/foo_bar/redirectExample
     */

    public function execute()
    {
        /** @var Redirect $response */

        $response = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $response->setHttpResponseCode(301);
        $response->setPath(
            'alex_ye_catalog/foo_bar/baz',
            [
                '_secure'=>true,
                'string_parameter'=> 'Redirect from another controller',
                'integer_value'=> 301,
            ]

        );
        return $response;

    }
}
