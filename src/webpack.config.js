const path = require("path");

module.exports = {
    entry: {
        entry: './javascript/entry.js',
    },
    output: {
        filename: "../scripts/tasks.js",
        path: path.resolve(__dirname),
    },
};
