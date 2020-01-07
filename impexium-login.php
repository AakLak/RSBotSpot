<?php
// API Credentails
define("ACCESS_END_POINT", "https://public.impexium.com/Api/v1/WebApiUrl");
define("APP_NAME", "brmiEventpediaStaging");
define("APP_KEY", "O6Vbai86736kl58G");
define("APP_ID", "brmiEventpediaStaging");
define("APP_PASSWORD", "O6Vbai86736kl58G");
define("APP_USER_EMAIL", "brmiEventpediaStaging@impexium.com");
define("APP_USER_PASSWORD", 'WJ.D@tv.-$c&V<6J');
//values from api
$apiEndPoint = "";
$baseUri = "";
$accessToken = "";
$appToken = "";
$userToken = "";
$userId = "";

getNameMemCookie();
// Hit Impexium /Individuals/Profile Route

function get_user_data() {
    $paramUserId = $_GET["UserId"];
    $getIndividualProfile = "/Individuals/Profile/" . $paramUserId;
    $data = authenticate();
    $response = send_request($data->uri . $getIndividualProfile, null, array('usertoken: ' . $data->userToken, 'apptoken:' . $data->appToken,));
    // Only return response if _getUSerID has a value
    return $response;
}
// Read API responce membership length
function is_member($userData) {
    $memberships = $userData->dataList[0]->memberships;
    if ($memberships) {
        if (sizeof($memberships) > 0) {
            return 1;
        }
    }
    return 0;
}
// Read API Response first name
function getName($userData) {
    $name = $userData->dataList[0]->firstName;
    if ($name == null) {
        return 0;
    }
    return $name;
}
// Read/Set Cookie
function getNameMemCookie() {
    // User has annon cookies and is coming from Impexium/login page
    if (($_COOKIE['impex_user'] == '0') and ($_COOKIE['impex_mem'] == '0') and (strpos($_SERVER['HTTP_REFERER'], "brmi.") > - 1)) {
        $userData = get_user_data();
        $username = getName($userData);
        $member = is_member($userData);
        setcookie('impex_mem', $member, 0, '/; samesite=lax');
        setcookie('impex_user', $username, 0, '/; samesite=lax');
        $array = ["user" => $username, "mem" => $member, ];
        return $array;
        // Cookies exist, user is member

    } else if (isset($_COOKIE['impex_user']) and isset($_COOKIE['impex_mem'])) {
        $array = ["user" => $_COOKIE['impex_user'], "mem" => $_COOKIE['impex_mem'], ];
        return $array;
        //No Cookies Exist

    } else {
        $userData = get_user_data();
        $username = getName($userData);
        $member = is_member($userData);
        setcookie('impex_mem', $member, 0, '/; samesite=lax');
        setcookie('impex_user', $username, 0, '/; samesite=lax');
        //         echo "<h1>GRAB DATA</h1>";
        // 		echo $_COOKIE['impex_user'];
        // 		echo $_COOKIE['impex_mem'];
        // 		echo (strpos($_SERVER['HTTP_REFERER'],"my.") > -1);
        $array = ["user" => $username, "mem" => $member, ];
        return $array;
    }
}
// API Call stuff
function authenticate() {
    //Step 1 : Get ApiEndPoint and AccessToken
    //POST api/v1/WebApiUrl
    $data = array('AppName' => APP_NAME, 'AppKey' => APP_KEY,);
    $data = send_request(ACCESS_END_POINT, $data);
    $apiEndPoint = $data->uri;
    $accessToken = $data->accessToken;
    //Step 2: Get AppToken or UserToken or Both
    //POST api/v1/Signup/Authenticate
    $data = array('AppId' => APP_ID, 'AppPassword' => APP_PASSWORD, 'AppUserEmail' => APP_USER_EMAIL, 'AppUserPassword' => APP_USER_PASSWORD,);
    $data = send_request($apiEndPoint, $data, array('accesstoken: ' . $accessToken,));
    return $data;
}
// API Call Stuff
function send_request($url, $data, $customHeaders = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($customHeaders !== null) {
        $headers = $customHeaders;
    } else {
        $headers = [];
    }
    if ($data === null) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    } else {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $json = json_encode($data);
        $headers[] = 'Content-Length: ' . strlen($json);
        $headers[] = 'Content-Type: application/json; charset=utf-8';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $json = curl_exec($ch);
    return json_decode($json);
}
?>