<?php
$basePath = dirname(__FILE__);
require_once($basePath . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Mobile_Detect.php');

/**
 * Wrapper for Mobile_Detect @link https://github.com/serbanghita/Mobile-Detect
 * @author Alexey Salnikov <me@iamsalnikov.ru>
 */

class MobileDetect extends CApplicationComponent
{
    private $_mobileDetect;

    public function init()
    {
        $this->_mobileDetect = new CMobile_Detect();
    }

    public function __call($name, $parameters)
    {
        return call_user_func_array(array($this->_mobileDetect, $name), $parameters);
    }
	
	public function isSmartPhone(){
		return ($this->_mobileDetect->isiOS() || $this->_mobileDetect->isAndroidOS() || $this->_mobileDetect->isWindowsMobileOS()) && !$this->_mobileDetect->isTablet();
	}
}
