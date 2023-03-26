const fs = require('fs/promises');
const plugin = require('tailwindcss/plugin');
const jsonToPhpArray = require('./json-to-php');

const defaultVariables = [
	'colors',
	'spacing',
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

function filterTheme(theme, include) {
	const filtered = {};

	for (const [key, value] of Object.entries(theme)) {
		if (include(key, value)) {
			filtered[key] = value;
		}
	}

	return filtered;
}

async function writeThemeFile(theme, options) {
	const processed = filterTheme(theme, options.include);

	const contents = `<?php\n\nreturn ${jsonToPhpArray(processed)};`;

	await fs.writeFile(options.outputPath, contents, 'utf8');
}

function tailpipe(options) {
	options = {
		include: (key, value) => defaultVariables.includes(key),
		outputPath: './resources/css/tailpipe.php',
		...options,
	};

	return async function tailpipePlugin({ config }) {
		const theme = config('theme');

		await writeThemeFile(theme, options);
	};
}

module.exports = plugin.withOptions(tailpipe);
module.exports.defaultVariables = defaultVariables;
module.exports.writeThemeFile = writeThemeFile;
module.exports.filterTheme = filterTheme;