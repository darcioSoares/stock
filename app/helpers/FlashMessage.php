<?php

use app\utility\SessionFlashMessage;

class FlashMessage
{
    public static function message(string $index, string $style = "")
    {
        
            $message = SessionFlashMessage::get($index);

            return "<p class='{$style}'>{$message}</p>";
        
    }
}//end FlashMessage