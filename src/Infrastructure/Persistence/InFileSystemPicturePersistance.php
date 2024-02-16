<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Picture;
use App\Domain\Interface\PicturePersistenceInterface;

class InFileSystemPicturePersistence implements PicturePersistenceInterface
{
    private array $pictures = [];

    public function __construct()
    {
        array_push($this->pictures, new Picture(1, 'https://www.idealista.com/pictures/1', 'SD'));
        array_push($this->pictures, new Picture(2, 'https://www.idealista.com/pictures/2', 'HD'));
        array_push($this->pictures, new Picture(3, 'https://www.idealista.com/pictures/3', 'SD'));
        array_push($this->pictures, new Picture(4, 'https://www.idealista.com/pictures/4', 'HD'));
        array_push($this->pictures, new Picture(5, 'https://www.idealista.com/pictures/5', 'SD'));
        array_push($this->pictures, new Picture(6, 'https://www.idealista.com/pictures/6', 'SD'));
        array_push($this->pictures, new Picture(7, 'https://www.idealista.com/pictures/7', 'SD'));
        array_push($this->pictures, new Picture(8, 'https://www.idealista.com/pictures/8', 'HD'));
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function findById(int $id): ?Picture
    {
        foreach ($this->pictures as $picture) {
            if ($picture->getId() === $id) {
                return $picture;
            }
        }
        
        return null;
    }
}
