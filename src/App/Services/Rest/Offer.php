<?php
declare(strict_types=1);
/**
 * /src/App/Services/Rest/Offer.php
 *
 * @Book  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Services\Rest;

use App\Entity\Interfaces\EntityInterface;
use App\Entity\Offer as Entity;
use App\Entity\Workshop as WorkshopEntity;
use App\Repository\Offer as Repository;
use App\Services\Rest\Workshop as WorkshopService;
use Doctrine\Common\Persistence\Proxy;

// Note that these are just for the class PHPDoc block
/** @noinspection UnknownInspectionInspection */
/** @noinspection PhpHierarchyChecksInspection */
/** @noinspection PhpSignatureMismatchDuringInheritanceInspection */

/**
 * Class Offer
 *
 * @package App\Services\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 *
 * @method  Repository      getRepository(): Repository
 * @method  Proxy|Entity    getReference(string $id): Proxy
 * @method  Entity[]        find(array $criteria = [], array $orderBy = [], int $limit = null, int $offset = null, array $search = []): array
 * @method  null|Entity     findOne(string $id, bool $throwExceptionIfNotFound = false)
 * @method  null|Entity     findOneBy(array $criteria, array $orderBy = [], bool $throwExceptionIfNotFound = false)
 * @method  Entity          create(\stdClass $data): Entity
 * @method  Entity          save(Entity $entity, bool $skipValidation = false): Entity
 * @method  Entity          update(string $id, \stdClass $data): Entity
 * @method  Entity          delete(string $id): Entity
 */
class Offer extends Base
{
    /**
     * @var WorkshopService
     */
    private $workshopService;

    /**
     * Setter for Workshop service
     *
     * @param   WorkshopService $workshopService
     *
     * @return  Offer
     */
    public function setWorkshopService(WorkshopService $workshopService)
    {
        $this->workshopService = $workshopService;

        return $this;
    }

    /**
     * Before lifecycle method for create method.
     *
     * @param   \stdClass               $data
     * @param   EntityInterface|Entity  $entity
     */
    public function beforeCreate(\stdClass $data, EntityInterface $entity)
    {
        $this->processFormData($data);
    }

    /**
     * Before lifecycle method for update method.
     *
     * @param   string                  $id
     * @param   \stdClass               $data
     * @param   EntityInterface|Entity $entity
     */
    public function beforeUpdate(string &$id, \stdClass $data, EntityInterface $entity)
    {
        $this->processFormData($data);
    }

    /**
     * Method to convert workshop GUID to entity reference.
     *
     * @param   \stdClass   $data
     */
    private function processFormData(\stdClass $data)
    {
        if (property_exists($data, 'workshop') &&
            $data->workshop !== null &&
            !($data->workshop instanceof WorkshopEntity)
        ) {
            $data->workshop = $this->workshopService->getReference(
                is_object($data->workshop) ? $data->workshop->id : $data->workshop
            );
        }
    }
}
