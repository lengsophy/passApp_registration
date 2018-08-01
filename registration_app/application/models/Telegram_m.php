<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * This is user class/model for main-menu of My Profile
 */
class Telegram_m extends CI_Model {

    public function __construct()
	{
		parent::__construct();

	}
    public function sendMessage($chat_id,$text)
    {

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode'=>'HTML'
        ];

        $response = file_get_contents("https://api.telegram.org/bot".$this->config->item("apiToken")."/sendMessage?" . http_build_query($data) );
    } 

}