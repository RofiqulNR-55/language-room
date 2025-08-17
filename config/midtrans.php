<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans API Keys
    |--------------------------------------------------------------------------
    |
    | File ini mengambil kunci API dari file .env Anda.
    | Pastikan Anda sudah mengatur MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY
    | di dalam file .env Anda.
    |
    */

    // PERBAIKAN: Mengambil berdasarkan nama variabel dari file .env
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
];
