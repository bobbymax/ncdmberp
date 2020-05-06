<?php


namespace App\Apis;

use App\ApiResource;
use App\Classes\Consumable;


class NogicApi
{

	/**
	 * 
	 * Curl Instance
	 * @var [type]
	 * 
	 */
	protected $curl;

	/**
	 * 
	 * Resource Instance
	 * @var [type]
	 * 
	 */
	protected $resource;

	/**
	 * 
	 * Curl Response
	 * @var json
	 * 
	 */
	protected $baseUrl;

	/**
	 * 
	 * Curl Response
	 * @var json
	 * 
	 */
	protected $url;

	/**
	 * 
	 * Curl Error (handle)
	 * @var [type]
	 * 
	 */
	protected $response;

	/**
	 * 
	 * Curl Error (handle)
	 * @var [type]
	 * 
	 */
	protected $errors; 

	/**
	 * 
	 * Response Keys
	 * @var [type]
	 * 
	 */
	protected $keys;

	/**
	 * 
	 * Response data
	 * @var [type]
	 * 
	 */
	protected $data;

	/**
	 * 
	 * Instanciate Curl on call
	 * returns Curl Init
	 * 
	 */
	public function __construct(ApiResource $resource)
	{
		$this->resource = $resource;
		$this->baseUrl = config('nogic.url');
		$this->curl = curl_init();
	}

	public function build()
	{
		$this->setOpt();
		$this->response = curl_exec($this->curl);
		$this->errors = curl_error($this->curl);
		curl_close($this->curl);


		return $this;
	}

	public function fetch()
	{

		if ($this->errors) {
			return "curl error #: " . $this->errors;
		}

		$this->data = json_decode($this->response, true);
		(new Consumable($this->resource))->storeKeys($this->collectKeys($this->data));

		return $this->data['data'];

	}

	private function collectKeys($data)
	{
		foreach ($data['data'] as $value) {
			$this->keys = array_keys($value);
		}

		return $this->keys;
	}


	protected function fetchUrl()
	{
		return $this->baseUrl . $this->resource->url;
	}


	protected function setOpt()
	{
		return curl_setopt_array($this->curl, $this->makeRequest());
	}

	public function makeRequest()
	{
		return [
			CURLOPT_URL => $this->fetchUrl(),
			CURLOPT_RETURNTRANSFER => config('nogic.return_transfers'),
			CURLOPT_ENCODING => config('nogic.encoding'),
			CURLOPT_MAXREDIRS => config('nogic.max_redirects'),
			CURLOPT_TIMEOUT => config('nogic.timeout'),
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => config('nogic.request'),
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"x-ibm-client-id: " . config('nogic.client_id')
			),
		];
	}
}