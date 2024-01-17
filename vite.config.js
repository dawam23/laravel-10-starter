import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                // Backend
                'resources/css/backend/app.css',
                'resources/js/backend/app.js',

            ],
            refresh: true,
        }),
    ],
});
