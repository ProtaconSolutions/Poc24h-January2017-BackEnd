<?php
declare(strict_types=1);
/**
 * /src/App/Services/Rest/CarBrand.php
 *
 * @Book  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Services\Rest;

use App\Entity\CarBrand as Entity;
use App\Repository\CarBrand as Repository;
use Doctrine\Common\Persistence\Proxy;

// Note that these are just for the class PHPDoc block
/** @noinspection UnknownInspectionInspection */
/** @noinspection PhpHierarchyChecksInspection */
/** @noinspection PhpSignatureMismatchDuringInheritanceInspection */

/**
 * Class CarBrand
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
class CarBrand extends Base
{
    // Implement custom service methods here
}
