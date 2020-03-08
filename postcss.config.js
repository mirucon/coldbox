module.exports = env => {
  return {
    plugins: {
      autoprefixer: {},
      cssnano: env.env === 'production' ? {} : false
    }
  }
}
