const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const TerserPlugin = require('terser-webpack-plugin')
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin")

const recursiveIssuer = (m) => {
  if (m.issuer) {
    return recursiveIssuer(m.issuer)
  } else if (m.name) {
    return m.name
  } else {
    return false
  }
}

module.exports = (env, argv) => {
  const isModeDev = argv.mode === 'development'

  let entries
  if (isModeDev) {
    entries = {
      'js/min/scripts': './assets/js/cd-scripts.babel.js',
      'css/style.min': './assets/js/style.js',
    }
  } else {
    entries = {
      'js/min/scripts': ['./assets/js/cd-scripts.babel.js'],
      'js/min/hljs': './assets/js/hljs.js',
      'js/min/hljs_web': './assets/js/hljs_web.js',
      'js/min/scripts+hljs': [
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs.js',
      ],
      'js/min/scripts+hljs_web': [
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs_web.js',
      ],
      'css/style.min': './assets/js/style.js',
    }
  }

  return {
    mode: 'development',
    entry: entries,
    resolve: {
      alias: {
        '~': path.resolve(__dirname),
      },
    },
    output: {
      filename: '[name].js',
      path: path.join(__dirname, 'assets/'),
    },
    devtool: isModeDev ? 'cheap-module-source-map' : false,
    optimization: {
      minimize: !isModeDev,
      minimizer: [
        new TerserPlugin(),
        new CssMinimizerPlugin({
          test: /\.css$/,
          minimizerOptions: {
            preset: ['default', { discardComments: { removeAll: true } }],
          },
        }),
      ],
      splitChunks: {
        cacheGroups: {
          fontAwesomeStyles: {
            name: 'fonts/fontawesome/font-awesome',
            test: (m, c, entry = 'foo') =>
              m.constructor.name === 'CssModule' &&
              recursiveIssuer(m) === entry,
            chunks: 'all',
            enforce: true,
          },
        },
      },
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: '[name].css',
        chunkFilename: '[id].css',
      }),
    ],
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules\/(?!highlight.js)/,
          use: [
            {
              loader: 'babel-loader',
              options: {
                presets: [['@babel/preset-env', { modules: false }]],
                plugins: ['@babel/plugin-transform-for-of'],
              },
            },
          ],
        },
        {
          // Loader for Simple icon CSS & Fonts
          test: /\.font\.js/,
          use: [
            'style-loader',
            {
              loader: MiniCssExtractPlugin.loader,
              options: {
                esModule: false,
              },
            },
            'css-loader',
            'postcss-loader',
            {
              loader: 'webfonts-loader',
              options: {
                publicPath: '../',
              },
            },
          ],
        },
        {
          test: /\.(sc|sa|c)ss$/,
          exclude: /node_modules/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
            },
            {
              loader: 'css-loader',
              options: {
                modules: 'global',
                sourceMap: isModeDev,
                importLoaders: 2,
              },
            },
            'postcss-loader',
            {
              loader: 'sass-loader',
              options: {
                sassOptions: {
                  outputStyle: 'expanded',
                },
              },
            },
          ],
        },
        {
          // Loader for Font Awesome CSS
          test: /all\.min\.css$/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
            },
            'css-loader',
          ],
        },
        {
          // Loader for Font Awesome Fonts
          test: /((?<=\d00)\.svg|\.(woff(2)?|ttf|eot))(\?v=\d+\.\d+\.\d+)?$/,
          type: 'asset/resource',
          generator: {
            filename: './fonts/[name][ext]',
          },
        },
      ],
    },
  }
}
