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

                'public/images/gambar1.jpg',
                'public/images/gambar2.jpg',
                'public/images/gambar3.jpg',
                'public/images/gambar4.jpg',
                'public/images/gambar5.jpg',
                
                'public/videos/video1.mp4',
                'public/videos/video2.mp4',
                'public/videos/video3.mp4',
            ],
            refresh: true,
        }),
    ],
});