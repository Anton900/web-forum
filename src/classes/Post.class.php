<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

class Post { 
	protected $id;
	protected $userId;
	protected $topicId;
	protected $message = '';
	protected $date = '';

	function __construct(int $id, int $userId, int $topicId, string $message, string $date){
		$this->id = $id;
		$this->userId = $userId;
		$this->topicId = $topicId;
		$this->message = $message;
		$this->date = $date;
	}
	
	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the value of message
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Set the value of message
	 *
	 * @return self
	 */
	public function setMessage($message) : self
	{
		$this->message = $message;

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
	 * Set the value of date
	 *
	 * @return self
	 */
	public function setDate($date) : self
	{
		$this->date = $date;

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

	/**
	 * Get the value of topicId
	 */
	public function getTopicId()
	{
		return $this->topicId;
	}

	/**
	 * Set the value of topicId
	 *
	 * @return self
	 */
	public function setTopicId($topicId) : self
	{
		$this->topicId = $topicId;

		return $this;
	}
}

?>
