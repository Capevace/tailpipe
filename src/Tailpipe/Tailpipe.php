<?php

namespace Tailpipe;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Arr;
use InvalidArgumentException;

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

	/**
	 * Get a value from the tailwind config.
	 * 
	 * @param string $path The path to the value. E.g. "colors.red.500"
	 * @param bool $parse Whether to parse the value. This will remove hashtags from hex or units from numbers.
	 * @return string|int|float|array|null 
	 */
    public function get(string $path, bool $parse = false): string|array|int|float|null
    {
        static::initIfRequired();

		$value = Arr::get($this->tailwind, $path);

		if ($parse) {
			$value = $this->parseValue($value);
		}

        return $value;
    }

	/**
	 * Tries to parse a value, if it is a string.
	 * 
	 * - Replaces the hashtag from hex values.
	 * - Removes units from numbers.
	 * 
	 * @param mixed $value 
	 * @return mixed 
	 */
	public function parseValue(mixed $value): mixed
	{
		if (is_string($value)) {
			return $this->parseString($value);
		} else {
			return $value;
		}
	}

	protected function parseString(string $value): string | float | int
	{
		$str = str($value);

		if ($str->startsWith('#')) {
			return $str->replaceFirst('#', '');
		} else {
			$parsed = match (true) {
				$str->endsWith('px') => $str->replaceLast('px', ''),
				$str->endsWith('rem') => $str->replaceLast('rem', ''),
				$str->endsWith('em') => $str->replaceLast('em', ''),
				$str->endsWith('vw') => $str->replaceLast('vw', ''),
				$str->endsWith('vh') => $str->replaceLast('vh', ''),
				$str->endsWith('vmin') => $str->replaceLast('vmin', ''),
				$str->endsWith('vmax') => $str->replaceLast('vmax', ''),
				$str->endsWith('deg') => $str->replaceLast('deg', ''),
				$str->endsWith('rad') => $str->replaceLast('rad', ''),
				$str->endsWith('turn') => $str->replaceLast('turn', ''),
				$str->endsWith('ms') => $str->replaceLast('ms', ''),
				$str->endsWith('s') => $str->replaceLast('s', ''),
				$str->endsWith('%') => str($str->replaceLast('%', '')->toString() / 100),
				filled($str->match("/^[\d\.]+$/")) => $str,
				default => null,
			};

			if (filled($parsed)) {
				return $parsed->contains('.')
					? floatval($parsed->toString())
					: intval($parsed->toString());
			}

			return $value;
		}
	}
}
