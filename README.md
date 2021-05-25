## Проблема
В данный момент отсутствует возможность определить, в каких организациях превышена квота по сотрудникам. 

## Решение
Необходимо хранить информацию по квоте предприятий. Ответственный сотрудник может получать письмо с организациями, квота которых достигла 80% и выше по нажатию кнопки с фронта. Для этого необходимо написать новый endpoint. Он должен собирать данные по всем предприятиям, квота которых превышает 80% и отправлять данные на указанный в конфиге email. 

### Пример 
Предприятие "ООО Самая лучшая компания" имеет квоту в 5 человек, в таблице users_asup 4 человека привязаны к этой организации. Должно быть отправлено письмо 
"Превышена квота на сотрудников для следующих предприятий:
ООО Самая лучшая компания"

## Миграции примера
INSERT INTO enterprises (objid, objidref, objsname, objstatus, is_root, parents) VALUES (8800000, 8800000, 'Головной офис', null, true, '');

INSERT INTO enterprises (objid, objidref, objsname, objstatus, is_root, parents) VALUES (11111111, 8800000, 'ООО Самая лучшая компания', null, false, null);

INSERT INTO users (id, integration_id, type, created_at, updated_at, deleted_at) VALUES (1, '1', 'user', NOW(), NOW(), null), (2, '2', 'user', NOW(), NOW(), null), (3, '3', 'user', NOW(), NOW(), null), (4, '4', 'user', NOW(), NOW(), null);

INSERT INTO users_asup (number, fullname, email, integration_id, orgid, created_at, updated_at, deleted_at) VALUES (1, 'Тестов Тест Тестович', 'user1@nor.com', '1', 11111111, NOW(), NOW(), null), (2, 'Абрикосов Абрикос Абрикосович', 'user2@nor.com', '2', 11111111, NOW(), NOW(), null), (3, 'Огурцов Огурец Огурцович', 'user3@nor.com', '3', 11111111, NOW(), NOW(), null), (4, 'Молодцов Молодец Молодцович', 'user4@nor.com', '4', 11111111, NOW(), NOW(), null);

## Definition Of Done
1. Написана миграция
2. Написан endpoint в стиле фреймворка [Apiato](https://apiato.io/) (Route, Controller, Action, Task, Transformer)
3. Написан тест и он зелёный, который проверяет работу endpoint заготовка в App\Containers\Enterprise\Tests\V1\SendEmailEnterprisesListTest

## Тестовый сценарий
1. Сгенерить предприятие и пользователей через фабрику
2. Сгенерить квоту на предприятие
3. Вызвать endpoint (метод makeCall)
4. Проверить, что письмо с предприятием отправлено

## Запуск проекта
1. Перейти в директорию docker
2. Запустить команду docker volume create --name=pgdata или make pg-volume-create
3. Запустить docker-compose up -d или make go
4. Должны подняться все контейнеры
5. Войти в контейнер docker-compose exec php-dev sh 
6. composer install

## Tech notes
1. В таблице enterprises хранятся записи всех предприятий
2. В таблице users_asup хранятся записи пользователей связь с таблицей enterprises осуществляется по полю orgid