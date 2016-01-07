<?php

class Timion_Orderphoto_CheckController extends Mage_Core_Controller_Front_Action
{

    /**
     * checks to see if image exists for order id
     */
   public function orderAction() {
       $orderId = $this->getRequest()->getParam('id');
       if (Mage::helper('timion_orderphoto')->photoExists($orderId)) {
           echo $orderId; //image exists
       } else {
           $this->loadLayout();
           $myBlock = $this->getLayout()->createBlock('core/template');
           $myBlock->setTemplate('timion_orderphoto/order/view/photobooth.phtml');
           $myHtml =  $myBlock->toHtml();
           echo $myHtml;
           exit();
       }
       exit();
   }
}
