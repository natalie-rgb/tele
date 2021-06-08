<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalendarz wizyt</title>

    <link rel="stylesheet" href="calendar_style.css">
  <?php
  include("/public_html/tele_projekt/telemedycyna/baza1.php"); //new
  echo '<a href = \public_html\tele_projekt\telemedycyna\page2.php style="float: right;"> Powrót </a>'

  ?>  
  </head>
  
  <body>
  
    <div id="container">
      <div id="header">
        <div id="monthDisplay"></div>
        <div>
          <button id="backButton">Poprzedni</button>
          <button id="nextButton">Następny</button>
        </div>
      </div>

      <div id="weekdays">
        <div>Niedziela</div>
        <div>Poniedziałek</div>
        <div>Wtorek</div>
        <div>Środa</div>
        <div>Czwartek</div>
        <div>Piątek</div>
        <div>Sobota</div>
      </div>

      <div id="calendar"></div>
    </div>

    <div id="newEventModal">
      <h2>Nowa wizyta</h2>
      <input id="eventTitleInput" placeholder="Rodzaj wizyty" required/>
      <input id="eventTitleInput_date" placeholder="Godzina wizyty" required/> 
      <button id="saveButton">Zapisz</button>
      <button id="cancelButton">Anuluj</button>
    </div>

    <div id="deleteEventModal">
      <h2>Wizyta</h2>

      <p id="eventText"></p>

      <button id="deleteButton">Usuń</button>
      <button id="closeButton">Zamknij</button>
    </div>

    <div id="modalBackDrop"></div>

    <script src="./script.js"></script>


  </body>
</html>


