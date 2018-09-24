<?php
/**
 * Created by PhpStorm.
 * User: Mr.she
 * Date: 2018/8/16
 * Time: 21:52
 */

namespace App\Exceptions;

use Toplan\Sms\Facades\SmsManager;

trait sendSms
{
    public function sendSmsCode($phone)
    {
        $result = SmsManager::validateSendable();
        if (!$result['success']) {
            return $result;
        }
        $result = SmsManager::validateFields(['mobile' => $phone]);
        if (!$result['success']) {
            return $result;
        }
        $result = SmsManager::requestVerifySms();
        if (!$result['success']) {
            return $result;
        }
        return $result;
    }
}