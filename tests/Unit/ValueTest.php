<?php

it('can get a built-in color', function () {
    $color = tailpipe('colors.yellow.500');
    expect($color)->toBe('#eab308');
});

it('can get a custom color', function () {
    $color = tailpipe('colors.primary.700');
    expect($color)->toBe('#b2b2b2');
});

it('can get screens', function () {
	$spacing = tailpipe('screens.sm');
	expect($spacing)->toBe('640px');
});

it('can get spacing', function () {
	$spacing = tailpipe('spacing.4');
	expect($spacing)->toBe('1rem');
});

it('can get font size', function () {
	// The font size property returns an array with extra values like line-height and letter-spacing.
	// The first value is the font size.
	$fontSize = tailpipe('fontSize.2xl.0');
	expect($fontSize)->toBe('1.5rem');
});

it('can get font weight', function () {
	$fontWeight = tailpipe('fontWeight.bold');
	expect($fontWeight)->toBe('700');
});

it('can get font family', function () {
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
	$fontFamily = tailpipe('fontFamily.sans');
	expect($fontFamily)->toBe($fonts);
});

it('can get line height', function () {
	$lineHeight = tailpipe('lineHeight.10');
	expect($lineHeight)->toBe('2.5rem');
});

it('can get letter spacing', function () {
	$letterSpacing = tailpipe('letterSpacing.wide');
	expect($letterSpacing)->toBe('0.025em');
});

it('can get border width', function () {
	$borderWidth = tailpipe('borderWidth.2');
	expect($borderWidth)->toBe('2px');
});