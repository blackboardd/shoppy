/* eslint-disable @typescript-eslint/no-var-requires */
module.exports = {
  plugins: [
    require('autoprefixer')(),
    require('postcss-flexbugs-fixes'),
    require('postcss-preset-env')({
      autoprefixer: {
        flexbox: 'no-2009'
      },
      stage: 3
    }),
    require('postcss-normalize'),
  ]
};
