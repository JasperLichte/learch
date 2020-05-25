const path = require('path');

module.exports = {
    entry: './build/index.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, './../public/js')
    }
};
