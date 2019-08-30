<?php
declare(strict_types=1);

namespace App\Api\RequestHandler;

use App\Presenter\PersonPresenterInterface;
use App\Presenter\PostalAddressPresenterInterface;
use Enm\JsonApi\Exception\BadRequestException;
use Enm\JsonApi\Exception\ResourceNotFoundException;
use Enm\JsonApi\Mapper\ResourceMapperInterface;
use Enm\JsonApi\Model\Request\RequestInterface;
use Enm\JsonApi\Model\Response\DocumentResponse;
use Enm\JsonApi\Model\Response\ResponseInterface;
use Throwable;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class PostalAddressHandler extends AbstractRequestHandler
{
    /**
     * @var PersonPresenterInterface
     */
    private $personPresenter;

    /**
     * @var PostalAddressPresenterInterface
     */
    private $postalAddressPresenter;

    /**
     * @param ResourceMapperInterface $resourceMapper
     * @param PersonPresenterInterface $personPresenter
     * @param PostalAddressPresenterInterface $postalAddressPresenter
     */
    public function __construct(
        ResourceMapperInterface $resourceMapper,
        PersonPresenterInterface $personPresenter,
        PostalAddressPresenterInterface $postalAddressPresenter
    ) {
        parent::__construct($resourceMapper);
        $this->personPresenter = $personPresenter;
        $this->postalAddressPresenter = $postalAddressPresenter;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws Throwable
     */
    public function fetchResource(RequestInterface $request): ResponseInterface
    {
        $postalAddress = $this->postalAddressPresenter->showPostalAddressById($request->id());
        if (!$postalAddress) {
            throw new ResourceNotFoundException($request->type(), $request->id());
        }

        $resource = $this->resource($request->type(), $request->id());
        $this->mapEntityToResource($postalAddress, $resource, $request);

        return new DocumentResponse(
            $this->singleResourceDocument($resource)
        );
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws Throwable
     */
    public function fetchResources(RequestInterface $request): ResponseInterface
    {
        $view = $this->postalAddressPresenter->createView(
            $this->extractOffsetFromRequest($request),
            $this->extractLimitFromRequest($request)
        );

        return $this->createDocumentResponse($view->getPostalAddresses(), $request, $view);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws Throwable
     */
    public function fetchRelationship(RequestInterface $request): ResponseInterface
    {
        if ($request->relationship() !== 'person') {
            throw new BadRequestException('Relationship ' . $request->relationship() . ' does not exist.');
        }

        $person = $this->personPresenter->showPersonByPostalAddressId($request->id());

        $resource = $this->resource($request->type(), $request->id());
        $this->mapEntityToResource($person, $resource, $request);

        return new DocumentResponse(
            $this->singleResourceDocument($resource)
        );
    }
}
