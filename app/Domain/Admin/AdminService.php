<?php

namespace App\Domain\Admin;

use Closure;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Illuminate\Http\UploadedFile;
use App\Domain\ACL\Role\Role;
use App\Domain\Core\Validation\ValidationTrait;
use App\Domain\Image\Image;
use App\Domain\Image\ImageRepository;
use Vinci\Infrastructure\Storage\StorageService;

class AdminService
{
    use ValidationTrait;

    private $repository;

    private $entityManager;

    private $validator;

    private $storage;

//    private $imageRepository;

    public function __construct(
        AdminRepository $repository,
        EntityManagerInterface $entityManager,
        AdminValidator $validator,
        StorageService $storage
    )
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->storage = $storage;
    }

    public function create(array $adminData)
    {
        $this->validator->with($adminData)->passesOrFail();

        return $this->saveAdmin($adminData, function($data) {
            return Admin::make($data);
        });
    }

    public function update(array $adminData, $id)
    {
        $this->validator->with($adminData)->setId($id)->passesOrFail();

        return $this->saveAdmin($adminData, function($data) use ($id) {

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $admin = $this->repository->find($id);
            $admin->fill($data);

            return $admin;
        });
    }

    public function savePhoto(UploadedFile $uploadedPhoto, Admin $user)
    {
        $this->entityManager->getConnection()->beginTransaction();

        try {

            $photo = Image::makeFromUpload($uploadedPhoto, $user->getPhotosUploadPath());

            $this->storage->storeImage($photo);

//            $photo = $this->imageRepository->save($photo);

            $this->entityManager->getConnection()->commit();

            return $photo;

        } catch (Exception $e) {

            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }
    }

    public function removePhoto(Image $photo, Admin $user)
    {
        $user->removePhoto($photo);

        $this->repository->save($user);
//        $this->imageRepository->save($photo);

        $this->storage->deleteImage($photo);
    }

    protected function saveAdmin($adminData, Closure $method)
    {
        $admin = $method($adminData);

        $admin->assignRole($this->entityManager->getReference(Role::class, $adminData['roles']));

        $this->repository->save($admin);

        if (! empty($photo = $adminData['photo'])) {
            $photo = $this->savePhoto($photo, $admin);
            $admin->addPhoto($photo);
            $admin->setProfilePhoto($photo);
            $this->repository->save($admin);
        }

        return $admin;
    }

}