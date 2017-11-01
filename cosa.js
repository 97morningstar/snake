var s;
var scl = 20;
var food;



function setup() {

createCanvas(300, 300);

s = new Snake();
frameRate(10);
PickLocation();
}

function PickLocation(){
	var cols = floor(width/scl);
	var rows = floor(height/scl);
   food = createVector(floor(random(cols)), floor(random(rows)));
   food.mult(scl);
}


function draw() {
	background(51);


    if(s.eat(food)){
    	PickLocation();
    }

    s.death();
	s.update();
    s.show();

    fill(255, 0, 100);
    rect(food.x, food.y, scl, scl);
}


function keyPressed(){
	if(keyCode === UP_ARROW){
         s.dir(0, -1);
	}
	else if(keyCode === DOWN_ARROW){
         s.dir(0, 1);
	}
	else if(keyCode === RIGHT_ARROW){
         s.dir(1, 0);
	}else if(keyCode === LEFT_ARROW){
         s.dir(-1, 0);
	}
}


function Snake(){
	this.x=0;
	this.y=0;
	this.xspeed=1;
	this.yspeed=0;
	this.total = 0;
	this.tail = [];
	this.muerte = false;

	this.death = function() {

		for(var i = 0 ; i < this.tail.length; i++){
			var pos = this.tail[i];
			var d = dist(this.x, this.y, pos.x, pos.y);
			if(d < 1){
				this.total = 0;
				this.tail = [];
				this.muerte = true;
				console.log('dd');
				alert("s");
			}
		}

	}

	this.eat = function(pos) {
		var d = dist(this.x, this.y, pos.x, pos.y);
		if(d < 1){
			this.total++;
			return true;
		} else {
			return false;
		}

	}


	this.dir = function(x, y){
		this.xspeed = x;
		this.yspeed = y;
	} 

	this.update = function(){
		if(this.total === this.tail.length){
			for(var i = 0; i < this.tail.length-1; i++){
				this.tail[i]=this.tail[i+1];
			}
		}
		this.tail[this.total-1]= createVector(this.x, this.y);

		this.x = this.x + this.xspeed*scl;
		this.y = this.y + this.yspeed*scl;

		this.x = constrain(this.x, 0, width-scl);
		this.y = constrain(this.y, 0, height-scl);

	}

	this.show = function() {
		
fill(255);
for (var i = 0; i < this.total; i++) {
		rect(this.tail[i].x, this.tail[i].y, scl, scl);
}

fill(255);    //para dibujar
//donde empieza x      y    ancho largo  
	    rect(this.x, this.y, scl, scl);

	}


}
