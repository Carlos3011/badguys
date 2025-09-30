import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import fs from 'fs';
import { join } from 'path';

function createCssDirPlugin() {
    return {
        name: 'create-css-dir',
        buildEnd() {
            const cssDir = join('public', 'css');
            if (!fs.existsSync(cssDir)) {
                fs.mkdirSync(cssDir, { recursive: true });
            }
        }
    };
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'vendor/konekt/appshell/src/resources/assets/js/appshell.standalone.esm.js',
                'resources/css/app.css',
                'vendor/konekt/appshell/src/resources/assets/sass/appshell.sass',
            ],
            refresh: true,
        }),
        createCssDirPlugin()
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
    build: {
        outDir: 'public',
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name === 'appshell.css') {
                        return 'css/appshell.css';
                    }

                    return 'assets/[name]-[hash][extname]';
                },
            },
        },
        emptyOutDir: false,
    },
});
