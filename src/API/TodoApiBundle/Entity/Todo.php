<?php

namespace API\TodoApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Todo
 *
 * @ORM\Table(name="todo")
 * @ORM\Entity(repositoryClass="API\TodoApiBundle\Repository\TodoRepository")
 */
class Todo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="isDone", type="boolean")
     */
    private $isDone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="madeAt", type="datetime")
     */
    private $madeAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Todo
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isDone
     *
     * @param boolean $isDone
     *
     * @return Todo
     */
    public function setIsDone($isDone)
    {
        $this->isDone = $isDone;

        return $this;
    }

    /**
     * Get isDone
     *
     * @return bool
     */
    public function getIsDone()
    {
        return $this->isDone;
    }

    /**
     * Set madeAt
     *
     * @param \DateTime $madeAt
     *
     * @return Todo
     */
    public function setMadeAt($madeAt)
    {
        $this->madeAt = $madeAt;

        return $this;
    }

    /**
     * Get madeAt
     *
     * @return \DateTime
     */
    public function getMadeAt()
    {
        return $this->madeAt;
    }
}

