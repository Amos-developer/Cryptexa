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
            'ru' => 'russian',
            'ar' => 'arabic',
            'hi' => 'hindi',
            'it' => 'italian',
            'nl' => 'dutch',
            'tr' => 'turkish',
            'pl' => 'polish',
            'vi' => 'vietnamese',
            'th' => 'thai',
            'id' => 'indonesian',
        ];
        
        $file = $fileMap[$locale] ?? 'english';
        
        $translation = trans($file . '.' . $key, $replace);
        
        // If translation not found, return the key
        if ($translation === $file . '.' . $key) {
            return $key;
        }
        
        return $translation;
    }
}
