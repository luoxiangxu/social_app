var choices=[];
userCN=0;
	
function userTurn(_this,userChoice){
	if(isVaild(_this)){
		_this.innerHTML="<p class='titactoe2'>X</p>";
		choices[userChoice]="x";
		_this.disabled=true;
		userCN++;
		if(userCN > 2){
			check_win_user();
		}
		botTurn();
	}
}

function botTurn(){
	do{
		if(userCN==5 || document.getElementById("winner").value!=""){
			if(document.getElementById("winner").value==""){
				draw();
				break;
			}
			break;
		}
		botChoice=Math.floor(Math.random() *9);
	}
	while(!isVaild(document.getElementById(botChoice)));
	document.getElementById(botChoice).innerHTML="<p class='titactoe1'>O</p>";
	choices[botChoice]="o";
	document.getElementById(botChoice).disabled=true;
	if(userCN > 2){
			check_win_bot();
		}
}

function isVaild(choice){
	if(choice.disabled){
		return false;
	}
	else{
		return true;
	}
}

function check_win_user(){

	switch(choices[0]+choices[1]+choices[2]){
		case "xxx":
			color(0,1,2);
			btn_disabled();
			user_win();
			break;					
	}

	switch(choices[3]+choices[4]+choices[5]){
		case "xxx":
			color(3,4,5);
			btn_disabled();
			user_win();
			break;			
	}

	switch(choices[6]+choices[7]+choices[8]){
		case "xxx":
			color(6,7,8);
			btn_disabled();
			user_win();
			break;	
	}

	switch(choices[0]+choices[3]+choices[6]){
		case "xxx":
			color(0,3,6);
			btn_disabled();
			user_win();
			break;	
	}

	switch(choices[1]+choices[4]+choices[7]){
		case "xxx":
			color(1,4,7);
			btn_disabled();
			user_win();
			break;	
	}

	switch(choices[2]+choices[5]+choices[8]){
		case "xxx":
			color(2,5,8);
			btn_disabled();
			user_win();
			break;	
	}

	switch(choices[0]+choices[4]+choices[8]){
		case "xxx":
			color(0,4,8);
			btn_disabled();
			user_win();
			break;	
	}

	switch(choices[2]+choices[4]+choices[6]){
		case "xxx":
			color(2,4,6);
			btn_disabled();
			user_win();
			break;	
	}
}

function check_win_bot(){

	switch(choices[0]+choices[1]+choices[2]){				
		case "ooo":
			color(0,1,2);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[3]+choices[4]+choices[5]){			
		case "ooo":
			color(3,4,5);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[6]+choices[7]+choices[8]){
		case "ooo":
			color(6,7,8);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[0]+choices[3]+choices[6]){
		case "ooo":
			color(0,3,6);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[1]+choices[4]+choices[7]){	
		case "ooo":
			color(1,4,7);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[2]+choices[5]+choices[8]){
		case "ooo":
			color(2,5,8);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[0]+choices[4]+choices[8]){
		case "ooo":
			color(0,4,8);
			btn_disabled();
			bot_win();
			break;
	}

	switch(choices[2]+choices[4]+choices[6]){
		case "ooo":
			color(2,4,6);
			btn_disabled();
			bot_win();
			break;
	}
}

function btn_disabled(){
	for (var i =0; i < 9; i++) {
			if(isVaild(document.getElementById(i))){
				choices[i]=null;
				document.getElementById(i).disabled=true;
			}
	}
}

function user_win(){
	document.getElementById("winner").style.visibility="visible";
	document.getElementById("winner").value="player";
	document.getElementById("new_btn").style.visibility="visible";
	var str1="player";
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "titactoe.php?winner=" +str1, true);
	xmlhttp.send();
	detail();
}

function bot_win(){
	document.getElementById("winner").style.visibility="visible";
	document.getElementById("winner").value="bot";
	document.getElementById("new_btn").style.visibility="visible";
	var str1="bot";
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "titactoe.php?winner=" +str1, true);
	xmlhttp.send();
	detail();
}

function draw(){
	document.getElementById("winner").style.visibility="visible";
	document.getElementById("winner").value="draw";
	document.getElementById("new_btn").style.visibility="visible";
	var str1="draw";
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "titactoe.php?winner=" +str1, true);
	xmlhttp.send();
	detail();
}

function color(p1,p2,p3){
	document.getElementById(p1).style.backgroundColor="rgb(0, 255, 98)";
	document.getElementById(p2).style.backgroundColor="rgb(0, 255, 98)";
	document.getElementById(p3).style.backgroundColor="rgb(0, 255, 98)";
}

function detail(){
	data={
		"choices0":choices[0],
		"choices1":choices[1],
		"choices2":choices[2],
		"choices3":choices[3],
		"choices4":choices[4],
		"choices5":choices[5],
		"choices6":choices[6],
		"choices7":choices[7],
		"choices8":choices[8]
	};
	var myJSON=JSON.stringify(data);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET", "titactoe.php?choices=" +myJSON, true);
	xmlhttp.send();
}
