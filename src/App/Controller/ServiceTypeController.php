<?php
declare(strict_types=1);
/**
 * /src/App/Controller/ServiceTypeController.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace App\Controller;

use App\Entity\ServiceType;
use App\Entity\Workshop;
use App\Traits\Rest\Roles as RestAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ServiceTypeController
 *
 * @Route(
 *      service="app.controller.service_type",
 *      path="/service_type",
 *  )
 *
 * @package App\Controller
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class ServiceTypeController extends RestController
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
     * Method to attach workshop to specified service type.
     *
     * @Route(
     *      "/workshop/{serviceType}/{workshop}",
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
     *     "serviceType",
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
     * @param   Request     $request
     * @param   ServiceType $carBrand
     * @param   Workshop    $workshop
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function attachWorkshop(Request $request, ServiceType $carBrand, Workshop $workshop)
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
     * Method to detach workshop from specified service type.
     *
     * @Route(
     *      "/workshop/{serviceType}/{workshop}",
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
     *     "serviceType",
     *     class="AppBundle:ServiceType"
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
     * @param   ServiceType $serviceType
     * @param   Workshop    $workshop
     *
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function detachWorkshop(Request $request, ServiceType $serviceType, Workshop $workshop)
    {
        // Car brand does not have this workshop
        if (!$serviceType->getWorkshops()->contains($workshop)) {
            $message = sprintf(
                'Service type \'%s\' does not have workshop \'%s\'.',
                $serviceType->getName(),
                $workshop->getName()
            );

            throw new NotFoundHttpException($message);
        }

        // Detach workshop to car brand
        $serviceType->removeWorkshop($workshop);

        // Store car brand
        $this->getResourceService()->save($serviceType);

        return $this->getResponseService()->createResponse($request, $serviceType, 200);
    }
}
