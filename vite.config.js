import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // ini sudah ada
                'resources/js/app.js',    // ini sudah ada
                'public/css/admin.css',
                'public/css/dashboard.css',
                'public/css/kontak.css',
                'public/css/landing.css',
                'public/css/media-pembelajaran.css',
                'public/css/navbar.css',
                'public/css/paket.css',
                'public/css/verify.css',
                // tambahkan file CSS lainnya di sini
            ],
            refresh: true,
        }),
    ],
});