<?php

namespace Product\SampleAttribute\Override\Newsletter\Controller\Subscriber;

use Exception;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Exception\LocalizedException;
use Magento\Newsletter\Model\Subscriber;

class NewAction extends \Magento\Newsletter\Controller\Subscriber\NewAction
{
    /**
     * @var Json
     */
    protected $_resultJson;

    /**
     * New subscription action
     *
     * @return void
     * @throws LocalizedException
     */
    public function execute()
    {
        $result = [];
        $result['error'] = true;
        $result['message'] = __('You are the man.');
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $email = (string)$this->getRequest()->getPost('email');

            try {
                $this->validateEmailFormat($email);
                $this->validateGuestSubscription();
                $this->validateEmailAvailable($email);

                $subscriber = $this->_subscriberFactory->create()->loadByEmail($email);
                if ($subscriber->getId()
                    && $subscriber->getSubscriberStatus() == Subscriber::STATUS_SUBSCRIBED
                ) {
                    $result['message'] = __('This email address is already subscribed.');
                } else {
                    $status = $this->_subscriberFactory->create()->subscribe($email);
                    if ($status == Subscriber::STATUS_NOT_ACTIVE) {
                        $result['message'] = __('The confirmation request has been sent.');
                        $result['error'] = false;
                    } else {
                        $result['message'] = __('Thank you for your subscription.');
                        $result['error'] = false;
                    }
                }
            } catch (LocalizedException $e) {
                $result['message'] = __('There was a problem with the subscription: %1', $e->getMessage());
            } catch (Exception $e) {
                $result['message'] = $e->getMessage();
            }
        }
        return $this->getResultJson()->setData($result);
    }

    /**
     * @return Json
     */
    protected function getResultJson()
    {
        if ($this->_resultJson === null) {
            $this->_resultJson = ObjectManager::getInstance()->get(Json::class);
        }
        return $this->_resultJson;
    }
}
