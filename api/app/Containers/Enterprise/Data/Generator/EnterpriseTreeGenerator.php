<?php

declare(strict_types=1);

namespace App\Containers\Enterprise\Data\Generator;


final class EnterpriseTreeGenerator
{
  private const ROOT_ID = 3000000;

  private static $enterpriseTree = [];

  public static function getEnterpriseTree():array
  {
    if (count(self::$enterpriseTree) > 0) {
      return self::$enterpriseTree;
    }

    return self::buildTree();
  }

  private static function buildTree(): array
  {
    $orgStructureCollection = self::getOrganizationStructure();
    foreach ($orgStructureCollection as $key => $currentOrganization) {
      self::$enterpriseTree[$currentOrganization[1]] = [
        'id' => $currentOrganization[1],
        'level' => $currentOrganization[0],
        'name' => $currentOrganization[2],
        'isDepartment' => isset($currentOrganization[3]),
        'parent' => self::ROOT_ID,
        'parents' => [$currentOrganization[1]],
      ];

      if ($key > 0) {
        $previousKey = $key - 1;
        $currentLevel = $currentOrganization[0];
        $previousLevel = $orgStructureCollection[$previousKey][0];
        $levelDelta = $previousLevel - $currentLevel;

        if (isset($orgStructureCollection[$previousKey])) {
          if($currentLevel === $previousLevel) {
            //если уровни ровны, то родители текущего и предыдущего элемента одинаковые
            self::$enterpriseTree[$currentOrganization[1]]['parent'] = self::$enterpriseTree[$orgStructureCollection[$previousKey][1]]['parent'];
            $parents = self::$enterpriseTree[$orgStructureCollection[$previousKey][1]]['parents'];
            //Для текущего элемента все родители одинаковые, кроме последнего элемента в массиве parents
            array_pop($parents);
            self::$enterpriseTree[$currentOrganization[1]]['parents'] = $parents;
          } elseif ($currentLevel > $previousLevel) {
            self::$enterpriseTree[$currentOrganization[1]]['parent'] = $orgStructureCollection[$previousKey][1];
            self::$enterpriseTree[$currentOrganization[1]]['parents'] = self::$enterpriseTree[$orgStructureCollection[$previousKey][1]]['parents'];
          } elseif ($currentLevel < $previousLevel) {
            $previousParents = self::$enterpriseTree[$orgStructureCollection[$previousKey][1]]['parents'];
            $parentsLimit = count($previousParents) - 1 - $levelDelta;
            //вырезамем общую часть массива родителей у предыдущего элемента, чтобы создать массив родителей для текущего
            $currentParents = array_slice($previousParents, 0, $parentsLimit);
            self::$enterpriseTree[$currentOrganization[1]]['parent'] = end($currentParents);
            self::$enterpriseTree[$currentOrganization[1]]['parents'] = $currentParents;
          }
          self::$enterpriseTree[$currentOrganization[1]]['parents'][] = $currentOrganization[1];
        }
      }
    }

    return self::$enterpriseTree;

  }

  private static function getOrganizationStructure(): array
  {
    $orgStructure[] = [1, 8800000, 'Главный офис'];
    $orgStructure[] = [1, 3000002, 'Предприятие 2'];
    $orgStructure[] = [1, 3000003, 'Предприятие 3'];
    $orgStructure[] = [1, 3000004, 'Предприятие 4'];
    $orgStructure[] = [2, 13518363, 'Подразделение 1.1'];
    $orgStructure[] = [2, 13518364, 'Подразделение 1.2'];
    $orgStructure[] = [2, 13518365, 'Подразделение 2.1'];
    $orgStructure[] = [2, 13518366, 'Подразделение 2.2'];
    $orgStructure[] = [2, 13518367, 'Подразделение 3.1'];
    $orgStructure[] = [2, 13518368, 'Подразделение 3.2'];
    $orgStructure[] = [1, 13520615, 'Департамент 1.1', 'department'];
    $orgStructure[] = [2, 13520625, 'Департамент 2.1', 'department'];
    $orgStructure[] = [2, 13520635, 'Департамент 2.2', 'department'];
    $orgStructure[] = [4, 13520658, 'Департамент 2', 'department'];
    $orgStructure[] = [3, 13001666, 'Департамент 3.1', 'department'];
    $orgStructure[] = [3, 13086619, 'Департамент 3.2', 'department'];
    $orgStructure[] = [3, 13001654, 'Департамент 3.4', 'department'];
    $orgStructure[] = [4, 13435693, 'Департамент 4.1', 'department'];
    $orgStructure[] = [5, 13451207, 'Департамент 5.1', 'department'];
    $orgStructure[] = [5, 13451208, 'Департамент 5.2', 'department'];
    $orgStructure[] = [4, 13451209, 'Департамент 4.2', 'department'];
    $orgStructure[] = [6, 13451211, 'Департамент 6.1', 'department'];
    $orgStructure[] = [6, 13451212, 'Департамент 6.2', 'department'];
    $orgStructure[] = [6, 13451213, 'Департамент 6.3', 'department'];
    $orgStructure[] = [1, 13451207, 'Департамент 1.2', 'department'];
    $orgStructure[] = [1, 13451208, 'Департамент 1.3', 'department'];
    $orgStructure[] = [3, 13356268, 'Подразделение 1.1.1'];
    $orgStructure[] = [3, 13356269, 'Подразделение 2.1.1'];
    $orgStructure[] = [4, 13356266, 'Подразделение 1.1.1.1'];
    $orgStructure[] = [4, 13356267, 'Подразделение 2.1.1.1'];
    $orgStructure[] = [5, 13441923, 'Подразделение 1.1.1.1.1'];
    $orgStructure[] = [5, 13488474, 'Подразделение 2.1.1.1.1'];
    $orgStructure[] = [5, 13450977, 'Подразделение 2.1.1.2.1'];
    $orgStructure[] = [6, 13450993, 'Подразделение 1.1.1.1.1.1'];
    $orgStructure[] = [6, 13481117, 'Подразделение 1.1.1.1.2.1'];
    $orgStructure[] = [6, 13450998, 'Подразделение 2.1.1.1.1.1'];
    return $orgStructure;
  }
}
