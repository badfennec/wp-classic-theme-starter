const CleanPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const CopyPlugin = require("copy-webpack-plugin");

module.exports = {
    CleanPlugin,
    MiniCssExtractPlugin,
    RemoveEmptyScriptsPlugin,
    CopyPlugin
};