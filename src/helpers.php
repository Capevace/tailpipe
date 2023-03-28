<?php

use Tailpipe\Tailpipe;

function tailpipe($path, bool $parse = false) {
	if (function_exists('app')) {
		return app('tailpipe')->get($path, parse: $parse);
	} else {
		return (new Tailpipe)->get($path, parse: $parse);
	}
}