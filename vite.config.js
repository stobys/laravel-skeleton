import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin';
// import vue from '@vitejs/plugin-vue'


export default defineConfig({
    plugins: [
        // vue(),
        // laravel({ config: 'default' }),
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'],

            // postcss: [
            //     // tailwindcss(),
            //     // autoprefixer(),
            // ],

            refresh: true,
        })
        // react(),
        // vue({
        //     template: {
        //         transformAssetUrls: {
        //             base: null,
        //             includeAbsolute: false,
        //         },
        //     },
        // }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js'
        }
    }
});
