<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Factory as ValidationFactory;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Railroad\DoctrineArrayHydrator\JsonApiHydrator;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Exceptions\DeleteFailedException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentJsonController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var ContentService
     */
   // private $contentService;

    /**
     * @var ValidationFactory
     */
    private $validationFactory;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var JsonApiHydrator
     */
    private $jsonApiHydrator;

    private $contentRepository;

    /**
     * ContentController constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(
        EntityManager $entityManager,
        JsonApiHydrator $jsonApiHydrator,

        //ContentService $contentService,
        ValidationFactory $validationFactory,
        PermissionService $permissionPackageService

    ) {


        $this->entityManager = $entityManager;
        $this->jsonApiHydrator = $jsonApiHydrator;
//        $this->contentService = $contentService;
        $this->validationFactory = $validationFactory;
        $this->permissionPackageService = $permissionPackageService;

        $this->contentRepository = $this->entityManager->getRepository(Content::class);


        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        if ($request->has('statuses')) {
            ContentRepository::$availableContentStatues = $request->get('statuses');
        }

        $contentData = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on'),
            $request->get('included_types', []),
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        );

        return response($this->serializer->serialize($contentData, 'json'), 200);

//        return reply()->json(
//            $contentData['results'],
//            [
//                'transformer' => DataTransformer::class,
//                'totalResults' => $contentData['total_results'],
//                'filterOptions' => $contentData['filter_options'],
//            ]
//        );
    }

    /** Pull the children contents for the parent id
     *
     * @param integer $parentId
     * @return JsonResponse
     */
    public function getByParentId($parentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByParentId($parentId);

        return reply()->json(
            $contentData,
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByIds(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByIds(explode(',', $request->get('ids', '')));

        return response($this->serializer->serialize($contentData, 'json'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $content = $this->contentRepository->find($id);

        throw_unless($content, new NotFoundException('No content with id ' . $id . ' exists.'));

        return ResponseService::content($content);
    }

    public function slugs(Request $request, ...$slugs)
    {

    }

    /**
     * Create a new content and return it in JSON format
     *
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     */
    public function store(ContentCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content');

        $content = new Content();

        $this->jsonApiHydrator->hydrate($content, $request->onlyAllowed());

        if (!$content->getBrand()) {
            $content->setBrand(config('railcontent.brand'));
        }

        if (!$content->getLanguage()) {
            $content->setLanguage(config('railcontent.default_language'));
        }

        $this->entityManager->persist($content);
        $this->entityManager->flush();


        return ResponseService::content($content)->respond(201);
    
    }

    /** Update a content based on content id and return it in JSON format
     *
     * @param integer $contentId
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(ContentUpdateRequest $request, $contentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.content');

        $content = $this->contentRepository->find($contentId);

        //if the content not exist; we throw the proper exception
        throw_if(
            is_null($content),
            new NotFoundException('Update failed, content not found with id: ' . $contentId)
        );

        $this->jsonApiHydrator->hydrate($content, $request->onlyAllowed());

        $this->entityManager->persist($content);
        $this->entityManager->flush();

        return ResponseService::content($content)
            ->respond(200);
    }

    /**
     * Call the delete method if the content exist
     *
     * @param integer $contentId
     * @return JsonResponse
     * @throws \Throwable
     */
    public function delete($contentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content');

        $content = $this->contentRepository->find($contentId);

        if (!is_null($content)) {
            $this->entityManager->remove($content);
            $this->entityManager->flush();
            return ResponseService::empty(204);
        }
        return ResponseService::empty(404);

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function options(Request $request)
    {
        return reply()->json(
            null,
            [
                'code' => 200,
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'POST, PATCH, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With, content-type',
            ]
        );
    }

    /**
     * Call the soft delete method if the content exist
     *
     * @param integer $contentId
     * @param Request $request
     * @return JsonResponse
     */
    public function softDelete($contentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content');

        //delete content
        $delete = $this->contentService->softDelete($contentId);

        //if the delete method response it's null the content not exist; we throw the proper exception
        throw_if(
            is_null($delete),
            new NotFoundException('Delete failed, content not found with id: ' . $contentId)
        );

        //if the delete method response it's false the mysql delete method was failed; we throw the proper exception
        throw_if(
            !($delete),
            DeleteFailedException::class
        );

        return reply()->json(null, ['code' => 204]);
    }
}