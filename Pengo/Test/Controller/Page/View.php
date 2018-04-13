<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Pengo\Test\Controller\Page;

use \Magento\Framework\App\Action\Action as Action;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Controller\Result\JsonFactory;

class View extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(Context $context,JsonFactory $resultJsonFactory){
       $this->resultJsonFactory = $resultJsonFactory;
       parent::__construct($context);
    }
    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $data = ['message' => 'Hello world!'];

        return $result->setData($data);
        //echo "HOLA MUNDO";
    } 

}
