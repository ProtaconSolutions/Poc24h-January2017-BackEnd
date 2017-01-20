<?php
declare(strict_types=1);
/**
 * /src/App/Entity/Offer.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Entity;

use App\Doctrine\Behaviours as ORMBehaviors;
use App\Entity\Interfaces\EntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Ramsey\Uuid\Uuid;

/**
 * Class Offer
 *
 * @ORM\Table(
 *      name="offer",
 *      indexes={
 *          @ORM\Index(name="created_by_id", columns={"created_by_id"}),
 *          @ORM\Index(name="updated_by_id", columns={"updated_by_id"}),
 *          @ORM\Index(name="deleted_by_id", columns={"deleted_by_id"}),
 *          @ORM\Index(name="workshop_id", columns={"workshop_id"}),
 *      }
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repository\Offer"
 *  )
 *
 * @JMS\XmlRoot("Service")
 *
 * @package App\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Offer
{
    // Traits
    use ORMBehaviors\Blameable;
    use ORMBehaviors\Timestampable;

    /**
     * Offer ID.
     *
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Offer",
     *      "Offer.id",
     *  })
     * @JMS\Type("string")
     *
     * @ORM\Column(
     *      name="id",
     *      type="guid",
     *      nullable=false,
     *  )
     * @ORM\Id()
     */
    private $id;

    /**
     * @var \App\Entity\Workshop
     *
     * @JMS\Groups({
     *      "Default",
     *      "Offer",
     *      "Offer.workshop",
     *  })
     * @JMS\Type("App\Entity\Workshop")
     *
     * @ORM\ManyToOne(
     *      targetEntity="App\Entity\Workshop",
     *      inversedBy="offers",
     *      cascade={"persist"},
     *  )
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(
     *          name="workshop_id",
     *          referencedColumnName="id",
     *          onDelete="CASCADE",
     *      ),
     *  })
     */
    private $workshop;

    /**
     * Car brand name.
     *
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Offer",
     *      "Offer.name",
     *  })
     * @JMS\Type("string")
     *
     * @ORM\Column(
     *      name="name",
     *      type="string",
     *      length=255,
     *      nullable=false,
     *  )
     */
    private $name;

    /**
     * Author description.
     *
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Offer",
     *      "Offer.description",
     *  })
     * @JMS\Type("string")
     *
     * @ORM\Column(
     *      name="description",
     *      type="text",
     *      nullable=false,
     *  )
     */
    private $description;

    /**
     * @var float
     *
     * @JMS\Groups({
     *      "Default",
     *      "Offer",
     *  })
     *
     * @ORM\Column(
     *      name="price",
     *      type="decimal",
     *      precision=12,
     *      scale=2,
     *      nullable=true,
     *  )
     */
    private $price = 0;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Workshop
     */
    public function getWorkshop(): Workshop
    {
        return $this->workshop;
    }

    /**
     * @param Workshop $workshop
     *
     * @return Offer
     */
    public function setWorkshop(Workshop $workshop)
    {
        $this->workshop = $workshop;

        return $this;
    }

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
     * @return Offer
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Offer
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return Offer
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }
}
