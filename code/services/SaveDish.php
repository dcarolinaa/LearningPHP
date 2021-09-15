<?php

namespace App\services;

use App\models\Dish;
use App\repositories\DishesRepository;

class SaveDish
{
    private $saveEntity;
    private $dishesRepository;
    private $uploadDir;
    private $pathCompanyLogo;
    private $moveFile;
    private $homeDir;

    public function __construct(
        SaveEntity $saveEntity,
        DishesRepository $dishesRepository,
        MoveFile $moveFile,
        string $uploadDir,
        string $pathCompanyLogo,
        string $homeDir
    ) {
        $this->saveEntity = $saveEntity;
        $this->dishesRepository = $dishesRepository;
        $this->moveFile = $moveFile;
        $this->uploadDir = $uploadDir;
        $this->pathCompanyLogo = $pathCompanyLogo;
        $this->homeDir = $homeDir;
    }

    public function __invoke($data)
    {
        $image = isset($data['image']) ? $data['image'] : false;
        $this->clearData($data);
        $dish = $this->getDish($data);

        $dish->fill([
            'id_company' => $data['id_company'],
            'name' => $data['name'],
            'description' => $data['description'],
            'create_date' => $data['create_date'],
            'update_date' => $data['update_date']
        ]);

        $this->saveEntity->__invoke($dish);

        if ($image) {
            $this->saveImage($image, $dish->getId_company(), $dish->getId());
        }

        return $dish;
    }

    private function clearData(&$data)
    {
        unset($data['image']);
        unset($data['create_date']);
        unset($data['update_date']);
    }

    private function getDish(&$data)
    {
        $now = date('Y-m-d H:i:s');
        $data['update_date'] = $now;

        if (isset($data['id'])) {
            $dish = $this->dishesRepository->getById($data['id']);
            $data['create_date']  = $dish->getCreate_date();
            unset($data['id']);
        } else {
            $dish = new Dish();
            $data['create_date'] = $now;
        }

        return $dish;
    }

    private function saveImage($image, $idCompany, $idDish)
    {
        $path = sprintf(
            '%s/%s',
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $idCompany)
        );
        $this->moveFile->__invoke($image, $path, sprintf('dish%s_image.jpg', $idDish));

        $this->cleanCache($path, $idDish);
    }

    private function cleanCache($path, $idDish)
    {
        $cache = sprintf(
            '%s/cache/%s/dish%s_image',
            $this->homeDir,
            $path,
            $idDish
        );

        if (!file_exists($cache)) {
            return;
        }

        foreach (scandir($cache) as $file) {
            $fullFileName = sprintf('%s/%s', $cache, $file);
            if (is_file($fullFileName)) {
                unlink($fullFileName);
            }
        }
    }


}
