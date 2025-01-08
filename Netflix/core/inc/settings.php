<?php
/*


 


*/
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getIPAddress() 
{  
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {  
        $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {  
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    else{  
        $ip = $_SERVER['REMOTE_ADDR'];  
    }
    return $ip;  
}  

function getLang() { 
    return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); 
} 

function getOS() { 

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() {

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function validatecard($cc)
{
   global $type;
   $cardtype = array(
       "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
       "mastercard" => "/^5[1-5][0-9]{14}$/",
       "amex"       => "/^3[47][0-9]{13}$/",
       "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
   );
   if (preg_match($cardtype['visa'],$cc))
   {
   $type= "Visa";
       return 'visa';
   
   }
   else if (preg_match($cardtype['mastercard'],$cc))
   {
   $type= "Mastercard";
       return 'mastercard';
   }
   else if (preg_match($cardtype['amex'],$cc))
   {
   $type= "Amex";
       return 'amex';
   
   }
   else if (preg_match($cardtype['discover'],$cc))
   {
   $type= "Discover";
       return 'discover';
   }
   else
   {
       return false;
   } 
}


//********FUNCTIONS**********\\

$user_os        = getOS();
$user_browser   = getBrowser();
$ip = getIPAddress();
?>