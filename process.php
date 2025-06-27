<?php
// process.php

session_start();

$config = include 'config.php';

function loadTemplate($path, $variables) {
    extract($variables);
    ob_start();
    include $path;
    return ob_get_clean();
}

// Эмуляция API
class BitrixAPI {
    public function createTask($fields) {
        // Здесь должна быть реализация вызова API
        // Для теста — возвращаем фиктивный ID
        return ['result' => ['task' => ['id' => rand(1000,9999)]]];
    }

    public function attachFile($taskId, $fileContent) {
        // Загрузка файла и получение ID
        return rand(100, 999);
    }
}

class CompanyMedia {
    public function getContent($url) {
        // Эмуляция загрузки файла
        return file_get_contents($url);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'import') {
    $docUrl = trim($_POST['doc_url']);

    $bitrix = new BitrixAPI();
    $companyMedia = new CompanyMedia();

    // Получение файла
    $fileContent = $companyMedia->getContent($docUrl);
    if (!$fileContent) {
        die('Ошибка загрузки файла');
    }

    // Эмуляция метаданных документа
    $metadata = [
        'Title' => 'Пример заголовка',
        'Type' => 'Тип документа',
        'RegDate' => date('Y-m-d'),
        'RegNumPrefix' => '№',
        'RegNumber' => rand(10000,99999),
        'RegNumSuffix' => '',
        'URL' => $docUrl,
        'Correspondent' => [
            'Organization' => [
                'FullName' => 'ООО "Контрагент"',
            ],
        ],
    ];

    // Формирование шаблонов
    $variables = $metadata;

    $titleTemplatePath = 'templates/task_title.php';
    $descriptionTemplatePath = 'templates/task_description.php';

    $taskTitle = loadTemplate($titleTemplatePath, $variables);
    $taskDescription = loadTemplate($descriptionTemplatePath, $variables);

    // Создаем задачу
    $taskFields = [
        'TITLE' => $taskTitle,
        'DESCRIPTION' => $taskDescription,
        'RESPONSIBLE_ID' => '1', // Исполнитель
    ];

    $result = $bitrix->createTask($taskFields);
    $taskId = $result['result']['task']['id'];

    // Загрузка файла и прикрепление — имитируем
    $fileId = $bitrix->attachFile($taskId, $fileContent);

    echo "<h2>Задача успешно создана!</h2>";
    echo "<p>ID задачи: {$taskId}</p>";
    echo "<a href='index.php'>Вернуться</a>";
    exit;
}
?>