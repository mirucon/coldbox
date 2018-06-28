const path = require('path')

module.exports = (env, argv) => {
  const isModeNone = argv.mode === 'none'
  const mode = argv.mode

  return {
    mode: 'development',
    entry: {
      scripts: './assets/js/cd-scripts.babel.js',
      hljs: './assets/js/hljs.js',
      hljs_web: './assets/js/hljs_web.js',
      'scripts+hljs': [
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs.js'
      ],
      'scripts+hljs_web': [
        './assets/js/cd-scripts.babel.js',
        './assets/js/hljs_web.js'
      ]
    },
    output: {
      filename: '[name].js',
      path:
        mode === 'none'
          ? path.join(__dirname, 'assets/js/unmin/')
          : path.join(__dirname, 'assets/js/min/')
    },
    devtool: mode === 'development' ? 'source-map' : 'none',
    optimization: {
      minimize: !isModeNone
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: [
            {
              loader: 'babel-loader',
              options: {
                presets: [['env', { modules: false }]]
              }
            }
          ]
        }
      ]
    }
  }
}
