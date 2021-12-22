<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

class MainCategory { 
	protected $id;
	protected $name = ''; 
	protected $subCategories = array();

	function __construct(int $id, string $name){
		$this->id = $id;
		$this->name = $name;
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the value of name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return self
	 */
	public function setName($name) : self
	{
		$this->name = $name;

		return $this;
	}
	}

    

?>
