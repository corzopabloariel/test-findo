## Challenge Findo

#### Especificaciones
- **Framework php:** Laravel v6
- **PHP:** 7.3.15
- **Header:** Content-Type: application/json - Todas las rutas verifican si el Request es tipo JSON, caso contrario retorna un error 401

#### Entidades
1. Person
2. Student
3. Teacher
4. Subject
5. Student_Subject
6. TypeQualification - Solo posee 1 registro
7. Qualification

#### Rutas
Todos los modelos poseen un ABM disponible, auque realiza una pequeña carga de registros para el uso inmediato. Para el uso hay que anteponer la palabra *api*
```sh
GET /api/students
GET /api/students/1
POST /api/students
PUT /api/students/1
DELETE /api/students/1
```

## Entidades
#### Student
**Métodos:** Create (POST), Read (GET), Update (PUT), Delete (DELETE)
| ATTR | TYPE |
| ------ | ------ |
| id_number | INTEGER |
| name | STRING |
| last_name | STRING |
| date_birth | DATE |
| docket | INTEGER |
#### Teacher
**Métodos:** Create (POST), Read (GET), Update (PUT), Delete (DELETE)
| ATTR | TYPE |
| ------ | ------ |
| id_number | INTEGER |
| name | STRING |
| last_name | STRING |
| date_birth | DATE |
| docket | INTEGER |
| date | DATE |
**Subject**
**Métodos:** Create (POST), Read (GET), Update (PUT), Delete (DELETE)
| ATTR | TYPE |
| ------ | ------ |
| name | STRING |
| description | STRING |
| teacher_id | INTEGER |
**Student_Subject**
**Métodos:** Create (POST), Read all (GET), Delete (DELETE)
| ATTR | TYPE |
| ------ | ------ |
| student_id | INTEGER |
| subject_id | INTEGER |
**TypeQualification**
**Métodos:** Create (POST), Read (GET), Update (PUT), Delete (DELETE)
| ATTR | TYPE |
| ------ | ------ |
| name | STRING |
**Qualification**
**Métodos:** Create (POST), Read (GET), Update (PUT), Delete (DELETE)
| ATTR | TYPE |
| ------ | ------ |
| studentsubject_id | INTEGER |
| type_id | INTEGER |
| date | DATE |
| note | FLOAT |


# Endpoints
1. Realizar un endpoint que devuelva las calificaciones de un alumno en
particular
> Realiza los join necesarios para realizar la operación
> GET api/qualifications/student/{student_id}
2. Realizar un endpoint que devuelva el promedio histórico por materia.
> Realiza los join necesarios para realizar la operación
> GET api/history