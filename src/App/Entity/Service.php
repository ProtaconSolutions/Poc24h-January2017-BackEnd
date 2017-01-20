<?php
declare(strict_types=1);
/**
 * /src/App/Entity/Service.php
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
 * Class Service
 *
 * @ORM\Table(
 *      name="service",
 *      indexes={
 *          @ORM\Index(name="created_by_id", columns={"created_by_id"}),
 *          @ORM\Index(name="updated_by_id", columns={"updated_by_id"}),
 *          @ORM\Index(name="deleted_by_id", columns={"deleted_by_id"})
 *      }
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repository\Service"
 *  )
 *
 * @JMS\XmlRoot("Service")
 *
 * @package App\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Service implements EntityInterface
{
    // Traits
    use ORMBehaviors\Blameable;
    use ORMBehaviors\Timestampable;

    /**
     * Car brand ID.
     *
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Service",
     *      "Service.id",
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
     * Car brand name.
     *
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Service",
     *      "Service.name",
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
     *      "Service",
     *      "Service.description",
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
     * Collection of service workshops
     *
     * @var ArrayCollection<Workshop>
     *
     * @JMS\Groups({
     *      "Service.workshops",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\Workshop>")
     * @JMS\XmlList(entry = "Workshop")
     *
     * @ORM\ManyToMany(
     *      targetEntity="Workshop",
     *      mappedBy="services",
     *      cascade={"all"},
     *  )
     * @ORM\JoinTable(
     *      name="workshop_has_service"
     *  )
     */
    private $workshops;

    /**
     * Service constructor.
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
     * @return Service
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
     * @return Service
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
     * Method to attach new workshop to service.
     *
     * @param   Workshop    $workshop
     *
     * @return  Service
     */
    public function addWorkshop(Workshop $workshop): Service
    {
        if (!$this->workshops->contains($workshop)) {
            $this->workshops->add($workshop);
            $workshop->addService($this);
        }

        return $this;
    }

    /**
     * Method to remove specified workshop from service.
     *
     * @param   Workshop    $workshop
     *
     * @return  Service
     */
    public function removeWorkshop(Workshop $workshop): Service
    {
        if ($this->workshops->contains($workshop)) {
            $this->workshops->removeElement($workshop);
            $workshop->removeService($this);
        }

        return $this;
    }

    /**
     * Method to remove all many-to-many workshop relations from service.
     *
     * @return  Service
     */
    public function clearWorkshops(): Service
    {
        $this->workshops->clear();

        return $this;
    }
}
