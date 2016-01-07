<?php
/**
 * Created by PhpStorm.
 * User: mtimion
 * Date: 12/30/15
 * Time: 7:54 PM
 */ 
class Timion_Orderphoto_Helper_Data extends Mage_Core_Helper_Abstract {

	const TIMION_ORDERPHOTO_DIR = 'timion_orderphoto';
	const TIMION_ORDERPHOTO_EXT = '.png';

	/**
	 * @param $orderId
	 * @return boolean
	 */
	public function photoExists($orderId) {
		$dir = $this->getBaseDir();
		$filename = $dir.$orderId.self::TIMION_ORDERPHOTO_EXT;
		$io = new Varien_Io_File();
		return $io->fileExists($filename);
	}

	/**
	 * @return string
	 * @throws Exception
	 */
	public function getBaseDir() {
		$io = new Varien_Io_File();
		$io->checkAndCreateFolder(Mage::getBaseDir('media').DS.self::TIMION_ORDERPHOTO_DIR);
		return Mage::getBaseDir('media').DS.self::TIMION_ORDERPHOTO_DIR.DS;
	}

	/**
	 * @param $orderId
	 * @return string
	 */
	public function getOrderPhotoUrl($orderId) {
		$url = Mage::getBaseUrl('media');
		$url .= DS.self::TIMION_ORDERPHOTO_DIR.DS.$orderId.self::TIMION_ORDERPHOTO_EXT;
		return $url;
	}

	public function getFilename($orderId) {
		return $orderId.self::TIMION_ORDERPHOTO_EXT;
	}
}