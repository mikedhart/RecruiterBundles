<?php

namespace Recruiter\CommonBundle\Entity;

class ProfilePageComponent
{
	/**
	 * Holds the title for which this component represents.
	 * 
	 * @var string
	 */
	private $title;
	
	/**
	 * Holds the key by which this component should by identified.
	 * 
	 * @var string
	 */
	private $key;
	
	/**
	 * Holds the collection of data for which this component represents.
	 * 
	 * @var
	 */
	private $collection;
	
	/**
	 * Holds the route to which this component can be edited.
	 *
	 * @var
	 */
	private $edit_route;
	
	/**
	 * @return string
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @return string
	 */
	public function getCollection()
	{
		return $this->collection;
	}
	
	/**
	 * @return string
	 */
	public function getEditRoute()
	{
		return $this->edit_route;
	}
	
	/**
	 * Sets the key
	 * 
	 * @param string $key
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}
	
	/**
	 * Sets the title
	 * 
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/**
	 * Sets the collection
	 * 
	 * @param unknown $collection
	 */
	public function setCollection($collection)
	{
		$this->collection = $collection;
	}
	
	/**
	 * Sets the edit route
	 *
	 * @param string $collection
	 */
	public function setEditRoute($route)
	{
		$this->edit_route = $route;
	}
}
