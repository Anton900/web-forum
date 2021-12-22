<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

class Topic { 
	protected $id;
	protected $subCatId;
	protected $userId;
	protected $name = '';

	function __construct(int $id, int $subCatId, int $userId, string $name){
		$this->id = $id;
		$this->subCatId = $subCatId;
		$this->userId = $userId;
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
	 * Get the value of subCatid
	 */
	public function getSubCatId()
	{
		return $this->subCatId;
	}

	/**
	 * Set the value of subCatid
	 *
	 * @return self
	 */
	public function setSubCatId($subCatId) : self
	{
		$this->subCatId = $subCatId;

		return $this;
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

	/**
	 * Get the value of description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set the value of description
	 *
	 * @return self
	 */
	public function setDescription($description) : self
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get the value of userId
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * Set the value of userId
	 *
	 * @return self
	 */
	public function setUserId($userId) : self
	{
		$this->userId = $userId;

		return $this;
	}
}

?>
