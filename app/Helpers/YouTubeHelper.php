<?php

namespace App\Helpers;

class YouTubeHelper
{
    /**
     * Mengambil ID video YouTube dari berbagai format URL.
     *
     * @param string $url
     * @return string|null
     */
    public static function getEmbedUrl($url)
    {
        $videoId = null;
        $patterns = [
            '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/|)([\w-]{11})/',
            '/(?:https?:\/\/)?(?:www\.)?googleusercontent\.com\/youtube\.com\/([\w-]{1,11})/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                if (isset($matches[1])) {
                    $videoId = $matches[1];
                    break;
                }
            }
        }

        if ($videoId) {
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        return null; // Kembalikan null jika tidak ada ID yang ditemukan
    }
}