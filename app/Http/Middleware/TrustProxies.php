<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
	/**
	 * The trusted proxies for this application.
	 *
	 * If you are using Amazon AWS or another "cloud" load
	 * balancer provider, you may not know the IP addresses of your actual balancers. In this case, you may use * to
	 * trust all proxies:
	 *
	 * @var string|array
	 */
	protected $proxies = '*';

	/**
	 * The headers that should be used to detect proxies.
	 *
	 * @var string
	 */
	protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
}
