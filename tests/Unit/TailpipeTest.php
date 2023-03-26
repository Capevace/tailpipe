<?php

use Illuminate\Support\Facades\Blade;
use Tailpipe\Tailpipe as TailpipeClass;
use Tailpipe\Facades\Tailpipe;

it('compiles the tailpipe blade directive correctly', function () {
    Blade::shouldReceive('directive')
        ->once()
        ->with('tailpipe', \Mockery::on(function ($callback) {
            $result = $callback("'colors.yellow.500'");
            expect($result)->toBe("<?php echo tailpipe('colors.yellow.500'); ?>");
            return true;
        }));

    $tailpipeServiceProvider = new \Tailpipe\TailpipeServiceProvider(app());
    $tailpipeServiceProvider->boot();
});

it('can be used as a class', function () {
    $tailpipe = new TailpipeClass();
    $color = $tailpipe->get('colors.yellow.500');
    expect($color)->toBe('#eab308');
});

it('can be used as a function', function () {
	$color = tailpipe('colors.yellow.500');
	expect($color)->toBe('#eab308');
});