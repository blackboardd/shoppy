/* eslint-disable @typescript-eslint/no-var-requires */
// Generated using webpack-cli https://github.com/webpack/webpack-cli

const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

module.exports = merge(common, {
  mode: 'production',
  output: {
    publicPath: '/',
  },
  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin()],
  },
  plugins: [
    new CopyPlugin({
      patterns: [
        {
          from: 'public/_redirects',
          to: '_redirects',
        },
      ],
    })
  ],
});
