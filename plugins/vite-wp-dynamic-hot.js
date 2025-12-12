import fs from 'fs';
import path from 'path'

export default function ViteWpDynamicHot({ ASSET_DIR }){
    return {
        name: 'vite-wp-dynamic-hot',
        configureServer(server) {
        const hotFilePath = path.join( ASSET_DIR, 'hot');
        
        // Make sure the ASSET_DIR exists, if not, create it
        if (!fs.existsSync( ASSET_DIR )) {
            fs.mkdirSync(ASSET_DIR, { recursive: true });
        }

        // Get server info
        const protocol = server.config.server.https ? 'https' : 'http';
        const host = server.config.server.host || 'localhost';
        const port = server.config.server.port;
        
        // Write the full URL (e.g. http://localhost:5173)
        const hotContent = `${protocol}://${host}:${port}`;
        fs.writeFileSync(hotFilePath, hotContent);

        // Make sure the 'hot' file is deleted on process exit (CTRL+C)
        process.on('exit', () => {
            if (fs.existsSync(hotFilePath)) {
                fs.unlinkSync(hotFilePath);
            }
        });
    }
    }
}