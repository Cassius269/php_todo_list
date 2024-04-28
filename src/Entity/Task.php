<?php

namespace src\Entity;

class Task
{
    // Les propriétés
    private ?int $id = null;
    private string $name;
    private bool $state = false; // false = pas encore fait
   // private int $state = 0 | 1;
    // Le constructeur :optionnel
    // La fonction d'hydration 

    public static function hydrate(array $item): self
    {
        $task = (new Task())
            ->setId($item['id'])
            ->setName($item['name'])
            ->setState($item['state']);

        return $task;
    }

    // Fonction magique pour convertir un objet en string suivant nos besoins
    public function __toString(): string
    {
        return $this->name;
    }
    // Les getteurs et setteurs



    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of state
     */
    public function getState():  bool // int j'ai changé le booléen
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */
    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }
}
