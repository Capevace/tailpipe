const path = require('path');

module.exports = {
  content: [],
  theme: {
    extend: {
		colors: {
			primary: {
				50: '#f2f8ff',
				100: '#f5f5f5',
				200: '#e8e8e8',
				300: '#dcdcdc',
				400: '#d1d1d1',
				500: '#c6c6c6',
				600: '#bcbcbc',
				700: '#b2b2b2',
				800: '#a8a8a8',
				900: '#9f9f9f',
			}
		}
	},
  },
  plugins: [
	require('./plugin/tailpipe')({
		outputPath: path.resolve('./tests/css/tailpipe.php')
	})
  ],
}
