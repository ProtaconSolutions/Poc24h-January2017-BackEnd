<?php
declare(strict_types=1);
/**
 * /src/App/Repository/Workshop.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Repository;

/**
 * Doctrine repository class for Workshop entities.
 *
 * @package App\Repository
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Workshop extends Base
{
    // Implement custom entity query methods here

    /**
     * Repository method to return unique workshop cities
     *
     * @return array
     */
    public function getCities(): array
    {
        // Build query
        $query = $this
            ->createQueryBuilder('w')
            ->select('w.city')
            ->orderBy('w.city')
            ->groupBy('w.city')
        ;

        return array_map('current', $query->getQuery()->getArrayResult());
    }
}
