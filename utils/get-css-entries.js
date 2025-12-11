const path = require('path');
const glob = require('glob');

function getCssEntries( pattern ) {
    const normalizedPattern = pattern.replace(/\\/g, '/');
    const globFunction = glob.globSync ? glob.globSync : glob.sync;
    
    const files = globFunction( normalizedPattern );

    return files.reduce( (entries, file) => {
        const name = path.basename(file, '.css');
        entries[name] = path.resolve(file);
        return entries;
    }, {});
}

module.exports = {
    getCssEntries,
}