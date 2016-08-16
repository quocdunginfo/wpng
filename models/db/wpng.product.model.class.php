<?php
/**
 * @Entity @Table(name="doctrine_products")
 */
class WpngProductModel
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
	public $id;
	/** @Column(length=200) */
    public $name;
}