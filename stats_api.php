<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Hello</title>
<meta name="description" content="Stats API"><link rel="shortcut icon" href="/images/favicon.gif">

</head>
  <body>      

    <div id="content" style="margin-top: 100px;">
      <form action="update.php" method="post">
        <input type="radio" name="type" value="races" checked> All races (LocalRun table) since last update<br>
        <input type="radio" name="type" value="race_demos"> Gold medal username-course-style's (LocalRun table) since last update (for demo collection)<br>
        <input type="radio" name="type" value="duels"> All duels (LocalDuel table) since last update<br>
        <input type="radio" name="type" value="accounts"> Account info since last update<br>
        <input type="radio" name="type" value="teams"> Team info since last update<br>
        <input type="radio" name="type" value="team_accounts"> Team member info since last update<br>

        Last Update Unix Time (only results newer than will be returned, if applicable):<br>
        <input type="text" name="last_update" value=""><br>

        Username:<br>
        <input type="text" name="username" value=""><br>
        Password:<br>
        <input type="text" name="password" value=""><br><br>

        <input type="submit" value="Submit">
      </form> 
    </div>

  </body>
</html>
