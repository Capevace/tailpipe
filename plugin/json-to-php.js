function jsonToPhpArray(json) {
	function processValue(value) {
		if (typeof value === 'string') {
			return `'${value.replace(/'/g, "\\'")}'`;
		} else if (typeof value === 'number' || typeof value === 'boolean') {
			return value;
		} else if (Array.isArray(value)) {
			return arrayToPhpString(value);
		} else if (typeof value === 'object') {
			return objectToPhpString(value);
		} else {
			return 'null';
		}
	}

	function arrayToPhpString(arr) {
		const values = arr.map((val) => processValue(val)).join(', ');
		return `array(${values})`;
	}

	function objectToPhpString(obj) {
		const keyValuePairs = Object.entries(obj)
			.map(([key, value]) => {
				const phpKey = processValue(key);
				const phpValue = processValue(value);
				return `${phpKey} => ${phpValue}`;
			})
			.join(', ');
		return `array(${keyValuePairs})`;
	}

	if (typeof json === 'string') {
		json = JSON.parse(json);
	}

	if (Array.isArray(json)) {
		return arrayToPhpString(json);
	} else if (typeof json === 'object') {
		return objectToPhpString(json);
	} else {
		return 'null';
	}
};

module.exports = jsonToPhpArray;