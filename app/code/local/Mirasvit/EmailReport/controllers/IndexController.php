<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Follow Up Email
 * @version   1.0.2
 * @revision  269
 * @copyright Copyright (C) 2014 Mirasvit (http://mirasvit.com/)
 */


class Mirasvit_EmailReport_IndexController extends Mage_Core_Controller_Front_Action
{
    public function openAction()
    {
        $queueKey = $this->getRequest()->getParam('emqo');

        $queue = Mage::getModel('email/queue')->loadByUniqKeyMd5($queueKey);

        if ($queue && $queue->getId()) {
            Mage::getModel('emailreport/open')
                ->setQueueId($queue->getId())
                ->setTriggerId($queue->getTrigger()->getId())
                ->setSessionId(Mage::getSingleton('core/session')->getSessionId())
                ->save();

            Mage::helper('emailreport')->setQueueId($queue->getId());
        }

        Mage::app()->getResponse()
            ->clearHeaders()
            ->setHeader('Content-Type', 'image/gif')
            ->setBody(base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw=='));
    }
}