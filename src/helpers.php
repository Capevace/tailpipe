<?php

use Tailpipe\Tailpipe;

function tailpipe($path) {
	if (function_exists('app')) {
		return app('tailpipe')->get($path);
	} else {
		return (new Tailpipe)->get($path);
	}
}