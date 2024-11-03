<?php

namespace Plugin\BootechMemberOnlyProduct41\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="plg_member_only_product_config")
 * @ORM\Entity(repositoryClass="Plugin\BootechMemberOnlyProduct41\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $product_list_order_by_id;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string")
     */
    private $message;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProductListOrderById()
    {
        return $this->product_list_order_by_id;
    }

    /**
     * @param int $product_list_order_by_id
     * @return Config
     */
    public function setProductListOrderById($product_list_order_by_id)
    {
        $this->product_list_order_by_id = $product_list_order_by_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return Config
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this;
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return $this;
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
