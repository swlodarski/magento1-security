<?php

/**
 * SUMOHeavy_Security
 *
 * @category   SUMOHeavy
 * @package    SUMOHeavy_Security
 * @copyright  Copyright (c) 2017 SUMO Heavy Industries, LLC
 * @author     Daniel Szubart <support@sumoheavy.com>
 */
class SUMOHeavy_Security_Block_Adminhtml_Rules_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        if (Mage::registry('sumoheavy_rule_data')) {
            $data = Mage::registry('sumoheavy_rule_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(
            array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
            )
        );

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'sumoheavy_security_form', array(
            'legend' => $this->__('Rule information')
            )
        );
        
        $fieldset->addField(
            'rule_id', 'hidden', array(
            'name' => 'rule_id',
            )
        );

        $fieldset->addField(
            'rule', 'textarea', array(
            'label' => $this->__('Rule'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'rule',
            )
        );

        $form->setValues($data);

        return parent::_prepareForm();
    }
}