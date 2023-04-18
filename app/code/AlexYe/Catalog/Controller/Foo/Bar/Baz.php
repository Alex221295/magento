<?php

namespace AlexYe\Catalog\Controller\Foo\Bar;

use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Json;


class Baz extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    /**
     * @inheriDoc
     * https://magento-project.local/some-pretty-url/foo_bar/baz/string_parameter/same%20string/integer_value/12
     */
//alex_ye_catalog_foo_bar_baz
    public function execute()
    {

        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();


        /** @var Json $response */
//        $str = $this->getRequest()->getParam('string_parameter');
//        var_dump($str);
//        exit();

        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response->setData([
            'String value from request' =>$request->getParam('string_parameter'),
            'Integer value from request' => (int) $request->getParam('integer_value',4)
        ]);
        return $response;

    }
}
