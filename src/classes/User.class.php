<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

class User { 
	protected $id;
	protected $username = ''; 
	protected $password = '';
	protected $description = '';
	protected $date = '';
	protected $admin;

	function __construct(int $id, string $username, string $password, string $description, string $date, int $admin){
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->description = $description;
		$this->date = $date;
		$this->admin = $admin;
		
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the value of username
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the value of password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return self
	 */
	public function setPassword($password) : self
	{
		$this->password = $password;

		return $this;
	}

	

	/**
	 * Get the value of date
	 */
	public function getDate()
	{
		return $this->date;
	}


	/**
	 * Get the value of admin
	 */
	public function getAdmin()
	{
		return $this->admin;
	}

	/**
	 * Set the value of admin
	 *
	 * @return self
	 */
	public function setAdmin($admin) : self
	{
		$this->admin = $admin;

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
}

?>
