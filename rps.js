var userScore = 0;
var botScore = 0;
var round = 1;
var winner;
var draw=0;



function paper(){
    const userChoice = "paper";
    const botChoice = compChoice();
    compare(userChoice,botChoice);
    save(userChoice,botChoice);
    round++;
    document.getElementById('round').innerHTML=round;
}

function rock(){
    const userChoice = "rock";
    const botChoice = compChoice();
    compare(userChoice,botChoice);
    save(userChoice,botChoice);
    round++;
    document.getElementById('round').innerHTML=round;
}

function scissor(){
    const userChoice = "scissor";
    const botChoice= compChoice();
    compare(userChoice,botChoice);
    save(userChoice,botChoice);
    round++;
    document.getElementById('round').innerHTML=round;
}

function compChoice(){
    const choices = ['paper','rock','scissor'];
    const randomNumber = Math.floor(Math.random() * 3);
    return choices[randomNumber];
}

function compare(userChoice,botChoice){
    switch(userChoice + botChoice){
        case "paperrock":
		case "rockscissor":
		case "scissorpaper":
            winner = "user";
            userScore++;
            document.getElementById('user_score').innerHTML=userScore;
            document.getElementById('result').innerHTML=userChoice + "(user choice) beats " + botChoice + " user win!";
            break;
        case 'paperscissor':
        case 'rockpaper':
        case 'scissorrock':
            winner = "bot";
            botScore++;
            document.getElementById('bot_score').innerHTML=botScore;
            document.getElementById('result').innerHTML=botChoice + " beats " + userChoice + "(user choice) bot win!";
            break;
        default:
            winner = "draw";
            draw++;
            document.getElementById('draw').innerHTML=draw;
            document.getElementById('result').innerHTML="its a draw";
            break;
    }
}

function save(userChoice,botChoice){
    if(round == 1){
        data={
            "userScore": userScore,
            "botScore": botScore,
            "draw": draw
        };
        var myJSON=JSON.stringify(data);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "rps.php?data1=" +myJSON, true);
        xmlhttp.send();
    }

    data={
        "userChoice": userChoice,
        "botChoice": botChoice,
        "winner": winner,
        "round": round
    };
    var myJSON=JSON.stringify(data);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "rps.php?data2=" +myJSON, true);
    xmlhttp.send();

    if(round>1){
        data={
            "userScore": userScore,
            "botScore": botScore,
            "draw": draw
        };
        var myJSON=JSON.stringify(data);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "rps.php?data3=" +myJSON, true);
        xmlhttp.send();
    }
}