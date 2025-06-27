<?php
// templates/task_description.php
return "Описание:\nДокумент: {$URL}\nТип: {$Type}\nДата регистрации: {$RegDate}\nНомер: {$RegNumPrefix}{$RegNumber}{$RegNumSuffix}\nКонтрагент: {$Correspondent['Organization']['FullName']}";