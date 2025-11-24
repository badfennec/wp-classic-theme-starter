const path = require('path');

const { 
    MiniCssExtractPlugin, 
    CleanPlugin, 
    RemoveEmptyScriptsPlugin 
} = require('./webpack.plugins');

module.exports = {
    watch: true,
    mode: 'development',
    entry: {
        main: path.resolve(__dirname, 'js', 'main.js'),
        backend: path.resolve(__dirname, 'js', 'backend.js'),
        login:  path.resolve(__dirname, 'js', 'login.js'),
        critical: path.resolve(__dirname, 'css', 'critical.css'),
        blocks: path.resolve(__dirname, 'css', 'blocks.css'),
    },
    output: {        
        path: path.resolve(__dirname, 'theme', 'assets'),
        filename: 'js/[name].js',
        chunkFilename: 'js/[name].[contenthash].js',
        clean: true,
        assetModuleFilename: '[name].[ext]',
    },
    devServer: {
        static: {
            directory: path.resolve(__dirname, 'theme', 'assets'),
            publicPath: '/',
        },
        devMiddleware: {
            writeToDisk: (filePath) => {
                return /critical\.css$/.test(filePath) || /blocks\.css$/.test(filePath);
            },
        }
    },
    devtool: 'inline-source-map',
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader'],
            },
            {
                test: /\.css$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader'],
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'fonts/[name][ext]',
                },
            }
        ],
    },
    plugins: [
        new CleanPlugin.CleanWebpackPlugin(),
        new RemoveEmptyScriptsPlugin(),
        new MiniCssExtractPlugin({
            filename: 'css/[name].css'
        }),
    ],
};