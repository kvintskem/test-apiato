<?php

declare(strict_types=1);

namespace App\Containers\Enterprise\Data\Faker;

use App\Containers\Enterprise\Data\Generator\EnterpriseTreeGenerator;
use Faker\Provider\Base;


final class EnterpriseProvider extends Base
{
  private const ORGANIZATION_LEVELS = [1,2];

  public function getRandomOrganization(): array
  {
    $enterpriseTree = EnterpriseTreeGenerator::getEnterpriseTree();
    shuffle($enterpriseTree);

    foreach ($enterpriseTree as $enterprise) {
      if (in_array($enterprise['level'], self::ORGANIZATION_LEVELS, true)) {
        return $enterprise;
      }
    }

    throw new \RuntimeException('Enterprise not found');
  }

  public function getRandomDepartment(int $parentOrganizationId = null): array
  {
    $enterpriseTree = EnterpriseTreeGenerator::getEnterpriseTree();
    shuffle($enterpriseTree);

    if ($parentOrganizationId !== null) {
      foreach ($enterpriseTree as $enterprise) {
        if (!in_array($enterprise['level'], self::ORGANIZATION_LEVELS, true) && in_array($parentOrganizationId, $enterprise['parents'], true)) {
          return $enterprise;
        }
      }
    }

    foreach ($enterpriseTree as $enterprise) {
      if (!in_array($enterprise['level'], self::ORGANIZATION_LEVELS, true)) {
        return $enterprise;
      }
    }

    throw new \RuntimeException('Department not found');
  }
}
