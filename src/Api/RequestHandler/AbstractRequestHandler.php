<?php
declare(strict_types=1);

namespace App\Api\RequestHandler;

use App\Model\View\AbstractView;
use Enm\JsonApi\Exception\NotAllowedException;
use Enm\JsonApi\JsonApiTrait;
use Enm\JsonApi\Mapper\ResourceMapperInterface;
use Enm\JsonApi\Model\Document\OffsetBasedPaginatedDocument;
use Enm\JsonApi\Model\Request\RequestInterface;
use Enm\JsonApi\Model\Resource\ResourceInterface;
use Enm\JsonApi\Model\Response\DocumentResponse;
use Enm\JsonApi\Model\Response\ResponseInterface;
use Enm\JsonApi\Server\RequestHandler\RequestHandlerInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
abstract class AbstractRequestHandler implements RequestHandlerInterface
{
    use JsonApiTrait;

    /**
     * @var ResourceMapperInterface
     */
    private $resourceMapper;

    /**
     * @param ResourceMapperInterface $resourceMapper
     */
    public function __construct(ResourceMapperInterface $resourceMapper)
    {
        $this->resourceMapper = $resourceMapper;
    }

    /**
     * @param object $entity
     * @param ResourceInterface $resource
     * @param RequestInterface $request
     */
    protected function mapEntityToResource(object $entity, ResourceInterface $resource, RequestInterface $request): void
    {
        $this->resourceMapper->mapObject($entity, $resource, $request);
    }

    /**
     * @param RequestInterface $request
     * @return int|null
     */
    protected function extractOffsetFromRequest(RequestInterface $request): ?int
    {
        if (!$request->hasPagination('offset')) {
            return null;
        }

        return (int)$request->paginationValue('offset');
    }

    /**
     * @param RequestInterface $request
     * @return int|null
     */
    protected function extractLimitFromRequest(RequestInterface $request): ?int
    {
        if (!$request->hasPagination('limit')) {
            return null;
        }

        return (int)$request->paginationValue('limit');
    }

    /**
     * @param object[] $entities
     * @param RequestInterface $request
     * @param AbstractView $view
     * @return ResponseInterface
     */
    protected function createDocumentResponse(
        array $entities,
        RequestInterface $request,
        AbstractView $view
    ): ResponseInterface {
        $document = new OffsetBasedPaginatedDocument([], $request->uri(), $view->getTotal(), 25);

        foreach ($entities as $entity) {
            $resource = $this->resource($request->type(), $entity->getId());
            $this->mapEntityToResource($entity, $resource, $request);
            $document->data()->set($resource);
        }

        return new DocumentResponse($document);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotAllowedException
     */
    public function createResource(RequestInterface $request): ResponseInterface
    {
        throw new NotAllowedException('You are not allowed to create resources.');
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotAllowedException
     */
    public function patchResource(RequestInterface $request): ResponseInterface
    {
        throw new NotAllowedException('You are not allowed to modify resources.');
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotAllowedException
     */
    public function deleteResource(RequestInterface $request): ResponseInterface
    {
        throw new NotAllowedException('You are not allowed to delete resources.');
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotAllowedException
     */
    public function addRelatedResources(RequestInterface $request): ResponseInterface
    {
        throw new NotAllowedException('You are not allowed to modify relationships.');
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotAllowedException
     */
    public function replaceRelatedResources(RequestInterface $request): ResponseInterface
    {
        throw new NotAllowedException('You are not allowed to modify relationships.');
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws NotAllowedException
     */
    public function removeRelatedResources(RequestInterface $request): ResponseInterface
    {
        throw new NotAllowedException('You are not allowed to modify relationships.');
    }
}
