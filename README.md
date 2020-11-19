Rest api for Ktelecom.

Запросы на сервер:
GET /api/equipment - вывод всего оборудования
GET /api/equipment/{equipment} - показ определенного оборудования
POST /api/equipment?{type_equipments_id}{serial_number} - добавление записи в таблицу equipments
PUT /api/equipment/{equipment} - редактирование записи в таблице equipments
DELETE /api/equipment/{equipment} - удаление записи из таблицы equipments
