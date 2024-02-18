<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Entity\Ad;
use App\Domain\Enum\AdKeywords;
use App\Domain\Enum\PictureQuality;
use App\Domain\Interface\PicturePersistenceInterface;

final class Score
{
    public function __construct(private int $value)
    {
        $this->value = max(0, min(100, $value));
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public static function calculateScore(Ad $ad, PicturePersistenceInterface $picturePersistenceInterface): self
    {
        $score = 0;

        if (count($ad->getPictures()) === 0) {
            $score -= 10;
        }

        if (!empty($ad->getPictures())) {
            foreach ($ad->getPictures() as $picture) {
                $pictureExisting = $picturePersistenceInterface->findById($picture);
                if ($pictureExisting && $pictureExisting->getQuality() === PictureQuality::HD->value) {
                    $score += 20;
                } elseif ($pictureExisting) {
                    $score += 10;
                }
            }
        }

        if (!empty($ad->getDescription())) {
            $score += 5;

            $wordCount = str_word_count($ad->getDescription());
            if ($ad->getTypology() === AdKeywords::Flat->value && $wordCount >= 20 && $wordCount < 50) {
                $score += 10;
            } elseif ($ad->getTypology() === AdKeywords::Flat->value && $wordCount >= 50) {
                $score += 30;
            } elseif ($ad->getTypology() === AdKeywords::Cottage->value && $wordCount > 50) {
                $score += 20;
            }

            foreach (AdKeywords::toArray() as $keyword) {
                if (stripos($ad->getDescription(), $keyword->value) !== false) {
                    $score += 5;
                }
            }
        }

        if (self::isComplete($ad)) {
            $score += 40;
        }

        return new self(value: $score);
    }

    private static function isComplete(Ad $ad): bool
    {
        if ($ad->getTypology() !== AdKeywords::Garage->value && empty($ad->getDescription())) {
            return false;
        }

        if (count($ad->getPictures()) === 0) {
            return false;
        }

        switch ($ad->getTypology()) {
            case AdKeywords::Flat->value:
                return null !== $ad->getHouseSize() && $ad->getHouseSize() > 0;
            case AdKeywords::Cottage->value:
                return null !== $ad->getHouseSize() && $ad->getHouseSize() > 0
                    && null !== $ad->getGardenSize() && $ad->getGardenSize() > 0;
            case AdKeywords::Garage->value:
                return true;
            default:
                return false;
        }
    }
}
