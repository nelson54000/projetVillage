<?php
namespace App\Entity;


class PropertySearch
{



/**
 * 
 * @var int|null
 * 
 */
private $maxPrice;


/**
 * 
 * @var int|null
 * 
 */

private $minSurface;


/**
 * Get the value of maxPrice
 *
 * @return  int|null
 */ 
public function getMaxPrice(): ?int
{
return $this->maxPrice;
}

/**
 * Set the value of maxPrice
 *
 * @param  int|null  $maxPrice
 *
 * @return  self
 */ 
public function setMaxPrice($maxPrice): PropertySearch
{
$this->maxPrice = $maxPrice;

return $this;
}

/**
 * Get the value of minSurface
 */ 
public function getMinSurface()
{
return $this->minSurface;
}


/**
 * Set the value of minSurface
 *
 * @return  self
 */ 
public function setMinSurface($minSurface): PropertySearch
{
$this->minSurface = $minSurface;

return $this;
}
}


