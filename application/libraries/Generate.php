<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Generate
 *
 * @author dd
 */
class Generate {
    
    function random_password($len)
    {
            srand((double)microtime()*10000000);
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $ret_str = "";
            $num = strlen($chars);
            for($i = 0; $i < $len; $i++)
            {
                    $ret_str.= $chars[rand()%$num];
                    $ret_str.=""; 
            }
            return $ret_str; 
    }
}
