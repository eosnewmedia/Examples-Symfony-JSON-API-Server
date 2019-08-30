<?php
declare(strict_types=1);

namespace App\Api\ResourceMapper;

use App\Model\Entity\PostalAddressInterface;
use App\Presenter\PersonPresenterInterface;
use Enm\JsonApi\JsonApiTrait;
use Enm\JsonApi\Mapper\ResourceMapperInterface;
use Enm\JsonApi\Model\Request\RequestInterface;
use Enm\JsonApi\Model\Resource\ResourceInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class PostalAddressMapper implements ResourceMapperInterface
{
    use JsonApiTrait;

    /**
     * @var ResourceMapperInterface
     */
    private $resourceMapper;

    /**
     * @var PersonPresenterInterface
     */
    private $personPresenter;

    /**
     * @param ResourceMapperInterface $resourceMapper
     * @param PersonPresenterInterface $personPresenter
     */
    public function __construct(ResourceMapperInterface $resourceMapper, PersonPresenterInterface $personPresenter)
    {
        $this->resourceMapper = $resourceMapper;
        $this->personPresenter = $personPresenter;
    }

    /**
     * @param object|PostalAddressInterface $object
     * @param ResourceInterface $resource
     * @param RequestInterface $request
     */
    public function mapObject(object $object, ResourceInterface $resource, RequestInterface $request): void
    {
        if (!$object instanceof PostalAddressInterface) {
            return;
        }

        if ($request->requestsAttributes()) {
            $resource->attributes()->set('street', $object->getStreet());
            $resource->attributes()->set('addressAdditional', $object->getAddressAdditional());
            $resource->attributes()->set('postalCode', $object->getPostalCode());
            $resource->attributes()->set('city', $object->getCity());
            $resource->attributes()->set('country', $object->getCountry());
        }

        if ($request->requestsRelationships()) {
            $personRequest = $request->createSubRequest('person', $resource);
            $relationship = $this->toOneRelationship('person');

            $related = $this->resource('persons', $object->getConnectedPersonId());
            if ($request->requestsInclude('person')) {
                $person = $this->personPresenter->showPersonByPostalAddressId($object->getId());
                $this->resourceMapper->mapObject($person, $related, $personRequest);
            }

            $relationship->related()->set($related);

            $resource->relationships()->set($relationship);
        }
    }
}
