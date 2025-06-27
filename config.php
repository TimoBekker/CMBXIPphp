<?php
return [
    'bitrix' => [
        'api_url' => 'https://your-bitrix-api-url', // Замените на реальный API URL
        'token' => 'your-bitrix-token',             // Ваш токен API
        'root_autofind_id' => 'ID_OR_NAME',
        'autofind_enabled' => true,
        'autofind_is_auditor' => false,
    ],
    'company_media' => [
        'webhook_url' => 'https://sed.ad.samregion.ru/ssrv-war/api', // Webhook или API
        'save_auth' => true,
        'username' => 'Дмитрий Сергеевич Никифоров/DITC/ASR',
        'password' => '56DczGbh!',
    ],
    'templates' => [
        'task_title_format' => 'Задача: {$Title} от {$RegDate}',
        'task_description_format' => 'Описание:\nДокумент: {$URL}\nТип: {$Type}\nДата регистрации: {$RegDate}\nНомер: {$RegNumPrefix}{$RegNumber}{$RegNumSuffix}\nКонтрагент: {$Correspondent.Organization.FullName}',
    ],
];