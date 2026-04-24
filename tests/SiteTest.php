<?php

use PHPUnit\Framework\TestCase;
use Model\User;
use PHPUnit\Framework\Attributes\DataProvider;

class SiteTest extends TestCase
{
    //Настройка конфигурации окружения
    protected function setUp(): void
    {
        error_reporting(0);

        //Установка переменной среды
        $_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__ . '/../');

        //Создаем экземпляр приложения
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));

        //Глобальная функция для доступа к объекту приложения
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

    /**
     * @dataProvider additionProvider
     */
    #[DataProvider('additionProvider')]
    public function testSignup(string $httpMethod, array $userData, string $message): void
    {
        //Выбираем занятый логин из базы данных
        if ($userData['login'] === 'login is busy') {
            $userData['login'] = User::get()->first()->login;
        }

        // Создаем заглушку для класса Request.
        $request = $this->createStub(\Src\Request::class);
        // Переопределяем метод all() и свойство method
        $request->method('all')->willReturn($userData);
        $request->method = $httpMethod;

        //Сохраняем результат работы метода в переменную
        ob_start();
        try {
            $result = (new \Controller\Site())->signup($request);
            $output = ob_get_clean();
        } catch (\Throwable $e) {
            if (ob_get_level() > 0) ob_end_clean();
            throw $e;
        }

        $fullResponse = (string)$result . (string)$output;

        if (strpos($message, 'Location') !== false) {
            //Проверяем добавился ли пользователь в базу данных
            $this->assertTrue((bool)User::where('login', $userData['login'])->count());
            //Удаляем созданного пользователя из базы данных
            User::where('login', $userData['login'])->delete();

            //Проверяем редирект при успешной регистрации
            $this->assertStringContainsString($message, $fullResponse);
        } else {
            //Проверяем варианты с ошибками валидации
            $this->assertStringContainsString($message, $fullResponse);
        }
    }

    //Метод, возвращающий набор тестовых данных
    public static function additionProvider(): array
    {
        return [
            ['GET', ['name' => '', 'login' => '', 'password' => ''], 'Регистрация'],
            ['POST', ['name' => '', 'login' => '', 'password' => ''], 'Поле name пусто'],
            ['POST', ['name' => 'admin', 'login' => 'login is busy', 'password' => 'admin'], 'должно быть уникально'],
            ['POST', ['name' => 'tester', 'login' => 'u' . time(), 'password' => 'admin'], 'Location: /pop-it-mvc/login'],
        ];
    }
}