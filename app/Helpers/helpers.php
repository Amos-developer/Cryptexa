<?php

if (!function_exists('__t')) {
    function __t($key, $replace = []) {
        $locale = app()->getLocale();
        
        $fileMap = [
            'en' => 'english',
            'es' => 'spanish',
            'fr' => 'french',
            'de' => 'german',
            'zh' => 'chinese',
            'ja' => 'japanese',
            'ko' => 'korean',
            'pt' => 'portuguese',
        ];
        
        $file = $fileMap[$locale] ?? 'english';
        
        return __($file . '.' . $key, $replace);
    }
}
