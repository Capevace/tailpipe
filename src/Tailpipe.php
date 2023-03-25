<?php

namespace Tailpipe;

use Illuminate\Support\Arr;

class Tailpipe
{
    protected static ?array $tailwind = null;

    protected static function initIfRequired(): void
    {
        if (static::$tailwind === null) {
            static::$tailwind = [
				'colors' => include resource_path('css/tailpipe.php')
			];
        }
    }

    public function get(string $path): ?string
    {
        static::initIfRequired();

        return Arr::get(static::$tailwind, $path);
    }
}
