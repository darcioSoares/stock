<?php

use app\utility\SessionFlashMessage;

class FlashMessage
{
    public static function message(string $index, string $style = "")
    {
        if(isset($_SESSION[$index])){
            $message = SessionFlashMessage::get($index);

            return "<span class='{$style}'>{$message}</span>";
        }

        return;
        
    }
}//end FlashMessage