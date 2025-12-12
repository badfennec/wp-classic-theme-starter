import fs from 'fs';
import path from 'path';

export default function ReloadNotifierPlugin({ INDEX_HTML, ALLOWED_WATCH_PATHS }) {
    let shouldReload = false;

    return {
        name: 'css-reload-notifier',
        
        watchChange(id) {
            shouldReload = false;

            // Check if the changed file is within the allowed paths
            // Use path.normalize to avoid issues between Windows/Mac slashes
            const normalizedId = path.normalize(id);
            const isAllowed = ALLOWED_WATCH_PATHS.some(allowedPath => 
                normalizedId.includes( path.normalize(allowedPath) )
            );

            if (isAllowed) {
                shouldReload = true;
            }
        },

        closeBundle() {
            if (shouldReload && fs.existsSync(INDEX_HTML)) {
                const now = new Date();
                try {
                    //trigger reload by updating the timestamp of index.html
                    fs.utimesSync(INDEX_HTML, now, now);
                    shouldReload = false;
                } catch (err) {
                    console.error('Error update at index.html:', err);
                }
            }
        }
    };
}