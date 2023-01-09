<?php


namespace common\components;

use common\helper\Constants;
use Yii;
use yii\base\Component;


class DynamicLogin extends Component
{
    /**
     * set access token in cooke
     *
     */
    public function SaveAccessToken()
    {
        $user = \common\models\User::findOne(Yii::$app->user->id);
        $user->generateAccessToken();
        $accessToken = $user->getAccessToken();
        $accessTokenEncrypt = Yii::$app->security->encryptByKey($accessToken, Yii::$app->params["secretKey"]);
        $requestCookies = Yii::$app->request->getCookies();
        $requestCookies->readOnly = false;
        $responseCookies = Yii::$app->response->getCookies();
        $responseCookies->readOnly = false;
        $responseCookies->remove(Constants::USER_ACCESS_TOKEN);
        unset($requestCookies[Constants::USER_ACCESS_TOKEN]);

        $responseCookies->add(new \yii\web\Cookie([
            'name' => Constants::USER_ACCESS_TOKEN,
            'value' => $accessTokenEncrypt,
            'expire' => time() + 60 * 60 * 24 * 60,
        ]));
    }

    /**
     * get user from cookie if exists.
     *
     * @return \common\models\User
     */
    public function GetUserFromCookie()
    {
        $requestCookies = Yii::$app->request->getCookies();
        if ($requestCookies->has(Constants::USER_ACCESS_TOKEN)) {
            $accessTokenEncrypt = $requestCookies->getValue(Constants::USER_ACCESS_TOKEN);
            $accessTokenDecrypt = Yii::$app->security->decryptByKey($accessTokenEncrypt, Yii::$app->params["secretKey"]);
            return \common\models\User::findIdentityByAccessToken($accessTokenDecrypt);
        }
        return null;
    }

    public function RealIP()
    {
        $ip = false;

        $seq = array('HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR'
        , 'HTTP_X_FORWARDED'
        , 'HTTP_X_CLUSTER_CLIENT_IP'
        , 'HTTP_FORWARDED_FOR'
        , 'HTTP_FORWARDED'
        , 'REMOTE_ADDR');

        foreach ($seq as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return null;
    }

}