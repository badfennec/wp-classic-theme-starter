const path = require('path');
const glob = require('glob');

function getCssEntries( pattern ) {
    const files = glob.sync( pattern );

    return files.reduce( (entries, file) => {
        const name = path.basename(file, '.css');
        entries[name] = path.resolve(file);
        return entries;
    }, {});
}

module.exports = {
    getCssEntries,
}