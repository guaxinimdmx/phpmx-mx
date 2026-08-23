# `Model\DbMain\DbMain`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Ponto de entrada estático para as tabelas do banco de dados main.

## Properties

- `public static $users` `mixed` —  _(herdado de `Model\DbMain\Driver\DriverDbMain`)_
- `public static $userGroup` `mixed` —  _(herdado de `Model\DbMain\Driver\DriverDbMain`)_

## Methods

---

### `public static users()`

 _(herdado de `Model\DbMain\Driver\DriverDbMain`)_

Usuários cadastrados no sistema

**Returns:** `Model\DbMain\Record\RecordUsers`

---

### `public static userGroup()`

 _(herdado de `Model\DbMain\Driver\DriverDbMain`)_

Grupos de permissão de usuário

**Returns:** `Model\DbMain\Record\RecordUserGroup`