<?php

class Timion_Orderphoto_SaveController extends Mage_Core_Controller_Front_Action
{

    /**
     * Saves photo from AJAX post in file system
     */
   public function photoAction() {
       $_helper = Mage::helper('timion_orderphoto');
       $orderId = $this->getRequest()->getParam('id');
       $img = $_POST['canvas'];
       $img = str_replace('data:image/png;base64,', '', $img);
       $img = str_replace(' ', '+', $img);
       $fileData = base64_decode($img);
//saving
       $fileName = $_helper->getFilename($orderId);
       $dir = $_helper->getBaseDir();
       $fileName = $dir.$fileName;
       file_put_contents($fileName, $fileData);
       echo $orderId;
       exit();
   }
}
