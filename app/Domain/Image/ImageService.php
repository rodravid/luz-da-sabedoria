<?php

namespace App\Domain\Image;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\UploadedFile;
use App\Domain\File\Builders\PathBuilderInterface;
use App\Domain\File\Mapping\FileMapping;
use App\Infrastructure\Storage\StorageService;

class ImageService
{
    private $entityManager;

    private $repository;

    private $storage;

    private $factory;

    private $container;

    public function __construct(
        EntityManagerInterface $entityManager,
        ImageRepository $repository,
        StorageService $storage,
        ImageFactory $factory,
        Container $container
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->storage = $storage;
        $this->factory = $factory;
        $this->container = $container;
    }

    public function storeFor($entity, UploadedFile $image)
    {
        $this->entityManager->getConnection()->beginTransaction();

        try {

            $image = Image::makeFromUpload($image, $entity->getImagesUploadPath());

            $this->storage->storeImage($image);

            $this->repository->save($image);

            $this->entityManager->getConnection()->commit();

            return $image;

        } catch (Exception $e) {

            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }

    public function removeFrom($entity, Image $image)
    {
        $entity->removeImage($image);
        $this->storage->deleteImage($image);
        $this->entityManager->persist($entity);
        $this->entityManager->remove($image);
        $this->entityManager->flush();
    }

    public function storeAndAttach($image, $entity, $version)
    {
        if (! empty($image)) {

            $this->assertIsUploadedFile($image);

            $image = $this->storeFor($entity, $image);

            $entity->addImage($image, $version);

            return $image;
        }
    }

    protected function assertIsUploadedFile($image)
    {
        if (! $image instanceof UploadedFile) {
            throw new \Exception(sprintf("The given image must be instance of %s.", UploadedFile::class));
        }
    }

    public function store(UploadedFile $uploadedFile, FileMapping $mapping)
    {
        $builder = $this->makePathBuilder($mapping->getPathBuilder());
        $image = $this->factory->make($mapping, $builder, $uploadedFile);

        $this->repository->save($image);

        $image->setUploadedFile($uploadedFile);

        $this->storage->storeImage($image);

        return $image;
    }

    private function makePathBuilder($builderClass)
    {
        if ($builderClass instanceof PathBuilderInterface) {
            return $builderClass;
        }

        return $this->container->make($builderClass);
    }

}