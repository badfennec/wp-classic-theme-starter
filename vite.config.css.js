
import { defineConfig } from 'vite';
import path from 'path';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

import { getCssEntries } from './utils/get-css-entries';
import { handleAssetInfo } from './utils/handle-asset-info';

const cssEntries = getCssEntries(path.resolve(__dirname, '{css/components/**/*.css,css/woocommerce/*.css}'));
const ASSET_DIR = path.resolve(__dirname, 'theme', 'assets');

export default defineConfig({
    mode: 'development',    
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
    ],
    build: {
        outDir: ASSET_DIR,
        minify: false,
        emptyOutDir: false,
        rollupOptions: {
            input: {
                critical: path.resolve(__dirname, 'css', 'critical.css'),
                common: path.resolve(__dirname, 'css', 'common.css'),
                ...cssEntries,
            },            
            output: {
                assetFileNames: (assetInfo) => {
                    return handleAssetInfo( assetInfo );
                },
            },
        },
    },
});