<?php

namespace Tailpipe;

use Illuminate\Support\Arr;

class Tailpipe
{
    protected ?array $tailwind = null;

    protected function initIfRequired(): void
    {
        if ($this->tailwind === null) {
            $this->tailwind = include $this->getTailpipePath();
        }
    }

	protected function getTailpipePath(): string
	{
		return env('TAILPIPE_PATH') ?? resource_path('css/tailpipe.php');
	}

    public function get(string $path): string|array|null
    {
        static::initIfRequired();

        return Arr::get($this->tailwind, $path);
    }
}
