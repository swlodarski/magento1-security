<?php
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'abstract.php';

class SUMOHeavy_Shell_Security_Scan extends Mage_Shell_Abstract
{
    public function run()
    {
        $scanner = Mage::getModel('sumoheavy_security/rule');

        if ($this->getArg('block_id')) {
            $cmsBlock = Mage::getModel('cms/block')->load($this->getArg('block_id'));

            $scanner->scanCmsBlock($cmsBlock);
        } else {
            $scanner->scanAllCmsBlocks();
        }
    }
}

$shell = new SUMOHeavy_Shell_Security_Scan();
$shell->run();