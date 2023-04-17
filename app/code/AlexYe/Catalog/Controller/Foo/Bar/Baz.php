<?php

namespace AlexYe\Catalog\Controller\Foo\Bar;

use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\Json;


class Baz extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    /**
     * @inheriDoc
     */

    public function execute()
    {

        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        /**
         * https://magento-project.local/some-pretty-url/foo_bar/baz/stringParametr/same%20string/integerValue/12
         */
        /** @var Json $response */
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $response->setData([
            'String value from request' =>$request->getParam('string_parameter'),
            'Integer value from request' => (int) $request->getParam('integer_value')
        ]);
        return $response;


//        echo '123';
//        exit();
//        throw new \RuntimeException('This is just a demo controllet');
        // TODO: Implement execute() method.
    }
}
