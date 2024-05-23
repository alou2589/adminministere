<?php
    const key="@l@ss@net@mbedou25septembre1989+";
    const iv="@l@ss@net@mbedou";
    const methode="aes-256-cbc";
    
    function encrypt($text){
        return openssl_encrypt($text, methode, key,0, iv);
    }
    
    function decrypt($text){
        return openssl_decrypt($text, methode,key, 0, iv);
    }