<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>时钟首页</title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<style>
html, body {
	margin: 0;
	padding: 0;
	height: 100%;	
}

.wrap {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
	flex-direction: column;
  justify-content: center; 
  align-items: center;  
}
body {
	
	height: 100%;
	background-color: #313F50;

}

.numbers-wrap {
	height: 180px;
	display: inline-block;
	filter:url('#goo');
}

.colon {
	width: 20px;
	float: left;
	height: 100%;
	position: relative;
	margin: 0 15px;


	.colon-dot-1 {
		width: 30px;
		height: 30px;
		top: 28.571428572%;
	}
	.colon-dot-2 {
		width: 30px;
		height: 30px;
		top: 57.142857144%;
	}

}

.box {
	position:relative;
	width: 80px;
	height: 100%;
	box-sizing: border-box;
	padding: 20px;
	float: left;
	margin: 0 15px;
}

.dot {
	left: 20%;
	position: absolute;
	width: 30px;
	height: 30px;
	border-radius: 50%;
	background-color: #F62B4E;
}


</style>
</head>
<body><script src="/demos/googlegg.js"></script>
<script src="js/velocity.js"></script>
<body>
<div class="wrap">
  <div class="numbers-wrap">
	<div id="hours-1" class="box"></div>

<div id="hours-2" class="box"></div>

<div class="colon"><div class="dot colon-dot-1"></div><div class="dot colon-dot-2"></div></div>

<div id="minutes-1" class="box"></div>

<div id="minutes-2" class="box"></div>

<div class="colon"><div class="dot colon-dot-1"></div><div class="dot colon-dot-2"></div></div>

<div id="seconds-1" class="box"></div>

<div id="seconds-2" class="box"></div>
</div>
  </div>


<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
  <defs>
    <filter id="goo">
      <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
      <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
      <feBlend in="SourceGraphic" in2="goo" />
    </filter>
  </defs>
</svg>
</body>

<script>
$(document).ready(function(){
	var seven = 100/7;
	var numberData = [];

	numberData[0] = '1,2&1,3&1,4&2,1&2,5&3,1&3,5&4,1&4,5&5,1&5,5&6,1&6,5&7,2&7,3&7,4';
	numberData[1] = '1,3&2,2&2,3&3,1&3,3&4,3&5,3&6,3&7,1&7,2&7,2&7,3&7,4&7,5';
	numberData[2] = '1,2&1,3&1,4&2,1&2,5&3,5&4,3&4,4&5,2&6,1&7,1&7,2&7,3&7,4&7,5';
	numberData[3] = '1,2&1,3&1,4&2,1&2,5&3,5&4,3&4,4&5,5&6,1&6,5&7,2&7,3&7,4';
	numberData[4] = '1,4&2,3&2,4&3,2&3,4&4,1&4,4&5,1&5,2&5,3&5,4&5,5&6,4&7,4';
	numberData[5] = '1,1&1,2&1,3&1,4&1,5&2,1&3,1&3,2&3,3&3,4&4,5&5,5&6,1&6,5&7,2&7,3&7,4';
	numberData[6] = '1,3&1,4&2,2&3,1&4,1&4,2&4,3&4,4&5,1&5,5&6,1&6,5&7,2&7,3&7,4';
	numberData[7] = '1,1&1,2&1,3&1,4&1,5&2,5&3,4&4,3&5,2&6,2&7,2';
	numberData[8] = '1,2&1,3&1,4&2,1&2,5&3,1&3,5&4,2&4,3&4,4&5,1&5,5&6,1&6,5&7,2&7,3&7,4';
	numberData[9] = '1,2&1,3&1,4&2,1&2,5&3,1&3,5&4,2&4,3&4,4&4,5&5,5&6,4&7,2&7,3';

	function shuffle(array) {
	  var currentIndex = array.length, temporaryValue, randomIndex;

	  while (0 !== currentIndex) {

	    randomIndex = Math.floor(Math.random() * currentIndex);
	    currentIndex -= 1;

	    temporaryValue = array[currentIndex];
	    array[currentIndex] = array[randomIndex];
	    array[randomIndex] = temporaryValue;
	  }

	  return array;
	}

	function getRandom(min, max) {
    	return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	function makeDots() {
		$('.box').each(function(box){
			var thisBox = $(this);
			var numberSplit = numberData[8].split('&');
			for (var i = 0; i <= numberSplit.length-1; i++) {
				var axisSplit = numberSplit[i].split(',');
				thisBox.append('<div id="dot-'+box+'-'+i+'" class="dot" style="left:'+(axisSplit[1]-1)*20+'%; top:'+(axisSplit[0]-1)*seven+'%;"></div>');
				dotAnimate($('#dot-'+box+'-'+i));
			}
		});
	}

	function newNumber(a,b) {
		var boxDots = b.find('.dot');
		var numberSplit = numberData[a].split('&');
		numberSplit = shuffle(numberSplit);

		boxDots.each(function(i){
			var newNo = i;
			if (i >= numberSplit.length) {
				newNo = getRandom(0, numberSplit.length-1);
			}
			var axisSplit = numberSplit[newNo].split(',');
			var leftVal = (axisSplit[1]-1)*20+'%';
			var topVal = (axisSplit[0]-1)*seven+'%';
			$(this).velocity('stop').velocity({left: leftVal, top:topVal}, {duration: 800, easing:[300,25], delay:10*i});
		});
	}

	function dotAnimate(a) {
		var translateX = Math.random()*10;
		var translateY = Math.random()*10;
		var count = 1;
		setInterval(function(){		
				$.Velocity.hook(a, 'translateX', 1+(Math.cos(count*translateX/100)*4)+'px');
				$.Velocity.hook(a, 'translateY', 1+(Math.cos(count*translateY/100)*4)+'px');
				count++;		
		},30); 
	}




		var secondsFirstDigit, secondsSecondDigit, prevSecondsFirstDigit;
		var minutesFirstDigit, minutesSecondDigit, prevMinutesFirstDigit, prevMinutesSecondDigit;
		var hoursFirstDigit, hoursSecondDigit, prevHoursFirstDigit, prevHoursSecondDigit;

		function getDates() {
			var seconds = new Date();
			seconds = seconds.getSeconds();
			var secondsString = seconds.toString(); 

			if (secondsString.length === 1) {
				secondsFirstDigit = 0;
				secondsSecondDigit = secondsString;
			} else {
				secondsFirstDigit = secondsString.charAt(0);
				secondsSecondDigit = secondsString.charAt(1);
			}

			var minutes = new Date();
			minutes = minutes.getMinutes();
			var minutesString = minutes.toString(); 

			if (minutesString.length === 1) {
				minutesFirstDigit = 0;
				minutesSecondDigit = minutesString;
			} else {
				minutesFirstDigit = minutesString.charAt(0);
				minutesSecondDigit = minutesString.charAt(1);
			}

			var hours = new Date();
			hours = hours.getHours();

			if (hours > 12) {
				hours = hours-12;
			}

			var hoursString = hours.toString();

			if (hoursString.length === 1) {
				hoursFirstDigit = 0;
				hoursSecondDigit = hoursString;
			} else {
				hoursFirstDigit = hoursString.charAt(0);
				hoursSecondDigit = hoursString.charAt(1);
			}

			if (secondsFirstDigit !== prevSecondsFirstDigit) {
				newNumber(secondsFirstDigit, $('#seconds-1'));
			}
			newNumber(secondsSecondDigit, $('#seconds-2'));

			if (minutesFirstDigit !== prevMinutesFirstDigit) {
				newNumber(minutesFirstDigit, $('#minutes-1'));
			}
			if (minutesSecondDigit !== prevMinutesSecondDigit) {
				newNumber(minutesSecondDigit, $('#minutes-2'));
			}

			if (hoursFirstDigit !== prevHoursFirstDigit) {
				newNumber(hoursFirstDigit, $('#hours-1'));
			}
			if (hoursSecondDigit !== prevHoursSecondDigit) {
				newNumber(hoursSecondDigit, $('#hours-2'));
			}

			prevSecondsFirstDigit = secondsFirstDigit;

			prevMinutesFirstDigit = minutesFirstDigit;
			prevMinutesSecondDigit = minutesSecondDigit;

			prevHoursFirstDigit = hoursFirstDigit;
			prevHoursSecondDigit = hoursSecondDigit;
			
		}

		setInterval(function(){
			getDates();	
		},1000);

		
	makeDots();
	getDates();
});

</script>

</body>
</html>
