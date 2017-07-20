<?php
/**
 * SUMOHeavy_Security
 *
 * @category   SUMOHeavy
 * @package    SUMOHeavy_Security
 * @copyright  Copyright (c) 2017 SUMO Heavy Industries, LLC
 * @author     Daniel Szubart <support@sumoheavy.com>
 */
class SUMOHeavy_Security_Adminhtml_RulesController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Init action - set breadcrumbs
     * 
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
             ->_setActiveMenu('sumoheavy_security/rules')
             ->_addBreadcrumb($this->__('SUMOHeavy Security'), $this->__('Rules'));

        return $this;
    }

    /**
     * Default page layout
     */
    public function indexAction()
    {
        $this->_initAction();
        $this->_addContent(
            $this->getLayout()
                ->createBlock(
                    'sumoheavy_security/adminhtml_rules'
                )
        );
        $this->renderLayout();

    }

    /**
     * Grid for AJAX rule request
     */
    public function gridAction()
    {
        $this->_initAction();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('sumoheavy_security/adminhtml_rules_grid')->toHtml()
        );
    }

    /**
     * New action
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * Edit action
     */
    public function editAction()
    {
        $id     = $this->getRequest()->getParam('id', 0);

        $model  = Mage::getModel('sumoheavy_security/rule')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Rule does not exist.'));
            $this->_redirect('*/*/');
        }

        Mage::unregister('sumoheavy_rule_data');
        Mage::register('sumoheavy_rule_data', $model);
        $this->_initAction();
        $this->_addContent(
            $this->getLayout()
                ->createBlock(
                    'sumoheavy_security/adminhtml_rules_edit'
                )
        );

        $this->renderLayout();

    }

    /**
     * Save action
     */
    public function saveAction()
    {
        $params = $this->getRequest()->getParams();

        if (isset($params['rule_id'])) {
            $id    = $params['rule_id'];
            $model = Mage::getModel('sumoheavy_security/rule');


            // create new entity
            if (!$id) {
                unset($params['rule_id']);
            } else {
                $model->load($id);
            }

            $model->setData($params);

            try {
                $model->save();
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Error during saving data. Try later.'));

                $this->_redirect('*/*/edit', array('id' => $model->getId()));

                return;
            }

            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Rule updated successfully.'));
            $this->_redirect('*/*/index', array('id' => $model->getId()));
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Cannot update Rule. Id is not set.'));
            $this->_redirect('*/*/');
        }
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('sumoheavy_security/rule');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Rule has been deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find rule to delete.'));
        $this->_redirect('*/*/');
    }

    /**
     * Is Allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/sumoheavy_security/rules');
    }
}