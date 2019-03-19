---
title: API Reference

language_tabs: # must be one of https://git.io/vQNgJ
  - php
  - json
  - angular


toc_footers:
  - <a href='#'>Sign Up for a Developer Key</a>
  - <a href='https://github.com/lord/slate'>Documentation Powered by Slate</a>

includes:
  - errors

search: true
---

# Авторизация
```json
  {
    "token": eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4OFwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NDgxODg2NjUsImV4cCI6MTU0ODE5MjI2NSwibmJmIjoxNTQ4MTg4NjY1LCJqdGkiOiJXUDh6YWMyaW82dW5oZ0FxIiwic3ViIjoyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.votfJ6YGtVZy0-CddkjWv4lXceyk2uzjV8n5619LNA8
  },
```
### HTTP Request
`GET https://proportal:81/auth/login`

В результате будет возвращен токен

# Workspace


## Получить все списки

> Полный вариант ответа

```json
[
    [{
        "spisok_id": 283,
        "spisok_name": "Новые ЮЛ (сентябрь)",
        "spisok_opisanie": "СПАРК",
        "spisok_creator_uid": 1258,
        "spisok_create_time": 1507184738,
        "spisok_edit_uid": null,
        "spisok_edit_time": null,
        "spisok_is_pro": 1,
        "business_id": 1,
        "spisok_ball": 1,
        "is_visible": 1,
        "spisok_is_payroll": 0,
        "customers_count": 138
    }]
]
```

> После применения фильтрации

```json
   [{
        "id": 129,
        "name": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
        "description": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
        "author": 3547,
        "created_at": 1502899343,
        "valuation": 10,
        "customers": 132
    }]
```


```angular
  myCustomers($status, $id)
```

Вернет список всех групп содержащих закрепленные проспекты

### HTTP Request
`GET https://proportal:81/api/crm/workspace/groups`





### Параметры запроса

Parameter | Default | Description
--------- | ------- | -----------
status | active | Ищет группы с необработанными проспектами, при 'complete' c завершенными
count | active | Считает количество тех или иных проспектов в группе



## Получить один список

```json
  {
    "id": 129,
    "name": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
    "description": "Контрагенты клиентов Росбанк: ПАО Московский кредитный банк",
    "author": 3547,
    "created_at": 1502899343,
    "valuation": 10,
    "customers": 132
  }
```

Вернет информацию об одном списке

### HTTP Request
`GET https://proportal:81/api/crm/workspace/groups/348`


## Показать порфтолио

```json
  {
    "current_page": 1,
    "data": [
        {
            "client_id": 4007195,
            "priority": 12,
            "name": "ООО \"ВЫХЛОПНЫЕ СИСТЕМЫ\"",
            "okved_vid_deyatelnosti": "Торговля оптовая автомобильными деталями, узлами и принадлежностями",
            "data_posledniy_contact_unixtime": 1541665341,
            "vyruchka_period": null,
            "vyruchka_za_god": "2279000",
            "posledniy_resultat_text": "Отложенная потребность (клиент думает , отправлено ком. предложение)"
        }
    ],
    "first_page_url": "http://localhost:8088/api/crm/workspace/portfolio?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://localhost:8088/api/crm/workspace/portfolio?page=3",
    "next_page_url": "http://localhost:8088/api/crm/workspace/portfolio?page=2",
    "path": "http://localhost:8088/api/crm/workspace/portfolio",
    "per_page": 50,
    "prev_page_url": null,
    "to": 50,
    "total": 120
}
```
```json
    {
        "client_id": 4007128,
        "priority": 10,
        "name": "ООО \"КИФ \"ПИРУЗ\"",
        "okved_vid_deyatelnosti": "Торговля оптовая фруктами и овощами",
        "data_posledniy_contact_unixtime": 1541665890,
        "vyruchka_period": null,
        "vyruchka_za_god": "289660000",
        "posledniy_resultat_text": "Отложенная потребность (клиент думает , отправлено ком. предложение)",
        "tasks": [
            {
                "a_id": 2598415,
                "client_id": 4007128,
                "creator_uid": 2,
                "created_server_unixtime": 1538568386,
                "act_type": 0,
                "act_start_time": 1548943253,
                "act_end_time": null,
                "act_result": null,
                "act_result_uid": null,
                "act_result_unixtime": null,
                "act_result_next_etap": null,
                "act_result_reason": null,
                "next_contact": null,
                "act_zametka_text": "вопрос по ипотек, передала данные Дельте",
                "act_is_first_contact": null,
                "group_id": 2,
                "executor_uid": 2,
                "act_sub_status": null,
                "act_id": null
            }
        ]
    },
```
```json
  {
    "id": 4007190,
    "valuation": 12,
    "name": "Коновалова Ольга Анатольевна",
    "industry": "Торговля розничная фруктами и овощами в специализированных магазинах",
    "activity": {
      "result": "Отложенная потребность (клиент думает , отправлено ком. предложение)",
      "date": 1541664664
    },
    "money": {
      "period": null,
      "amount": "2279000"
  }
```
Вернет информацию об одном списке

### HTTP Request
`GET https://proportal:81/api/crm/workspace/groups/348`





## Получить все задачи

```json
{
  "planned": [

  ],
  "completed": [

  ],
  "duedate: [

  ],
}
```

Вернет список задач сгрупированный по статусам

### HTTP Request
`GET  http://localhost:8088/api/crm/workspace/tasks?status=completed`

```json

[
    {
        "id": 2598431,
        "customer": {
            "id": 4007132,
            "name": "БУДАЕВА ДОЛЖИТ ЦЫРЕНДОНДОКОВНА",
            "valuation": 10
        },
        "status": "Завершено",
        "result": {
            "status": 1,
            "id": 6456
        },
        "created": 1538568470,
        "type": "Звонок",
        "start_date": 1538568470000,
        "comment": "Запросил документы, отправляю на СВЗ"
    },
]
```

### Параметры запроса
Parameter | Default | Description
--------- | ------- | -----------
status | null | Ищет задачи с определенным статусом [completed, planned, duedate]

###  Пример
`GET  http://localhost:8088/api/crm/workspace/tasks?status=completed`