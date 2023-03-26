const tailpipe = require('./tailpipe');
const jsonToPhpArray = require('./json-to-php');

const resolveConfig = require('tailwindcss/resolveConfig');
const config = require('../tailwind.config');

const fs = require('fs/promises');

jest.mock('fs/promises');

test('Filters theme', () => {
	const options = {
		include: (key, value) => key === 'colors',
	};

	const { theme } = resolveConfig(config);
	const filteredTheme = tailpipe.filterTheme(theme, options.include);

	expect(Object.keys(filteredTheme)).toEqual(['colors']);
});

test('Writes theme to file', async () => {
	const options = {
		include: (key, value) => key === 'colors',
		outputPath: './resources/css/tailpipe.php',
	};

	const { theme } = resolveConfig(config);
	const filteredTheme = tailpipe.filterTheme(theme, options.include);

	const contents = `<?php\n\nreturn ${jsonToPhpArray(filteredTheme)};`;

	await tailpipe.writeThemeFile(theme, options);

	expect(fs.writeFile)
		.toHaveBeenCalledWith(
			options.outputPath,
			contents,
			'utf8'
		);
});