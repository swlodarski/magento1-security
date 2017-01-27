<?php
require_once '../../abstract.php';

class SUMOHeavy_Shell_Security_Scan extends Mage_Shell_Abstract
{
    public function run()
    {
        $cmsBlock = Mage::getModel('cms/block')->load($this->getArg('block_id'));

        $scanner = Mage::getModel('sumoheavy_security/rule');
        $scanner->scanCmsBlock($cmsBlock);
    }
}

$shell = new SUMOHeavy_Shell_Security_Scan();
$shell->run();