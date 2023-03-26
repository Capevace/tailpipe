<?php

namespace Tailpipe\Tests;

use Tailpipe\TailpipeServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	protected function getPackageProviders($app)
	{
		return [
			TailpipeServiceProvider::class,
		];
	}
	
	protected function getEnvironmentSetUp($app)
	{
		// define TAILPIPE_PATH ENV variable dynamically
		$path = __DIR__ . '/tests/css/tailpipe.php';
		putenv("TAILPIPE_PATH={$path}");
	}
	
	protected function getPackageAliases($app)
	{
		return [
			'Tailpipe' => 'Tailpipe\Facades\Tailpipe'
		];
	}
}