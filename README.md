# Plataforma Interactiva de Comunicación y Aprendizaje para Personas con Trastornos de Lenguaje

En Colombia, miles de personas enfrentan retos comunicativos debido a condiciones como el **Trastorno del Espectro Autista (TEA)**, la **afasia**, la **disartria** y otras alteraciones del lenguaje. Según estimaciones del Ministerio de Salud y Protección Social, uno de cada 160 niños presenta algún tipo de autismo, y el país aún enfrenta desafíos significativos en términos de inclusión educativa, accesibilidad comunicativa y atención especializada.

Históricamente, la comunicación alternativa ha sido abordada mediante el uso de **tarjetas visuales (PECS)**, dispositivos electrónicos especializados o tableros físicos. Sin embargo, estos métodos suelen ser costosos, difíciles de actualizar o poco accesibles para familias de bajos recursos.

Frente a esta necesidad, surge la oportunidad de construir una plataforma interactiva que integre **tecnología accesible**, herramientas visuales, auditivas y táctiles, así como recursos multilingües, para promover la autonomía y el aprendizaje de las personas con dificultades del lenguaje en Colombia. Este tipo de solución también puede ser utilizada por docentes de educación especial, terapeutas del lenguaje y cuidadores.

## Contexto y Especificaciones:

Desarrollar una **plataforma web inclusiva**, diseñada con estándares de accesibilidad y centrada en el usuario, que permita a personas con trastornos del lenguaje **comunicarse y aprender** mediante tarjetas interactivas, lecciones personalizadas, y métodos multisensoriales. Además, se proveerá un **panel administrativo** para la gestión de contenidos, traducciones, medios, tarjetas y usuarios.

### El estudiante deberá implementar una solución que contemple las siguientes funcionalidades detalladas:

#### Gestión de usuarios y roles

- Registro de usuarios con roles: usuario, administrador.
- Inicio de sesión con protección de rutas por middleware.
- Asignación automática de lecciones diarias al iniciar sesión.

#### Tarjetas de comunicación

- CRUD completo de tarjetas con:

  - Imagen asociada
  - Frase clave
  - Traducción por idioma
  - Audio por idioma (mínimo 1 por idioma)
  - Método de interacción (visual, auditivo, táctil)
  - Código RFID o UUID único **(simulado como prototipo)**

  Reproducción automática de audio al visualizar, interactuar con una tarjeta o al buscar por su código único.

#### Multilenguaje y accesibilidad

- Soporte para múltiples idiomas con Laravel Localization.
- Asociar archivos de audio por idioma (**mínimo un audio funcional por idioma, otros a nivel de prototipo o simulación**).
- Interfaz visual amigable, con íconos grandes y texto claro.

#### Lecciones y progreso

- Módulo de lecciones diarias asignadas automáticamente.
- Módulo de lecciones de refuerzo, basado en el uso y rendimiento del usuario (**a nivel básico o de simulación**).
- Registro del progreso del usuario: tarjetas usadas, lecciones completadas.
- Visualización de avances desde el panel del usuario o del administrador (**reportes avanzados a nivel de prototipo**).

#### Métodos de comunicación

- Registro y gestión de métodos de comunicación sensorial.
- Filtros para ver tarjetas según el canal preferido (visual, auditivo, táctil).
- Adaptación dinámica del contenido según el método seleccionado (**aplicación del Strategy Pattern solo como prototipo o simulación**).

#### API RESTful

- Endpoints para:
  - Obtener tarjetas por idioma, método o categoría
  - Registrar uso de tarjetas
  - Ver progreso de usuario
  - Consultar y guardar lecciones
- Arquitectura modular con controladores REST, servicios, repositorios y validaciones.

### Importancia del Frontend:

Un sistema de estas características no puede depender únicamente del backend. El **frontend es fundamental** para garantizar una experiencia de usuario inclusiva, accesible y eficiente.

- **Accesibilidad visual y auditiva**: permite representar tarjetas mediante íconos, imágenes grandes, colores contrastantes y audios, facilitando la comprensión para usuarios con dificultades cognitivas o visuales.
- **Interacción directa**: el usuario puede tocar una tarjeta y escuchar la frase, acceder a su traducción y ver una representación visual sencilla.
- **Aprendizaje guiado**: las lecciones deben estar presentadas de manera progresiva, con botones grandes, navegación intuitiva y retroalimentación visual o sonora.
- **Panel administrativo usable**: permite al terapeuta o cuidador gestionar tarjetas, cargar audios, revisar progreso y asignar lecciones de forma eficiente.

### Requisitos no funcionales:

- Laravel 11 con Eloquent ORM y migraciones.
- Controladores RESTful con FormRequest para validaciones.
- Acceso seguro con **PDO** y sentencias preparadas (Laravel lo maneja internamente).
- Uso de **namespaces**, **clases**, **interfaces** y **herencia**.
- Código estructurado bajo principios **SOLID**.
- Autoloading con **Composer PSR-4**.
- Uso de **Repository Pattern** y otro patrón aplicable (Strategy para métodos de comunicación).
- Multilenguaje con Laravel Localization.
- Middleware para protección de rutas administrativas.

### Herramientas y tecnologías:

- **Backend**: Laravel 11, Eloquent ORM, Composer
- **Base de datos**: MySQL o PostgreSQL
- **Frontend (opcional)**: HTML5, CSS3, JavaScript, Bootstrap o Vue.js
- **Otros**: Laravel File Storage (**opcional**) (audios), Postman, Git/GitHub

### Recomendaciones

- Simular RFID usando UUID o códigos únicos.
- Usar seeders para cargar tarjetas iniciales y métodos de comunicación.
- Modularizar la lógica de lecciones con una capa de servicios.
- Validar con FormRequest y proteger rutas críticas con middleware de roles.
- Documentar los endpoints de la API con Swagger o Postman.

### Recursos

- [Laravel 11 Docs](https://laravel.com/docs)
- [Localization en Laravel](https://laravel.com/docs/localization)
- [Repository Pattern in Laravel](https://medium.com/@cesiztel/repository-pattern-en-laravel-f66fcc9ea492)
- [Uso de Composer](https://getcomposer.org/)
- [Principios SOLID](https://dev.to/nadlambino/solid-principle-with-laravel-1ej7)



## Rúbricas

| #    | Criterio de Evaluación                   | Puntaje | Porcentaje | Nivel 1 (0-1)           | Nivel 2 (25)                                    | Nivel 3 (50)                                         | Nivel 4 (75)                                                | Nivel 5 (100)                                                |
| ---- | ---------------------------------------- | ------- | ---------- | ----------------------- | ----------------------------------------------- | ---------------------------------------------------- | ----------------------------------------------------------- | ------------------------------------------------------------ |
| 1    | Dominio y manejo del código              | 73      | 50%        |                         |                                                 |                                                      |                                                             |                                                              |
| 2    | Administración de tarjetas y validación  | 10      | 6,8%       | No implementado.        | CRUD mínimo sin validaciones ni multimedia.     | CRUD funcional con imagen y traducción básica.       | CRUD con validaciones y archivos multimedia simples.        | CRUD completo con validaciones FormRequest, multimedia y métodos de interacción. |
| 3    | Asociación RFID/UUID y lógica de audio   | 8       | 5,5%       | No implementado.        | Identificador único sin integración de audio.   | Identificador UUID con reproducción de audio básica. | Asociación UUID con simulación de RFID y audio funcional.   | Asociación UUID/RFID simulada y audio integrado estable.     |
| 4    | Lecciones diarias, refuerzo y progreso   | 8       | 5,5%       | No implementado.        | Lecciones parciales sin seguimiento.            | Lecciones básicas con relación a usuario.            | Lecciones asignadas y progreso simple registrado.           | Lecciones diarias y refuerzo con seguimiento funcional.      |
| 5    | POO y principios SOLID                   | 8       | 5,5%       | Código procedural.      | Uso parcial de clases sin SRP.                  | Uso básico de clases e interfaces con SRP parcial.   | Aplicación clara de principios SOLID en clases y servicios. | Principios SOLID aplicados completamente (SRP, OCP, DI).     |
| 7    | Traducciones y audios multilingües       | 7       | 4,8%       | No implementado.        | Traducciones parciales sin coherencia.          | Traducciones implementadas por idioma con un audio.  | Uso correcto de Localization y audios por idioma básico.    | Múltiples idiomas con audio por código, integración funcional. |
| 8    | Registro de usuarios y roles             | 6       | 4,1%       | No implementado.        | Registro básico sin roles.                      | Autenticación y roles básicos sin middleware.        | Roles funcionales con middleware mínimo.                    | Roles definidos y protegidos con middleware/scopes.          |
| 9    | Uso de Patrones de Diseño                | 6       | 4,1%       | No implementado.        | Intento parcial de Repository sin consistencia. | Repository funcional básico.                         | Repository funcional + simulación de Strategy Pattern.      | Uso correcto de Repository y Strategy como prototipo justificado. |
| 10   | Validaciones y seguridad de rutas        | 6       | 4,1%       | No implementado.        | Validaciones en controlador sin middleware.     | FormRequest básico sin protección de rutas.          | Validaciones centralizadas con middleware parcial.          | Validaciones completas con FormRequest + middleware de roles. |
| 11   | Presentación, organización y entregables | 6       | 4,1%       | Proyecto desorganizado. | Estructura parcial sin documentación.           | Proyecto organizado, entregable básico.              | Proyecto organizado con documentación mínima.               | Organización impecable: carpetas claras, Readme, Postman, Seeders. |