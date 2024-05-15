import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/auth.css', // Tambahkan ini untuk file auth.css
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
