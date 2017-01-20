<?php
declare(strict_types=1);
/**
 * /src/App/Entity/CarBrand.php
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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Author
 *
 * @ORM\Table(
 *      name="car_brand",
 *      indexes={
 *          @ORM\Index(name="created_by_id", columns={"created_by_id"}),
 *          @ORM\Index(name="updated_by_id", columns={"updated_by_id"}),
 *          @ORM\Index(name="deleted_by_id", columns={"deleted_by_id"})
 *      }
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repository\CarBrand"
 *  )
 *
 * @JMS\XmlRoot("CarBrand")
 *
 * @package App\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class CarBrand implements EntityInterface
{
    // Traits
    use ORMBehaviors\Blameable;
    use ORMBehaviors\Timestampable;

    /**
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "CarBrand",
     *      "CarBrand.id",
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
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "CarBrand",
     *      "CarBrand.name",
     *  })
     * @JMS\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(
     *      max = 255,
     *  )
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
     * @var string|null
     *
     * @JMS\Groups({
     *      "Default",
     *      "CarBrand",
     *      "CarBrand.description",
     *  })
     * @JMS\Type("string")
     *
     * @ORM\Column(
     *      name="description",
     *      type="text",
     *      nullable=true,
     *  )
     */
    private $description;

    /**
     * Collection of car brand workshops
     *
     * @var ArrayCollection<Workshop>
     *
     * @JMS\Groups({
     *      "CarBrand.workshops",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\Workshop>")
     * @JMS\XmlList(entry = "Workshop")
     *
     * @ORM\ManyToMany(
     *      targetEntity="Workshop",
     *      mappedBy="carBrands",
     *      cascade={"all"},
     *  )
     * @ORM\JoinTable(
     *      name="workshop_has_car_brand"
     *  )
     */
    private $workshops;

    /**
     * CarBrand constructor.
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();

        $this->workshops = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * @return CarBrand
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return CarBrand
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<Workshop>
     */
    public function getWorkshops(): Collection
    {
        return $this->workshops;
    }

    /**
     * Method to attach new workshop to car brand.
     *
     * @param   Workshop    $workshop
     *
     * @return  CarBrand
     */
    public function addWorkshop(Workshop $workshop): CarBrand
    {
        if (!$this->workshops->contains($workshop)) {
            $this->workshops->add($workshop);
            $workshop->addCarBrand($this);
        }

        return $this;
    }

    /**
     * Method to remove specified workshop from car brand.
     *
     * @param   Workshop    $workshop
     *
     * @return  CarBrand
     */
    public function removeWorkshop(Workshop $workshop): CarBrand
    {
        if ($this->workshops->contains($workshop)) {
            $this->workshops->removeElement($workshop);
            $workshop->removeCarBrand($this);
        }

        return $this;
    }

    /**
     * Method to remove all many-to-many workshop relations from car brand.
     *
     * @return  CarBrand
     */
    public function clearWorkshops(): CarBrand
    {
        $this->workshops->clear();

        return $this;
    }
}
