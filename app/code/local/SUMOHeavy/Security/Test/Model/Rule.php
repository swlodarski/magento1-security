<?php

class SUMOHeavy_Security_Test_Model_Rule extends EcomDev_PHPUnit_Test_Case
{
    public function testRuleCallback()
    {
        $model = Mage::getModel('sumoheavy_security/rule');

        $args = array(
            'cms_block' => array(
                'content' => 'cms block content',
                'block_id' => 1,
            ),
            'row' => array(
                'rule' => 'rule',
                'rule_id' => 2,
            ),
        );
        $this->assertEquals("", $model->ruleCallback($args));

        $args = array(
            'cms_block' => array(
                'content' => 'cms block content rule',
                'block_id' => 1,
            ),
            'row' => array(
                'rule' => 'rule',
                'rule_id' => 2,
            ),
        );
        $this->assertEquals("rule", $model->ruleCallback($args));
    }

    public function testCmsBlockCallback()
    {
        $iteratorMock = $this->getModelMockBuilder('core/resource_iterator')
           ->setMethods(array('walk'))
           ->getMock();
        $iteratorMock->expects($this->once())
            ->method('walk')
            ->willReturn(true);

        $this->replaceByMock('model', 'core/resource_iterator', $iteratorMock);

        $args = array(
            'row' => array(
                'cms_block' => array(
                    'content' => 'cms block content',
                    'block_id' => 1,
                ),
                'row' => array(
                    'rule' => 'rule',
                    'rule_id' => 2,
                ),
            ),
        );
        $model = Mage::getModel('sumoheavy_security/rule');
        $model->cmsBlockCallback($args);
    }

    public function testScanCmsBlock()
    {
        $iteratorMock = $this->getModelMockBuilder('core/resource_iterator')
           ->setMethods(array('walk'))
           ->getMock();
        $iteratorMock->expects($this->once())
            ->method('walk')
            ->willReturn(true);

        $this->replaceByMock('model', 'core/resource_iterator', $iteratorMock);

        $args = array(
            'content' => 'cms block content',
            'block_id' => 1,
        );
        $model = Mage::getModel('sumoheavy_security/rule');
        $model->scanCmsBlock($args);
    }

    public function testScanAllCmsBlocks()
    {
        $iteratorMock = $this->getModelMockBuilder('core/resource_iterator')
           ->setMethods(array('walk'))
           ->getMock();
        $iteratorMock->expects($this->once())
            ->method('walk')
            ->willReturn(true);

        $this->replaceByMock('model', 'core/resource_iterator', $iteratorMock);

        $model = Mage::getModel('sumoheavy_security/rule');
        $model->scanAllCmsBlocks();
    }
}
