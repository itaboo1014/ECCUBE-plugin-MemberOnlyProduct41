<?php

namespace Plugin\BootechMemberOnlyProduct41\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation as Eccube;

/**
 * @Eccube\EntityExtension("Eccube\Entity\Product")
 */
trait ProductTrait
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="only_member", type="boolean", options={"default":false})
     */
    private $only_member = false;

    /**
     * @return boolean
     */
    public function getOnlyMember()
    {
        return $this->only_member;
    }

    /**
     * @param boolean $only_member
     */
    public function setOnlyMember($only_member)
    {
        $this->only_member = $only_member;
    }
}
