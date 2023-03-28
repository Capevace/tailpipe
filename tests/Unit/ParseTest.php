<?php

it('can parse pixel values', function () {
    $pixels = tailpipe('screens.sm', parse: true);
    expect($pixels)->toBe(640);
});

it('can parse rem values', function () {
	$rem = tailpipe('fontSize.2xl.0', parse: true);
	expect($rem)->toBe(1.5);
});

it('can parse hex values', function () {
	$hex = tailpipe('colors.yellow.500', parse: true);
	expect($hex)->toBe('eab308');
});

it('can parse font families', function () {
	$fonts = [
		'ui-sans-serif',
		'system-ui',
		'-apple-system',
		'BlinkMacSystemFont',
		'"Segoe UI"',
		'Roboto',
		'"Helvetica Neue"',
		'Arial',
		'"Noto Sans"',
		'sans-serif',
		'"Apple Color Emoji"',
		'"Segoe UI Emoji"',
		'"Segoe UI Symbol"',
		'"Noto Color Emoji"',
	];
	$fontFamily = tailpipe('fontFamily.sans', parse: true);
	expect($fontFamily)->toBe($fonts);
});

it('can parse font weights', function () {
	$fontWeight = tailpipe('fontWeight.bold', parse: true);
	expect($fontWeight)->toBe(700);
});

it('can parse spacing', function () {
	$spacing = tailpipe('spacing.4', parse: true);
	expect($spacing)->toBe(1);
});

it('can parse floats', function () {
	$float = tailpipe('opacity.50', parse: true);
	expect($float)->toBe(0.5);
});

it('can parse percentages', function () {
	$percentage = tailpipe('width.1/2', parse: true);
	expect($percentage)->toBe(0.5);
});