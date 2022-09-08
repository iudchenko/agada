/**
 * WordPress Dependencies
 */
const defaultConfig = require("@wordpress/scripts/config/webpack.config.js");

module.exports = {
  ...defaultConfig,
  ...{
    // Add any overrides to the default here.

    resolve: {
      fallback: {
        stream: require.resolve("stream-browserify"),
      },
    },
  },
};
