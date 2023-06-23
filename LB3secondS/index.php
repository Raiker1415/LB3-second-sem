<!-- "Варіант 7" -->
<!DOCTYPE html>
<html>
<head>
    <title>Використання мережевого трафіку</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Використання мережевого трафіку</h1>
        <h2>Запит за ім'ям</h2>
        <form id="name-form">
            <label for="name">Ім'я:</label>
            <input type="text" name="name" id="name" required>
            <input type="submit" value="Виконати запит">
        </form>
        <div id="name-result"></div>

        <h2>Запит за датою</h2>
        <form id="date-form">
            <label for="start_date">Дата початку (год-хв-сек):</label>
            <input type="text" name="start_date" id="start_date" required>
            <input type="submit" value="Виконати запит">
        </form>
        <div id="date-result"></div>

        <h2> </h2>
        <button id="all-clients-btn">Всі клієнти</button>
        <div id="all-clients-result"></div>
    </div>

    <script>
        function sendNameRequest() {
            var form = document.getElementById('name-form');
            var resultDiv = document.getElementById('name-result');
            var name = document.getElementById('name').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resultDiv.innerHTML = xhr.responseText;
                    } else {
                        resultDiv.innerHTML = 'Сталася помилка під час виконання запиту.';
                    }
                }
            };

            xhr.open('POST', 'query1.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('name=' + encodeURIComponent(name));

            return false;
        }

        function sendDateRequest() {
            var form = document.getElementById('date-form');
            var resultDiv = document.getElementById('date-result');
            var startDate = document.getElementById('start_date').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resultDiv.innerHTML = xhr.responseText;
                    } else {
                        resultDiv.innerHTML = 'Сталася помилка під час виконання запиту.';
                    }
                }
            };

            xhr.open('POST', 'query2.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('start_date=' + encodeURIComponent(startDate));

            return false;
        }

        function sendAllClientsRequest() {
            var resultDiv = document.getElementById('all-clients-result');

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        var html = '';
                        for (var i = 0; i < response.length; i++) {
                            html += '<p>Ім\'я: ' + response[i].name + '</p>';
                            html += '<p>Баланс: ' + response[i].balance + '</p>';
                            html += '<p>Початок сеансу: ' + response[i].start + '</p>';
                            html += '<p>Кінець сеансу: ' + response[i].stop + '</p>';
                            html += '<p>Вхідний трафік: ' + response[i].in_traffic + '</p>';
                            html += '<p>Вихідний трафік: ' + response[i].out_traffic + '</p>';
                            html += '<hr>';
                        }
                        resultDiv.innerHTML = html;
                    } else {
                        resultDiv.innerHTML = 'Сталася помилка під час виконання запиту.';
                    }
                }
            };

            xhr.open('GET', 'query3.php', true);
            xhr.send();

            return false;
        }

        document.getElementById('name-form').onsubmit = sendNameRequest;
        document.getElementById('date-form').onsubmit = sendDateRequest;
        document.getElementById('all-clients-btn').onclick = sendAllClientsRequest;
    </script>
</body>
</html>
