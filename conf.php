<?php 
	# Токен доступа вк
	# Создаем standalone приложение вк https://vk.com/dev/standalone или https://vk.com/editapp?act=create
	# Переходим настройки, состояние - выбираем приложение включено
	# типа тут группы
	# Получение токена через ImplicitFlow https://vk.com/dev/implicit_flow_user
	# Делаем http запрос: https://oauth.vk.com/authorize?client_id=<CLIENT_ID>&display=page&scope=<CLIENT_ACCESS>&response_type=token&v=5.92&state=123456
	# CLIENT_ID -> id вашего standalone приложения. Получить: https://vk.com/apps?act=manage
	# CLIENT_ACCESS -> доступы которые надо расшарить приложению по умолчанию (photos,groups,wall). Подробнее: https://vk.com/dev/permissions
	# v -> версия api (ставим самую свежую)
	# Шаблон запроса который применяется в данном скрипте: https://oauth.vk.com/authorize?client_id=<CLIENT_ID>&display=page&scope=photos,groups,wall&response_type=token&v=5.92&state=123456
	# Получаем ответ типа: https://oauth.vk.com/blank.html#access_token=<TOKEN>&expires_in=86400&user_id=USER_ID&state=123456
	# Забираем TOKEN из <TOKEN> поля (как указано выше) и вставляем в $CONF_TOKEN.
	error_reporting(E_ERROR);
	$CONF_TOKEN = "YOUR_TOKEN";
	# Группы откуда будем брать записи
	$CONF_GROUPS = array ('-20629724', '-8820055', '-71741545');
?>