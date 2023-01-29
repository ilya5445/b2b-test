<?php

namespace z4;

/**
 * Сервис для работы с пользователями
 */
class UserService {

    private $userRepository;

    function __construct(
        ?UserRepository $userRepository = null
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Получение данных пользователей
     *
     * @param array $user_ids
     * @return array
     */
    public function findUsersByIds(array $user_ids): array {

        $result = $this->userRepository->findUsersByIds($user_ids);

        return $result;
    }

}
