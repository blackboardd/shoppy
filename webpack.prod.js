/* eslint-disable @typescript-eslint/no-var-requires */
// Generated using webpack-cli https://github.com/webpack/webpack-cli

const path = require('path');
const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const TerserWebpackPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = merge(common, {
  mode: 'production',
  output: {
    publicPath: '/dist/',
  },
  optimization: {
    minimizer: [
      new TerserWebpackPlugin({
        terserOptions: {
          compress: {
            drop_console: true,
          },
          sourceMap: true,
        },
        parallel: true,
      }),
    ],
    chunkIds: 'named',
    moduleIds: 'deterministic',
    splitChunks: {
      name: false,
      chunks: 'all',
      minChunks: 1,
      // maxAsyncRequests: 5,
      // maxInitialRequests: 5,
      cacheGroups: {
        vendor: {
          test: /node_modules/,
          name: 'vendor',
          chunks: 'all',
          enforce: true,
        },
        react: {
          test: /react|react-dom|mobx|prop-type/,
          name: 'react',
          priority: 10,
          chunks: 'initial',
          enforce: true,
        },
      },
    },
    runtimeChunk: {
      name: entrypoint => `runtime-${entrypoint.name}`,
    },
  },
  plugins: [
    new CleanWebpackPlugin(),
    new MiniCssExtractPlugin({
      filename: 'assets/css/[name].[contenthash].css',
      chunkFilename: 'assets/css/[name].[contenthash].css',
    }),
    new CopyPlugin({
      patterns: [
        { from: path.join(__dirname, './favicon.ico'), to: path.join(__dirname, './dist/') },
      ],
    }),
    // new BundleAnalyzerPlugin()
  ],
});
