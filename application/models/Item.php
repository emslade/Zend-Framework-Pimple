<?php
/**
 * @Entity
 * @Table(name="item")
 */
class Application_Model_Item
{
	/** @Id @GenerateValue @Column(type="integer") */
	private $id;

	/** @Column(type="string") */
	private $name;

	/** @Column(type="string") */
	private $value;

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function __toString()
	{
		return sprintf('%s: %s', $this->name, $this->value);
	}
}
