<?php


namespace App\Classes;

use App\ApiResource;
use App\Nugget;


class Consumable
{
	/**
	 *
	 * Response data keys
	 * @var array
	 * 
	 */
	protected $keys = [];

	/**
	 * 
	 * Response metadata
	 * @var array
	 * 
	 */
	protected $meta = [];

	/**
	 *
	 * Response data
	 * @var array
	 * 
	 */
	protected $data = [];

	/**
	 *
	 * Api Resource Instance
	 * @var [type]
	 * 
	 */
	protected $resource;

	/**
	 * Instantiate Variables
	 */
	public function __construct(ApiResource $resource)
	{
		$this->resource = $resource;
	}

	public function exists($key)
    {
    	return Nugget::where('key', $key)->first();
    }


	public function storeKeys(array $keys)
	{
		foreach ($keys as $value) {
    		if (! $this->exists($value)) {
    			Nugget::create([
		    		'api_resource_id'  => $this->resource->id,
		    		'key' => $value,
		    	]);
    		}
    	}
	}

}