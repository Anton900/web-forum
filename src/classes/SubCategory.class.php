<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

class SubCategory { 
	protected $id;
	protected $name = ''; 
    protected $description = ''; 
    protected $mainCatId;

	function __construct(int $id, string $name, string $description, int $mainCatId) {
		$this->id = $id;
		$this->name = $name;
        $this->description = $description;
		$this->mainCatId = $mainCatId;
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
     * Get the value of mainCatId
     */
    public function getMainCatId()
    {
        return $this->mainCatId;
    }

    /**
     * Set the value of mainCatId
     *
     * @return self
     */
    public function setMainCatId($mainCatId) : self
    {
        $this->mainCatId = $mainCatId;

        return $this;
    }
	}

    

?>
