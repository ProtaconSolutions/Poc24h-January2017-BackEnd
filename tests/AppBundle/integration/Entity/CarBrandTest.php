<?php
declare(strict_types = 1);
/**
 * /tests/AppBundle/integration/Entity/CarBrandTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace AppBundle\integration\Entity;

use App\Entity\CarBrand;
use App\Tests\EntityTestCase;

/**
 * Class CarBrandTest
 *
 * @package AppBundle\integration\Entity
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class CarBrandTest extends EntityTestCase
{
    /**
     * @var CarBrand
     */
    protected $entity;

    /**
     * @var string
     */
    protected $entityName = CarBrand::class;
}
