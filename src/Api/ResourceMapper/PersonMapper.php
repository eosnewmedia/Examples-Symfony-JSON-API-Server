<?php
declare(strict_types=1);

namespace App\Api\ResourceMapper;

use App\Model\Entity\PersonInterface;
use App\Presenter\PostalAddressPresenterInterface;
use Enm\JsonApi\JsonApiTrait;
use Enm\JsonApi\Mapper\ResourceMapperInterface;
use Enm\JsonApi\Model\Request\RequestInterface;
use Enm\JsonApi\Model\Resource\ResourceInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class PersonMapper implements ResourceMapperInterface
{
    use JsonApiTrait;

    /**
     * @var ResourceMapperInterface
     */
    private $resourceMapper;

    /**
     * @var PostalAddressPresenterInterface
     */
    private $postalAddressPresenter;

    /**
     * @param ResourceMapperInterface $resourceMapper
     * @param PostalAddressPresenterInterface $postalAddressPresenter
     */
    public function __construct(
        ResourceMapperInterface $resourceMapper,
        PostalAddressPresenterInterface $postalAddressPresenter
    ) {
        $this->resourceMapper = $resourceMapper;
        $this->postalAddressPresenter = $postalAddressPresenter;
    }

    /**
     * @param object|PersonInterface $object
     * @param ResourceInterface $resource
     * @param RequestInterface $request
     */
    public function mapObject(object $object, ResourceInterface $resource, RequestInterface $request): void
    {
        if (!$object instanceof PersonInterface) {
            return;
        }

        if ($request->requestsAttributes()) {
            $resource->attributes()->set('firstName', $object->getFirstName());
            $resource->attributes()->set('lastName', $object->getLastName());
            $resource->attributes()->set('birthday', $object->getBirthday()->format('Y-m-d'));
        }

        if ($request->requestsRelationships()) {
            $postalAddressRequest = $request->createSubRequest('postalAddresses', $resource);

            $relatedResources = [];
            foreach ($object->getConnectedPostalAddressIds() as $postalAddressId) {
                $related = $this->resource('postalAddresses', $postalAddressId);

                if ($request->requestsInclude('postalAddresses')) {
                    $postalAddress = $this->postalAddressPresenter->showPostalAddressById($postalAddressId);
                    if (!$postalAddress) {
                        continue;
                    }
                    $this->resourceMapper->mapObject($postalAddress, $related, $postalAddressRequest);
                }

                $relatedResources[] = $related;
            }

            $resource->relationships()->set(
                $this->toManyRelationship('postalAddresses', $relatedResources)
            );
        }
    }
}
