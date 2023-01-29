<?php

namespace z4;

class UserController {
    
    /**
     * Получение пользовательских данных
     *
     * @return void
     */
    public function getUsersData() {

        // Можно создать класс валидации параметров и передавать его в сервис напрямую 
        
        // Валидация входящих параметров
        $user_ids = isset($_GET['user_ids']) && $_GET['user_ids'] ? $_GET['user_ids'] : false;
        
        if (!$user_ids) return $this->Render();

        $user_ids = explode(',', $user_ids);
        
        // Проверка на пустые значения
        if (empty($user_ids)) return $this->Render();

        // DI Container
        $PDOSource = new PDOSource();
        $userRepository = new UserRepository($PDOSource);
        $userService = new UserService($userRepository);

        $result = $userService->findUsersByIds($user_ids);

        $this->Render($result);
    }

    /**
     * Вывод данных из шаблона
     *
     * @param array $data
     * @return void
     */
    public function Render(array $data = []) {

        // В данном месте должно быть реализовано подключение файла шаблона и передача ему данных
        // Или использование шаблонизатора

        if (!empty($data)) foreach ($data as $user_id => $name) {
            echo '<a href="show_user.php?id='.$user_id.'"'.$name.'</a>';
        } else echo '<span>Данные не найдены</span>';
        
        exit();
    }

}
