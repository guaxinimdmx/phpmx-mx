# `users`

[← Database](../database.md) · [← Index](../../index.md)

Usuários cadastrados no sistema

| Campo | Tipo | Nulo | Padrão | Comentário |
|---|---|---|---|---|
| _created | datetime | não | CURRENT_TIMESTAMP | moment of record creation |
| _updated | datetime | sim | — | moment of last record update |
| _deleted | datetime | sim | — | moment of record deletion |
| name | varchar | não | — | Nome completo do usuário |
| email | email | não | — | E-mail de login, único por usuário |
| password | password | não | — | Hash da senha do usuário |
| active | boolean | não | true | Se o usuário pode fazer login |
| user_group | idx → user_group | sim | — | Grupo ao qual o usuário pertence |