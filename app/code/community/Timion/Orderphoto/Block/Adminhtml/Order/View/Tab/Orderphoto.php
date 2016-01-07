<?php
class Timion_Orderphoto_Block_Adminhtml_Order_View_Tab_Orderphoto
	extends Mage_Adminhtml_Block_Template
	implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
	//change _constuct to _construct()
	public function _construct()
	{
		parent::_construct();
		$this->setTemplate('timion_orderphoto/order/view/tab/photo.phtml');
	}

	public function getTabLabel() {
		return $this->__('Order Photo');
	}

	public function getTabTitle() {
		return $this->__('Order Photo');
	}

	public function canShowTab() {
		return true;
	}

	public function isHidden() {
		return false;
	}

	public function getOrder(){
		return Mage::registry('current_order');
	}
}
?>