<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script>
    playSound()
    function playSound() {
    const audio = new Audio('audio/goes-without-saying-608.mp3');
    audio.play();
  }
</script>
<body>
    <button activ onclick="playSound()">Play</button>
  
</body>
</html>