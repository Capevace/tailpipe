const jsonToPhpArray = require('./json-to-php');

test('Converts JSON object to PHP array string', () => {
	const json = JSON.stringify({
		name: 'John',
		age: 30,
		city: 'New York'
	});

	expect(jsonToPhpArray(json)).toBe(
		"array('name' => 'John', 'age' => 30, 'city' => 'New York')"
	);
});

test('Converts JSON array to PHP array string', () => {
	const json = JSON.stringify(['apple', 'banana', 'cherry']);
	expect(jsonToPhpArray(json)).toBe("array('apple', 'banana', 'cherry')");
});

test('Converts nested JSON object to PHP array string', () => {
	const json = JSON.stringify({
		colors: ['red', 'green'],
		numbers: [1, 2, 3]
	});

	expect(jsonToPhpArray(json)).toBe(
		"array('colors' => array('red', 'green'), 'numbers' => array(1, 2, 3))"
	);
});

test('Converts deeply nested JSON object to PHP array string', () => {
	const json = JSON.stringify({
		colors: {
			red: '#ff0000',
			green: '#00ff00',
			primary: {
				100: '#f0f8ff',
				200: '#e1f2ff',
				300: '#cfe8ff',
				400: '#bfe0ff',
				500: '#a0d8ff',
				600: '#90d0ff',
				700: '#80c8ff',
				800: '#70c0ff',
				900: '#60b8ff',
			}
		},
		numbers: {
			one: 1,
			two: 2,
			three: 3
		},
	});

	expect(jsonToPhpArray(json)).toBe(
		"array('colors' => array('red' => '#ff0000', 'green' => '#00ff00', 'primary' => array('100' => '#f0f8ff', '200' => '#e1f2ff', '300' => '#cfe8ff', '400' => '#bfe0ff', '500' => '#a0d8ff', '600' => '#90d0ff', '700' => '#80c8ff', '800' => '#70c0ff', '900' => '#60b8ff')), 'numbers' => array('one' => 1, 'two' => 2, 'three' => 3))"
	);
});
