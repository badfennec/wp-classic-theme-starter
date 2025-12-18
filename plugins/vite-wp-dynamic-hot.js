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
        let port = server.config.server.port;

        server.httpServer?.once('listening', () => {
            const address = server.httpServer?.address();
            if (address && typeof address !== 'string') {
                port = address.port;
            }

            // Write the full URL (e.g. http://localhost:5173)
            const hotContent = `${protocol}://${host}:${port}`;
            console.log(`Creating hot file at: ${hotFilePath} with content: ${hotContent}`);
            fs.writeFileSync(hotFilePath, hotContent);
        });

        // Make sure the 'hot' file is deleted on process exit (CTRL+C)
        process.on('exit', () => {
            if (fs.existsSync(hotFilePath)) {
                fs.unlinkSync(hotFilePath);
            }
        });
    }
    }
}