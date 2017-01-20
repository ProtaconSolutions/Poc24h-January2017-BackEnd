<?php
declare(strict_types=1);
/**
 * /src/App/Entity/Workshop.php
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
 * Author
 *
 * @ORM\Table(
 *      name="workshop",
 *      indexes={
 *          @ORM\Index(name="created_by_id", columns={"created_by_id"}),
 *          @ORM\Index(name="updated_by_id", columns={"updated_by_id"}),
 *          @ORM\Index(name="deleted_by_id", columns={"deleted_by_id"})
 *      }
 *  )
 * @ORM\Entity(
 *      repositoryClass="App\Repository\Workshop"
 *  )
 *
 * @JMS\XmlRoot("Workshop")
 *
 * @package App\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Workshop implements EntityInterface
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
     *      "Workshop",
     *      "Workshop.id",
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
     *      "Workshop",
     *      "Workshop.name",
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
     *      "Workshop",
     *      "Workshop.description",
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
     * Collection of workshop car brands
     *
     * @var ArrayCollection<CarBrand>
     *
     * @JMS\Groups({
     *      "Workshop.carBrands",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\CarBrand>")
     * @JMS\XmlList(entry = "CarBrand")
     *
     * @ORM\ManyToMany(
     *      targetEntity="CarBrand",
     *      inversedBy="workshops",
     *      cascade={"all"},
     *  )
     * @ORM\JoinTable(
     *      name="workshop_has_car_brand"
     *  )
     */
    private $carBrands;

    /**
     * Collection of workshop car brands
     *
     * @var ArrayCollection<CarBrand>
     *
     * @JMS\Groups({
     *      "Workshop.services",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\Service>")
     * @JMS\XmlList(entry = "Service")
     *
     * @ORM\ManyToMany(
     *      targetEntity="Service",
     *      inversedBy="workshops",
     *      cascade={"all"},
     *  )
     * @ORM\JoinTable(
     *      name="workshop_has_service"
     *  )
     */
    private $services;

    /**
     * Workshop offers
     *
     * @var ArrayCollection<UserLogin>
     *
     * @JMS\Groups({
     *      "User.userLogin",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\Offer>")
     * @JMS\XmlList(entry = "userLogin")
     *
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\Offer",
     *      mappedBy="workshop",
     *      cascade={"all"},
     *  )
     */
    private $offers;

    /**
     * Workshop constructor.
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();

        $this->carBrands = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->offers = new ArrayCollection();
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
     * @return Workshop
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
     * @return Workshop
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<CarBrand>
     */
    public function getCarBrands(): Collection
    {
        return $this->carBrands;
    }

    /**
     * Method to attach new workshop to car brand.
     *
     * @param   CarBrand    $carBrand
     *
     * @return  Workshop
     */
    public function addCarBrand(CarBrand $carBrand): Workshop
    {
        if (!$this->carBrands->contains($carBrand)) {
            $this->carBrands->add($carBrand);
            $carBrand->addWorkshop($this);
        }

        return $this;
    }

    /**
     * Method to remove specified workshop from car brand.
     *
     * @param   CarBrand    $carBrand
     *
     * @return  Workshop
     */
    public function removeCarBrand(CarBrand $carBrand): Workshop
    {
        if ($this->carBrands->contains($carBrand)) {
            $this->carBrands->removeElement($carBrand);
            $carBrand->removeWorkshop($this);
        }

        return $this;
    }

    /**
     * Method to remove all many-to-many car brands relations from workshop.
     *
     * @return  Workshop
     */
    public function clearCarBrands(): Workshop
    {
        $this->carBrands->clear();

        return $this;
    }

    /**
     * @return Collection|ArrayCollection<CarBrand>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    /**
     * Method to attach new workshop to car brand.
     *
     * @param   Service $service
     *
     * @return  Workshop
     */
    public function addService(Service $service): Workshop
    {
        if (!$this->carBrands->contains($service)) {
            $this->carBrands->add($service);
            $service->addWorkshop($this);
        }

        return $this;
    }

    /**
     * Method to remove specified workshop from car brand.
     *
     * @param   Service $service
     *
     * @return  Workshop
     */
    public function removeService(Service $service): Workshop
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            $service->removeWorkshop($this);
        }

        return $this;
    }

    /**
     * Method to remove all many-to-many car brands relations from workshop.
     *
     * @return  Workshop
     */
    public function clearServices(): Workshop
    {
        $this->services->clear();

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOffers(): ArrayCollection
    {
        return $this->offers;
    }
}
