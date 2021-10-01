<?php

namespace App\services;

use App\repositories\DishesRepository;

class DeleteDish
{
    private $dishesRepository;
    private $deleteDirectory;
    private $pathCompanyLogo;
    private $deleteEntity;
    private $uploadDir;
    private $homeDir;

    public function __construct(
        DishesRepository $dishesRepository,
        DeleteDirectory $deleteDirectory,
        DeleteEntity $deleteEntity,
        string $pathCompanyLogo,
        string $uploadDir,
        string $homeDir
    ) {
        $this->deleteEntity = $deleteEntity;
        $this->deleteDirectory = $deleteDirectory;
        $this->dishesRepository = $dishesRepository;
        $this->uploadDir = $uploadDir;
        $this->pathCompanyLogo = $pathCompanyLogo;
        $this->homeDir = $homeDir;
    }

    public function __invoke($id)
    {
        $dish = $this->dishesRepository->getDishById($id);

        $dishesImagesPath = sprintf(
            '%s/%s/%s/dishes/%s/',
            $this->homeDir,
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $dish->getId_company()),
            $dish->getId()
        );

        $cachePath = sprintf(
            '%s/cache/%s/%s/dishes/%s',
            $this->homeDir,
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $dish->getId_company()),
            $dish->getId()
        );

        $this->deleteDirectory->__invoke($dishesImagesPath);
        $this->deleteDirectory->__invoke($cachePath);

        $this->deleteEntity->__invoke($dish);
    }

}
