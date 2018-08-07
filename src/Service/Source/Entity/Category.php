<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 11:38
 */

namespace App\Service\Source\Entity;

class Category
{
    /**
     * @var string
     */
    private $name = "";

    /**
     * @var array
     */
    private $subCategories = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getSubCategories(): array
    {
        return $this->subCategories;
    }

    /**
     * @param array $subCategories
     *
     * @return Category
     */
    public function setSubCategories(array $subCategories): Category
    {
        $this->subCategories = $subCategories;
        return $this;
    }


    /**
     * @param mixed $subCategory
     *
     * @return Category
     */
    public function addSubCategory($subCategory): Category
    {
        $this->subCategories[] = $subCategory;

        return $this;
    }

    /**
     * @param mixed $subCategory
     *
     * @return Category
     */
    public function removeSubCategory($subCategory): Category
    {
        if (FALSE !== $key = array_search($subCategory, $this->subCategories, TRUE)) {
            array_splice($this->subCategories, $key, 1);
        }

        return $this;
    }
}