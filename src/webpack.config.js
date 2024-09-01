const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require('vue-loader');

module.exports = {
    entry: {
        entry: './index.js',
    },
    output: {
        filename: "../assets/scripts/tasks.js",
        path: path.resolve(__dirname),
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader", "postcss-loader"],
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "../assets/css/style.css",
        }),
        new VueLoaderPlugin(),
    ],
};
