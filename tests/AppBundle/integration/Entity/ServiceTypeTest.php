<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Entity/ServiceTypeTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Entity;

use App\Entity\ServiceType;
use App\Tests\EntityTestCase;

/**
 * Class ServiceTypeTest
 *
 * @package AppBundle\integration\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class ServiceTypeTest extends EntityTestCase
{
    /**
     * @var ServiceType
     */
    protected $entity;

    /**
     * @var string
     */
    protected $entityName = ServiceType::class;
}
