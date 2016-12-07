### Installation

> composer require bayuexiong/wxapp_authorize

### Basic Usage

##### Get SessionKey

```
require "vendor/autoload.php";

use Wxapp\Wechat\Auth;

$app_id = '';
$app_secret = '';
$code = '';

$auth = new Auth($app_id, $app_secret);

try {
    $data = $auth->authorize($code);
    $open_id = $data['openid'];
    $session_key = $data['session_key'];
} catch (Exception $e) {
    var_dump($e);
}
```

##### Decode UserInfo

```
$session_key = '';
   $encrypt_data = '';
   $iv = '';

   $user = new User($app_id, $app_secret);
   try {
       $info = $user->decode($session_key, $encrypt_data, $iv);
       $open_id = $info['openId'];
       $union_id = $info['unionId'];
   } catch (Exception $e) {
       var_dump($e);
   }
```


### License
wxapp_authorize is licensed under the MIT License - see the LICENSE file for details

