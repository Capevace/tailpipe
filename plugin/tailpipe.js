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

function tailpipe(options) {
	options = {
		filter: (key, value) => defaultVariables.includes(key),
		output: './resources/css/tailpipe.php',
		...options,
	};

	return async function tailpipePlugin({ config, theme }) {
		const json = config();
		const processed = Object.entries(json)
			.filter(([key, value]) => options.filter(key, value))
			.reduce((acc, [key, value]) => {
				acc[key] = value;
				return acc;
			}, {});

		const file = `<?php\n\nreturn ${jsonToPhpArray(processed)};`;

		await fs.writeFile(options.output, file, 'utf8');
	};
}

module.exports = plugin.withOptions(tailpipe);
module.exports.defaultVariables = defaultVariables;