<?php

namespace AppCommon\CommonLayoutBundle;

class UrlAssemblyHelper {
	
	/**
	 * Get url decomposed on parts in array.
	 * 
	 * @param string $url
	 */
	public function decompile($url) {
		$info = parse_url($url);
		
		if(isset($info['query'])) {
			$info['query_params'] = [];
			parse_str($info['query'], $info['query_params']);
		}
		
		return $info;
	}
	
	public function compile(array $parsed_url) {
		if($parsed_url['query_params']) {
			$parsed_url['query'] = http_build_query($parsed_url['query_params']);
		}
		
		return $this->unparse_url($parsed_url);
	}
	
	function unparse_url($parsed_url) {
		$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
		$host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
		$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
		$user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
		$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
		$pass     = ($user || $pass) ? "$pass@" : '';
		$path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
		$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
		$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
		
		return "$scheme$user$pass$host$port$path$query$fragment";
	}
}
