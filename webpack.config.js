const path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')

const recursiveIssuer = m => {
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
      'fonts/simple-icons/simple-icons': './assets/js/simple-icons.js'
    }
  } else {
    entries = {
      'js/min/scripts': ['babel-polyfill', './assets/js/cd-scripts.babel.js'],
      'js/min/hljs': './assets/js/hljs.js',
      'js/min/hljs_web': './assets/js/hljs_web.js',
      'js/min/scripts+hljs': [
        'babel-polyfill',
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs.js'
      ],
      'js/min/scripts+hljs_web': [
        'babel-polyfill',
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs_web.js'
      ],
      'fonts/fontawesome/font-awesome': './assets/js/font-awesome.js',
      'fonts/simple-icons/simple-icons': './assets/js/simple-icons.js'
    }
  }

  return {
    mode: 'development',
    entry: entries,
    output: {
      filename: '[name].js',
      path: path.join(__dirname, 'assets/')
    },
    devtool: isModeDev ? 'source-map' : 'none',
    optimization: {
      minimizer: [
        new UglifyJsPlugin({
          cache: true,
          parallel: true,
          sourceMap: true
        }),
        new OptimizeCssAssetsPlugin({
          assetNameRegExp: /\.css$/,
          cssProcessor: require('cssnano'),
          cssProcessorPluginOptions: {
            preset: ['default', { discardComments: { removeAll: true } }]
          }
        })
      ],
      splitChunks: {
        cacheGroups: {
          fontAwesomeStyles: {
            name: 'fonts/fontawesome/font-awesome',
            test: (m, c, entry = 'foo') =>
              m.constructor.name === 'CssModule' &&
              recursiveIssuer(m) === entry,
            chunks: 'all',
            enforce: true
          }
        }
      }
    },
    plugins: [
      new MiniCssExtractPlugin({
        fileName: '[name].css'
      })
    ],
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: [
            {
              loader: 'babel-loader',
              options: {
                presets: [['env', { modules: false }]],
                plugins: 'transform-es2015-for-of'
              }
            }
          ]
        },
        {
          // Loader for Font Awesome CSS
          test: /all\.min\.css$/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: {
                publicPath: './fonts/fontawesome/'
              }
            },
            'css-loader'
          ]
        },
        {
          // Loader for Font Awesome Fonts
          test: /((?<=\d00)\.svg|\.(woff(2)?|ttf|eot))(\?v=\d+\.\d+\.\d+)?$/,
          use: [
            {
              loader: 'file-loader',
              options: {
                name: '[name].[ext]',
                outputPath: 'fonts/fontawesome/fonts/',
                publicPath: './fonts/'
              }
            }
          ]
        },
        {
          // Loader for webfonts-loader
          test: /\.font\.js/,
          use: ['style-loader', 'css-loader', 'webfonts-loader']
        }
      ]
    }
  }
}
