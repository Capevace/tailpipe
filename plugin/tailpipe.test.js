const tailpipe = require('./tailpipe');
const jsonToPhpArray = require('./json-to-php');

const path = require('path');
const resolveConfig = require('tailwindcss/resolveConfig');
const config = require('../tailwind.config');

const fs = require('fs/promises');

jest.mock('fs/promises');

test('Has working tailwind plugin', () => {
	const options = {
		include: (key, value) => key === 'colors',
		outputPath: path.resolve('./tests/css/tailpipe.php'),
	};
	const { theme } = resolveConfig(config);
	const mockCallback = jest.fn(() => theme);
	const tailwind = {
		config: mockCallback
	};

	tailpipe(options).handler(tailwind);

	expect(mockCallback).toHaveBeenCalled();
	expect(fs.writeFile).toHaveBeenCalled();
});

test('Has default filter', () => {
	const { theme } = resolveConfig(config);
	const filteredTheme = tailpipe.filterTheme(theme, tailpipe.defaultFilter);
	const sortedKeys = Object.keys(filteredTheme).sort();
	const expectedKeys = [
		'colors',
		'spacing',
		'screens',
		'borderWidth',
		'borderRadius',
		'fontFamily',
		'fontSize',
		'fontWeight',
		'height',
		'width',
		'zIndex',
		'boxShadow',
		'letterSpacing',
		'lineHeight',
	];

	expect(sortedKeys).toEqual(expectedKeys.sort());
});

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