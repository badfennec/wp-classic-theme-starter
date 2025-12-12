export function handleAssetInfo( assetInfo ) {
    const info = assetInfo.name.split('.');
    const ext = info[info.length - 1];

    if (ext === 'css') {
        return 'css/[name][extname]';
    } else if (['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp'].includes(ext)) {
        return 'media/images/[name][extname]';
    } else if (['mp4', 'webm', 'mov', 'avi'].includes(ext)) {
        return 'media/videos/[name][extname]';
    } else if (['mp3', 'wav', 'flac', 'aac', 'ogg'].includes(ext)) {
        return 'media/audio/[name][extname]';
    } else if (['woff', 'woff2', 'ttf', 'otf', 'eot'].includes(ext)) {
        return 'fonts/[name][extname]';
    }
}