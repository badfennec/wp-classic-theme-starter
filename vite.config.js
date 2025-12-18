import { defineConfig } from 'vite'
import path from 'path'
import tailwindcss from '@tailwindcss/vite'
import { viteStaticCopy } from 'vite-plugin-static-copy';

import { getCssEntries } from './utils/get-css-entries';
import { handleAssetInfo } from './utils/handle-asset-info';
import BadFennecDynamicHot from './plugins/badfennec-dynamic-hot';
import BadFennecReloadNotifier from './plugins/badfennec-reload-notifier';

const ASSET_DIR = path.resolve(__dirname, 'theme', 'assets');
const HOT_FILE = path.join(ASSET_DIR, 'hot');

const ALLOWED_WATCH_PATHS = [
    'css/',              
    'theme/components',
    'theme/woocommerce',
];

const cssEntries = getCssEntries(path.resolve(__dirname, '{css/components/**/*.css,css/woocommerce/*.css}'));

export default defineConfig({
    base: './',
    root: path.resolve(__dirname, './'),
    plugins: [
        tailwindcss(),
        viteStaticCopy({
            targets: [
                {
                    src: 'media/images/*.*',
                    dest: 'media/images'
                }
            ]
        }),
        BadFennecDynamicHot({ ASSET_DIR }),
        BadFennecReloadNotifier( { ALLOWED_WATCH_PATHS } )
    ],
    build: {
        outDir: ASSET_DIR,
        emptyOutDir: true,
        minify: 'terser',
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, 'js/main.js'),
                backend: path.resolve(__dirname, 'js', 'backend.js'),
                login:  path.resolve(__dirname, 'js', 'login.js'),
                critical: path.resolve(__dirname, 'css', 'critical.css'),
                common: path.resolve(__dirname, 'css', 'common.css'),
                ...cssEntries,
            },
            output: {
                entryFileNames: 'js/[name].js',
                chunkFileNames: 'js/[name].[hash].js',
                assetFileNames: (assetInfo) => {
                    return handleAssetInfo( assetInfo );
                }
            }
        }
    },
    server: {
        watch: {
            usePolling: true,
        }
    }
});