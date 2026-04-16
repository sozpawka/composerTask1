<h1>Добавить врача</h1>

<form method="POST" action="/pop-it-mvc/doctors/create">
    <input type="text" name="last_name" placeholder="Фамилия" required><br><br>
    <input type="text" name="first_name" placeholder="Имя" required><br><br>
    <input type="text" name="middle_name" placeholder="Отчество"><br><br>
    <input type="date" name="birth_date" required><br><br>
    <input type="text" name="position" placeholder="Должность" required><br><br>
    <input type="text" name="specialization" placeholder="Специализация" required><br><br>
    <button type="submit">Создать</button> <a href="/pop-it-mvc/">На главную</a>
</form>