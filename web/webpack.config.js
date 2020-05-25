const path = require('path');

module.exports = {
  entry: {
    homepage: path.resolve(__dirname, 'public', 'pages', 'homepage', 'index.js'),
    login: path.resolve(__dirname, 'public', 'pages', 'login', 'index.js'),
  },
  output: {
    path: path.resolve(__dirname, 'public', 'dist'),
    filename: '[name]-bundle.js'
  },
  devServer: {
    contentBase: path.resolve(__dirname, 'lib')
  },
  module: {
    rules: [
      {
        test: /\.jsx$|\.js$/,
        use: {
          loader: 'babel-loader',
        },
        exclude: /(node_modules|bower_components)/
      },
    ]
  }
}