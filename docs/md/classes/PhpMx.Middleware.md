# `PhpMx\Middleware`

[← Classes](../classes.md) · [← Index](../../index.md)

**Type:** `abstract class`

Classe responsável pela execução encadeada de middlewares.

## Methods

---

### `public static run(queue, action)`

Executa uma fila de middlewares retornando a action.

- `$queue` `array` — Lista de middlewares a serem executados em ordem.
- `$action` `Closure` — Ação final executada após a fila.

**Returns:** `mixed`