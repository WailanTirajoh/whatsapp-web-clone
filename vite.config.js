import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel([
        //     {
        //         input: 'resources/js/app.js',
        //         ssr: 'resources/js/ssr.js',
        //     },
            'resources/js/app.js',
            'resources/scss/index.scss'
        ]),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
