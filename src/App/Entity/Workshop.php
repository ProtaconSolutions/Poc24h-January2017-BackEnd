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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Workshop
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
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Workshop",
     *      "Workshop.id",
     *      "Offer",
     *      "Offer.workshop",
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
     *      "Workshop",
     *      "Workshop.name",
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
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Workshop",
     *      "Workshop.email",
     *  })
     * @JMS\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Email()
     *
     * @ORM\Column(
     *      name="email",
     *      type="string",
     *      length=255,
     *      nullable=false
     *  )
     */
    private $email;

    /**
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Workshop",
     *      "Workshop.phone",
     *  })
     * @JMS\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(
     *      name="phone",
     *      type="string",
     *      length=255,
     *      nullable=false
     *  )
     */
    private $phone;

    /**
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Workshop",
     *      "Workshop.city",
     *  })
     * @JMS\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(
     *      name="city",
     *      type="string",
     *      length=255,
     *      nullable=false
     *  )
     */
    private $city;

    /**
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Workshop",
     *      "Workshop.postalCode",
     *  })
     * @JMS\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(
     *      name="postal_code",
     *      type="string",
     *      length=255,
     *      nullable=false
     *  )
     */
    private $postalCode;

    /**
     * @var string
     *
     * @JMS\Groups({
     *      "Default",
     *      "Workshop",
     *      "Workshop.address",
     *  })
     * @JMS\Type("string")
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(
     *      name="address",
     *      type="string",
     *      length=255,
     *      nullable=false
     *  )
     */
    private $address;

    /**
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
     *      nullable=true,
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
     * @JMS\XmlList(entry = "CarBrands")
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
     * Collection of workshop service types
     *
     * @var ArrayCollection<ServiceType>
     *
     * @JMS\Groups({
     *      "Workshop.serviceTypes",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\ServiceType>")
     * @JMS\XmlList(entry = "serviceType")
     *
     * @ORM\ManyToMany(
     *      targetEntity="ServiceType",
     *      inversedBy="workshops",
     *      cascade={"all"},
     *  )
     * @ORM\JoinTable(
     *      name="workshop_has_service_type"
     *  )
     */
    private $serviceTypes;

    /**
     * Workshop offers
     *
     * @var ArrayCollection<UserLogin>
     *
     * @JMS\Groups({
     *      "Workshop.offers",
     *  })
     * @JMS\Type("ArrayCollection<App\Entity\Offer>")
     * @JMS\XmlList(entry = "Offer")
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
        $this->serviceTypes = new ArrayCollection();
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
     * @return Collection|ArrayCollection<ServiceType>
     */
    public function getServiceTypes(): Collection
    {
        return $this->serviceTypes;
    }

    /**
     * Method to attach new workshop to car brand.
     *
     * @param   ServiceType $serviceType
     *
     * @return  Workshop
     */
    public function addServiceType(ServiceType $serviceType): Workshop
    {
        if (!$this->serviceTypes->contains($serviceType)) {
            $this->serviceTypes->add($serviceType);
            $serviceType->addWorkshop($this);
        }

        return $this;
    }

    /**
     * Method to remove specified workshop from car brand.
     *
     * @param   ServiceType $serviceType
     *
     * @return  Workshop
     */
    public function removeServiceType(ServiceType $serviceType): Workshop
    {
        if ($this->serviceTypes->contains($serviceType)) {
            $this->serviceTypes->removeElement($serviceType);
            $serviceType->removeWorkshop($this);
        }

        return $this;
    }

    /**
     * Method to remove all many-to-many car brands relations from workshop.
     *
     * @return  Workshop
     */
    public function clearServiceTypes(): Workshop
    {
        $this->serviceTypes->clear();

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOffers(): ArrayCollection
    {
        return $this->offers;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Workshop
     */
    public function setEmail(string $email): Workshop
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return Workshop
     */
    public function setPhone(string $phone): Workshop
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Workshop
     */
    public function setCity(string $city): Workshop
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return Workshop
     */
    public function setPostalCode(string $postalCode): Workshop
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return Workshop
     */
    public function setAddress(string $address): Workshop
    {
        $this->address = $address;

        return $this;
    }
}
