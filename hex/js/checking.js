function search(twoD,oneD){
for(var i=0;i<twoD.length;i++){
if(twoD[i][0] == oneD[0] && twoD[i][1] == oneD[1]) {
return true;
}
}
return false;
}
function floodFill(hex, side, index, deleting) {
if (hex.blocks[side] === undefined || hex.blocks[side][index] === undefined) return;
var color = hex.blocks[side][index].color;
for(var x =-1;x<2;x++){
for(var y =-1;y<2;y++){
if(Math.abs(x)==Math.abs(y)){continue;}
var curSide =(side+x+hex.sides)%hex.sides;
var curIndex = index+y;
if(hex.blocks[curSide] === undefined){continue;}
if(hex.blocks[curSide][curIndex] !== undefined){
if(hex.blocks[curSide][curIndex].color == color && search(deleting,[curSide,curIndex]) === false && hex.blocks[curSide][curIndex].deleted === 0 ) {
deleting.push([curSide,curIndex]);
floodFill(hex,curSide,curIndex,deleting);
}
}
}
}
}
function consolidateBlocks(hex,side,index){
var sidesChanged =[];
var deleting=[];
var deletedBlocks = [];
deleting.push([side,index]);
floodFill(hex,side,index,deleting);
if(deleting.length<3){return;}
var i;
for(i=0; i<deleting.length;i++) {
var arr = deleting[i];
if(arr !== undefined && arr.length==2) {
if(sidesChanged.indexOf(arr[0])==-1){
sidesChanged.push(arr[0]);
}
hex.blocks[arr[0]][arr[1]].deleted = 1;
deletedBlocks.push(hex.blocks[arr[0]][arr[1]]);
}
}
var now = MainHex.ct;
if(now - hex.lastCombo < settings.comboTime ){
settings.comboTime = (1/settings.creationSpeedModifier) * (waveone.nextGen/16.666667) * 3;
hex.comboMultiplier += 1;
hex.lastCombo = now;
var coords = findCenterOfBlocks(deletedBlocks);
hex.texts.push(new Text(coords['x'],coords['y'],"x "+hex.comboMultiplier.toString(),"bold Q","#fff",fadeUpAndOut));
}
else{
settings.comboTime = 240;
hex.lastCombo = now;
hex.comboMultiplier = 1;
}
var adder = deleting.length * deleting.length * hex.comboMultiplier;
hex.texts.push(new Text(hex.x,hex.y,"+ "+adder.toString(),"bold Q ",deletedBlocks[0].color,fadeUpAndOut));
hex.lastColorScored = deletedBlocks[0].color;
score += adder;
}
