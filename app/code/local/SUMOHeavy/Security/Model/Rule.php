<?php

class SUMOHeavy_Security_Model_Rule extends Mage_Core_Model_Abstract
{
    /**
     * Internal constructor not dependent on params. Can be used for object initialization
     */
    protected function _construct()
    {
        $this->_init('sumoheavy_security/rule');
    }

    /**
     * Rule walker callback for scanner
     *
     * @param $args
     * @return string
     */
    public function ruleCallback($args)
    {
        $cmsBlockContent = $args['cms_block']['content'];
        $cmsBlockId      = $args['cms_block']['block_id'];
        $matchingRule    = '';
        $rule            = $args['row']['rule'];
        $ruleId          = $args['row']['rule_id'];

        if (strpos($cmsBlockContent, $rule)) {
            $matchingRule = $rule;
            Mage::log("Match found in CMS Block ID {$cmsBlockId} for rule {$ruleId} ({$rule})", Zend_Log::INFO, SUMOHeavy_Security_Helper_Data::LOG_FILENAME, true);
        }

        return $matchingRule;
    }

    /**
     * Scans a single CMS Block for all matching rules
     *
     * @param Mage_Cms_Model_Block $cmsBlock
     */
    public function scanCmsBlock(Mage_Cms_Model_Block $cmsBlock)
    {
        $ruleCollection = Mage::getModel('sumoheavy_security/rule')->getCollection();

        Mage::getSingleton('core/resource_iterator')->walk(
            $ruleCollection->getSelect(),
            array(array($this, 'ruleCallback')),
            array('cms_block' => $cmsBlock)
        );
    }
}