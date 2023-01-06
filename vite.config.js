import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/modal.css',
                'resources/css/slider.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
