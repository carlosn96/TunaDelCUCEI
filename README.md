# Tuna del CUCEI API

La API de Tuna del CUCEI permite gestionar y consultar información sobre los integrantes, eventos, asistencias y notificaciones de la Tuna del CUCEI. Está diseñada para ser consumida por aplicaciones móviles o web.

## Estructura del Proyecto

- `public/index.php`: Punto de entrada principal de la API.
- `src/controller/Router.php`: Clase `Router` para manejar el enrutamiento.
- `public/integrante/IntegranteAPI.php`: Controlador que maneja las operaciones relacionadas con los integrantes.

## Endpoints Disponibles

### Integrantes

- **GET `/integrante`**  
  Retorna un array de objetos con la información de todos los integrantes.

  **Ejemplo de respuesta:**
  ```json
  [
    {
      "id": 1,
      "nombre": "Juan Pérez",
      "mote": "El Puma",
      "fechaIngreso": "2022-05-12",
      "rango": "Tuno",
      "instrumentos": ["Guitarra", "Mandolina"]
    }
  ]
- **GET `/integrante`**  
- **GET `/integrante/{id}`** 

Retorna un objeto con la información del integrante identificado por {id}. Si el ID no existe, retorna un array vacío [].
```json
{
  "id": 1,
  "nombre": "Juan Pérez",
  "mote": "El Puma",
  "fechaIngreso": "2022-05-12",
  "rango": "Tuno",
  "instrumentos": ["Guitarra", "Mandolina"]
}

### Eventos
- **GET `/evento`** 
```json
[
  {
    "id": 1,
    "nombre": "Serenata de Bienvenida",
    "fechaHora": "2024-10-01 20:00",
    "lugar": "CUCEI",
    "descripcion": "Evento para recibir a los nuevos aspirantes."
  }
]
- **GET `/evento/{id}`**
Retorna un objeto con la información del evento identificado por {id}. Si el ID no existe, retorna un array vacío [].

```json
{
  "id": 1,
  "nombre": "Serenata de Bienvenida",
  "fechaHora": "2024-10-01 20:00",
  "lugar": "CUCEI",
  "descripcion": "Evento para recibir a los nuevos aspirantes."
}
### Asistencias
- **GET `/asistencia/{id}`**

Retorna un array de objetos con los integrantes que asistieron al evento identificado por {id}. Si el evento no existe o no hay asistencias, retorna un array vacío [].
```json

[
  {
    "id": 1,
    "nombre": "Juan Pérez",
    "mote": "El Puma"
  }
]

- **GET `/asistencia/faltas/{id}`**
Retorna un array de objetos con los integrantes que faltaron al evento identificado por {id}. Si el evento no existe o no hay faltas, retorna un array vacío [].

```json
[
  {
    "id": 2,
    "nombre": "Carlos López",
    "mote": "El Lobo"
  }
]
