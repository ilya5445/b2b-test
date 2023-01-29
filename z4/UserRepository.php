<?php

namespace z4;

/**
 * Репозиторий для получения данных пользователей
 */
class UserRepository extends Repository {

    /**
     * Поиск пользователей по IDs
     *
     * @param array $ids Массив пользовательских IDs
     * @return array
     */
    public function findUsersByIds(array $ids): array {

        $preparedInValues = array_combine(
            array_map(function($key) {
               return ':var_'.$key;
            }, array_keys($ids)),
            array_values($ids)
          );

        $sql = 'SELECT `id`, `name`, `gender`, `birth_date` FROM `users` WHERE `id` IN ('.implode(',', array_keys($preparedInValues)).')';
        $smtp = $this->source->prepare($sql);

        $smtp->execute($preparedInValues);

        while ($user = $smtp->fetchObject()) 
            $result[] = [
                'id' => intval($user->id),
                'name' => $user->name,
                'gender' => intval($user->gender),
                'birth_date' => intval($user->birth_date),
            ];

        return $result;
    }
    
}
