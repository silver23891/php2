<?php
/**
 * Работа с пользователями
 */
class M_User
{
    private $filename = 'data/users.txt';
    
    /**
     * Получить пользователей
     * 
     * @return array Массив пользователей
     */
    public function getUsers()
    {
        if (file_exists($this->filename)) {
            $userStrings = file($this->filename);
            if (!$userStrings) {
                return [];
            }
        }
        $users = [];
        foreach ($userStrings as $string) {
            $users[substr($string, 0, strpos($string, '/'))] = trim(
                substr($string, strpos($string, '/')+1)
            );
        }
        return $users;
    }
    
    /**
     * Проверить есть ли пользователь с таким логином и паролем
     * 
     * @param string $login        Логин
     * @param string $password Пароль
     * 
     * @return boolean
     */
    public function checkUser($login, $password)
    {
        $users = $this->getUsers();
        if (isset($users[$login]) && $users[$login] == $password) {
            return true;
        }
        return false;
    }
}