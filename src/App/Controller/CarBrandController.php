<?php
declare(strict_types=1);
/**
 * /src/App/Controller/CarBrandController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controller;

use App\Entity\CarBrand;
use App\Entity\Workshop;
use App\Traits\Rest\Roles as RestAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CarBrandController
 *
 * @Route(
 *      service="app.controller.car_brand",
 *      path="/car_brand",
 *  )
 *
 * @package App\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class CarBrandController extends RestController
{
    // Traits
    use RestAction\Anon\Find;
    use RestAction\Anon\FindOne;
    use RestAction\Anon\Count;
    use RestAction\Anon\Ids;
    use RestAction\Admin\Create;
    use RestAction\Admin\Update;
    use RestAction\Admin\Delete;

    /**
     * Method to attach workshop to specified car brand.
     *
     * @Route(
     *      "/workshop/{carBrand}/{workshop}",
     *      requirements={
     *          "carBrand" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *          "workshop" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *      }
     *  )
     *
     * @Method({"POST"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @ParamConverter(
     *     "carBrand",
     *     class="AppBundle:CarBrand"
     *  )
     * @ParamConverter(
     *     "workshop",
     *     class="AppBundle:Workshop"
     *  )
     *
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws  \Symfony\Component\Validator\Exception\ValidatorException
     * @throws  \Doctrine\ORM\OptimisticLockException
     * @throws  \Doctrine\ORM\ORMInvalidArgumentException
     *
     * @param   Request $request
     * @param   CarBrand $carBrand
     * @param   Workshop $workshop
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function attachWorkshop(Request $request, CarBrand $carBrand, Workshop $workshop)
    {
        // If car brand already has workshop use 200 otherwise 201
        $httpStatus = $carBrand->getWorkshops()->contains($workshop) ? 200 : 201;

        // Attach workshop to car brand
        $carBrand->addWorkshop($workshop);

        // Store car brand
        $this->getResourceService()->save($carBrand);

        return $this->getResponseService()->createResponse($request, $carBrand, $httpStatus);
    }

    /**
     * Method to detach workshop from specified car brand.
     *
     * @Route(
     *      "/workshop/{carBrand}/{workshop}",
     *      requirements={
     *          "carBrand" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *          "workshop" = "^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$",
     *      }
     *  )
     *
     * @Method({"DELETE"})
     *
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @ParamConverter(
     *     "carBrand",
     *     class="AppBundle:CarBrand"
     *  )
     * @ParamConverter(
     *     "workshop",
     *     class="AppBundle:Workshop"
     *  )
     *
     * @throws  \Doctrine\ORM\OptimisticLockException
     * @throws  \Doctrine\ORM\ORMInvalidArgumentException
     * @throws  \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws  \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws  \Symfony\Component\Validator\Exception\ValidatorException
     *
     * @param   Request     $request
     * @param   CarBrand    $carBrand
     * @param   Workshop    $workshop
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function detachWorkshop(Request $request, CarBrand $carBrand, Workshop $workshop)
    {
        // Car brand does not have this workshop
        if (!$carBrand->getWorkshops()->contains($workshop)) {
            $message = sprintf(
                'Car brand \'%s\' does not have workshop \'%s\'.',
                $carBrand->getName(),
                $workshop->getName()
            );

            throw new NotFoundHttpException($message);
        }

        // Detach workshop to car brand
        $carBrand->removeWorkshop($workshop);

        // Store car brand
        $this->getResourceService()->save($carBrand);

        return $this->getResponseService()->createResponse($request, $carBrand, 200);
    }
}
