import path from 'path';

export default function BadFennecReloadNotifier({ ALLOWED_WATCH_PATHS }: { ALLOWED_WATCH_PATHS: string[] }) {

    return {
        name: 'badfennec-reload-notifier',
        handleHotUpdate({ file, server }: { file: string; server: any }) {
            const normalizedFile = path.normalize(file);
            const isAllowed = ALLOWED_WATCH_PATHS.some(allowedPath => 
                normalizedFile.includes( path.normalize(allowedPath) )
            );

            if( isAllowed ){
                server.ws.send({
                    type: 'full-reload',
                    path: '*'
                });
            }            
        },
    }
}