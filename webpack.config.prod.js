const path = require('path');
const glob = require('glob');

const CleanPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require('terser-webpack-plugin');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');

function getCssEntries(pattern) {
  const files = glob.sync(pattern);
  return files.reduce((entries, file) => {
    const name = path.basename(file, '.css');
    entries[name] = path.resolve(file);
    return entries;
  }, {});
}

const cssEntries = getCssEntries(path.resolve(__dirname, 'css/components/**/*.css'));

module.exports = {
    mode: 'production',
    entry: {
        main: path.resolve(__dirname, 'js/main.js'),
        backend: path.resolve(__dirname, 'js', 'backend.js'),
        login:  path.resolve(__dirname, 'js', 'login.js'),
        critical: path.resolve(__dirname, 'css', 'critical.css'),
        ...cssEntries,
    },
    output: {        
        path: path.resolve(__dirname, 'theme', 'assets'),
        filename: 'js/[name].js',
        chunkFilename: 'js/[name].[contenthash].js',
        clean: true,
        assetModuleFilename: '[name][ext]',
    },
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
                        presets: [
                            ['@babel/preset-env', {
                                targets: { esmodules: true }, // modern browsers only
                                bugfixes: true,
                                exclude: ['@babel/plugin-transform-classes'],
                                useBuiltIns: false,
                                modules: false
                            }]
                        ]
                    },
                },
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: 'asset/resource',
                generator: {
                    filename: 'media/images/[name][ext]',
                },
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
    optimization: {
        minimize: true,
        minimizer: [
          new CssMinimizerPlugin(),
          new TerserPlugin({
            terserOptions: {
              mangle: true,
              keep_classnames: true,
            },
          }),
        ],
      },
};