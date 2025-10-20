### Сделано:

- Миграции
- Модели
- Контроллеры
- ФормРеквесты
- Ресурсы
- Фабрики
- Тесты 

### Запуск

```bash
composer install
cp .env.example .env # Как БД используется SQLite
php artisan key:generate
php artisan migrate --seed
php artisan test
```

### Интеграция в BookingCore

- Вместо tour_name явно бы использовался `tour_id`, а Bookings - создавались бы уникальными под `tour_id`, `guide_id` и `date`
- Подсчёт участников, вероятно, вёлся бы по кол-ву записей в pivot таблице вида `participant_hunting_bookings_pivot`
- Наличествовала бы привязка к пользователю-клиенту - нельзя ведь любому бронировать туры
- Возможно, для туров были бы свои уникальные лимиты участников
