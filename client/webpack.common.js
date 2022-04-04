/* eslint-disable @typescript-eslint/no-var-requires */
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const devMode = process.env.NODE_ENV === 'dev' || process.env.NODE_ENV === 'development';
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: [
    path.resolve(__dirname, './node_modules/regenerator-runtime/runtime.js'),
    path.resolve(__dirname, './src/index.tsx'),
  ],
  plugins: [
    new MiniCssExtractPlugin({
      linkType: "text/css",
    }),
    new HtmlWebpackPlugin({
      filename: 'index.html',
      template: 'public/index.html',
      inject: 'body',
      minify: false,
    }),
  ],
  output: {
    path: path.join(__dirname, './dist/'),
    publicPath: '/',
    filename: 'assets/js/[name].[contenthash:8].js',
    chunkFilename: 'assets/js/[name].[contenthash:8].js',
    sourceMapFilename: 'assets/js/[name].[contenthash:8].js.map',
  },
  module: {
    rules: [
      {
        test: /\.ts[x]?$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [['@babel/preset-env', { targets: 'defaults' }]],
          },
        },
      },
      {
        test: /\.css$/,
        use: [
          devMode ? { loader: 'style-loader' } : MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.s[ac]ss$/i,
        use: ['style-loader', 'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  require('autoprefixer'),
                ],
              }
            }
          },
          'sass-loader'],
      },
      {
        test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
        type: 'asset',
      },
    ],
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
    extensions: ['.tsx', '.ts', '.js', '.jsx'],
  },
};
