var trump = document.getElementById("trump");
var audio = document.getElementById("audio");

function play(number) {
    audio.src = "../audio/trump/trump"+number+".ogg";
    audio.play();
}

if (trump != null) {
    trump.onclick = function () {
        trump.src = "../images/happytrump.jpg";
        var i = Math.floor((Math.random()*10)+1);
        if (i < 10)
            i = "0"+i;
        play(i);
        setTimeout("trump.src = '../images/sadtrump.jpg'", 5000);
    }
}