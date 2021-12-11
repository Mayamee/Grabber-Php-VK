# Grabber-Php-VK

Наполняйте постами свои группы в вк

## Установка:

### Получаем ID нашей группы и целевых групп

Группы обязательно прописывать с дефисом "-"
[Сайт](https://regvk.com/id/), чтобы получить ID групп

### Клонируем репозиторий к себе

```sh
git clone https://github.com/Mayamee/Grabber-Php-VK
```

### Получаем токен доступа VK:

- Создаем [standalone](https://vk.com/dev/standalone) приложение вк [ссылка](https://vk.com/editapp?act=create)

- Переходим настройки, состояние - выбираем приложение включено
  типа тут группы

- Получение токена через [ImplicitFlow](https://vk.com/dev/implicit_flow_user)

Делаем http запрос:

```sh
https://oauth.vk.com/authorize?client_id=CLIENT_ID&display=page&scope=CLIENT_ACCESS&response_type=token&v=5.92&state=123456
```

CLIENT_ID - id вашего standalone приложения. [Получить](https://vk.com/apps?act=manage)

CLIENT_ACCESS - доступы которые надо расшарить приложению по умолчанию (photos,groups,wall). [Подробнее](https://vk.com/dev/permissions)

v - версия api (ставим самую свежую)

- Шаблон запроса который применяется в данном скрипте: https://oauth.vk.com/authorize?client_id=<CLIENT_ID>&display=page&scope=photos,groups,wall&response_type=token&v=5.92&state=123456

- Получаем ответ типа:
  <https://oauth.vk.com/blank.html#access_token=TOKEN&expires_in=86400&user_id=USER_ID&state=12345>

Забираем TOKEN из поля (как указано выше) и вставляем в $CONF_TOKEN.

✨Пользуемся✨

## Интеграция с CRON

Так как у VK ограничение на **50** постов в день, то посты нужно делать примерно раз в полчаса

Даем доступ на выполнение в bash

```sh
chmod 771 index.bash
```

Заводим линуксовский будильник **CRON**

```sh
sudo crontab -e
```

И записываем в конец

```sh
*/20 * * * * /Path_To_Your_File/index.bash
```

Узнать путь можно при помощи:

```sh
pwd
```

_После настройки проверяйте вашу группу VK в ней должны пойти посты_
