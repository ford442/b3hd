<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="cleartype" content="on">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>B*3*H*D</title>
<script type="text/javascript" src="./js/slideout.min.js"></script>
<script type="text/javascript" src="./js/rSlider.min.js"></script>
<style>
</style><link rel="stylesheet" href="./css/rSlider.min.css">
</head><link rel="stylesheet" href="./css/b3hd.css"></head>
<body>
<h1></h1>
<nav id="menu">
<section class="menu-section" id="menu-sections">
B*3*H*D
*******
<ul class="menu-section-list">
<div style="width:384px;text color:white;">
<div id="slideframe"><input type="text" id="timeslider"/>
</div>
</div>
</ul>
</section>
</nav>
<input type="checkbox" id="di" hidden/>
<div id="iwid" hidden></div>
<div id="ihig" hidden></div>
<div id="wid" hidden></div>
<div id="hig" hidden></div>
<div id="inhred" hidden></div>
<div id="frate" hidden></div>
<div id="temptime" hidden>7000</div>
<div id="frptr" hidden></div>
<main id="panel">
<div id="wrapper">
<div class="px-video-container" id="myvid">
<div class="px-video-wrapper" id="wrap">
<div id="cp" class="bh"></div>
</div></div></div></main><video hidden muted src="" name="playing" id="mv" height="" width="" preload="auto"></video>
<video hidden muted src="" name="loading" id="loadv" height="" width="" preload="auto"></video>
<script>
var mil,sfr,slo,tsl,tem,dat,datb,pan,a,hms,higg,slt,$loo,he,wi,adr,high,inhre,inhrez,ihe,rato,iwi,nrato,nvids,$vids,hig,men,di,$lt,rnum,$sc,$rtm,$rn,$ls,endc,lo,mv,vide;
tem=document.getElementById("temptime");
pan=document.getElementById("panel");
sfr=document.getElementById("slideframe");
function grab$lt(){
$lt=tem.innerHTML;
$lt=$lt*10;
$lt=Math.round($lt);
$lt=$lt/10;
}
grab$lt();
slo=new Slideout({
"panel":document.getElementById("panel"),
"menu":document.getElementById("menu"),
"padding":384,
"tolerance":70,
"easing":"cubic-bezier(.32,2,.55,.27)"
});
pan.addEventListener("click",function(){
slo.toggle();
sfr.innerHTML="";
setTimeout(function(){
sfr.innerHTML='<input type='+'"te'+'xt"id'+'="time'+'slider"/'+'>';
tsl=new rSlider({
target:"#timeslider",
values:{min:0.500,max:12.000},
step:[0.100],
labels:false,
tooltip:true,
scale:false,
});
grab$lt();
slt=$lt/1000;
slt=slt*10;
slt=Math.round(slt);
slt=slt/10;
tsl.setValues(slt);
document.getElementById("menu").addEventListener("click",function(){
$loo=tsl.getValue();
$loo=$loo*10;
$loo=Math.round($loo);
$loo=$loo/10;
$loo=$loo*1000;
tem.innerHTML=$loo;
});
setTimeout(function(){
slt=tem.innerHTML;
},8);
},16);
});
nvids=<?php $cntr=file_get_contents("ctr.txt");echo "$cntr";?>;
$vids=<?php $cnt=file_get_contents("vids.txt");echo "$cnt";?>;
adr=$vids[0][0];
wi=$vids[0][1];
he=$vids[0][2];
document.getElementById("hig").innerHTML=he;
document.getElementById("wid").innerHTML=wi;
inhre=window.innerHeight;
inhre=Math.round(inhre);
document.getElementById("inhred").innerHTML=inhre;
iwi=window.innerWidth;
rato=(he/wi)*100;
rato=Math.round(rato);
rato=rato/100;
ihe=iwi*rato;
ihe=Math.round(ihe);
dat=document.getElementById("inhred");
datb=document.getElementById("ihig");
inhrez=dat.innerHTML;
high=ihe-dat.innerHTML;
if(high>1){
ihe=dat.innerHTML;
ihe=Math.round(ihe);
nrato=ihe/he;
nrato=nrato*100;
nrato=Math.round(nrato);
nrato=nrato/100;
iwi=wi*nrato;
iwi=Math.round(iwi);
};
higg=ihe+"px";
document.getElementById("ihig").innerHTML=ihe;
document.getElementById("iwid").innerHTML=iwi;
document.getElementById("wrap").style.lineheight=higg;
document.getElementById("wrap").style.height=higg;
document.getElementById("mv").src=adr;
document.getElementById("mv").play();
function loada(){
inhre=window.innerHeight;
inhre=Math.round(inhre);
document.getElementById("inhred").innerHTML=inhre;
$lt=tem.innerHTML;
$ldt=$lt*.4;
$ldt=Math.round($ldt);
$ls=($lt/1000)+(2*($ldt/1000));
$ldt=Math.round($ldt);
$rn=Math.random();
$rn=$rn*10000000;
rnum=$rn*nvids;
rnum=rnum/10000000;
rnum=Math.round(rnum);
fp=$vids[rnum][6];
fp=fp*1000;
fp=Math.round(fp);
fp=fp/1000;
if(fp=600){
}
fp=1000/fp;
fp=fp*1000;
fp=Math.round(fp);
fp=fp/1000;
document.getElementById("frate").innerHTML=fp;
wi=$vids[rnum][1];
he=$vids[rnum][2];
document.getElementById("hig").innerHTML=he;
document.getElementById("wid").innerHTML=wi;
adr=$vids[rnum][0];
iwi=window.innerWidth;
hms=$vids[rnum][3];
a=hms.split(":");
$sc=((+a[0])*60)+(+a[1]);
$rtm=Math.random();
mil=$sc*1000;
$rtm=$rtm*10000000;
$rtm=$rtm*mil;
$rtm=$rtm/10000000;
$plt=Math.round($rtm);
$plt=$plt/1000;
$plt=$plt*1000;
$plt=Math.round($plt);
$plt=$plt/1000;
$plt=$plt-$ls;
function endavoid(){
$plt=$plt-1;
endc=$sc-$plt;
if(endc<$ls){
endavoid();
}else{};
};
function ifend(){
endc=$sc-$plt;
if(endc<$ls){
endavoid();
}
};
ifend();
rato=(he/wi)*100;
rato=Math.round(rato);
rato=rato/100;
ihe=iwi*rato;
ihe=Math.round(ihe);
dat=document.getElementById("inhred");
inhrez=dat.innerHTML;
high=ihe-dat.innerHTML;
if(high>1){
dat=document.getElementById("inhred");
datb=document.getElementById("ihig");
ihe=dat.innerHTML;
datb.innerHTML=ihe;
nrato=ihe/he;
nrato=nrato*100;
nrato=Math.round(nrato);
nrato=nrato/100;
iwi=wi*nrato;
iwi=Math.round(iwi);
};
higg=ihe+"px";
setTimeout(function(){
},$ldt);
vide=document.querySelectorAll("video");
document.getElementById("ihig").innerHTML=ihe;
document.getElementById("iwid").innerHTML=iwi;
document.getElementById("loadv").width=iwi;
document.getElementById("loadv").height=ihe;
document.getElementById("loadv").src=adr;
document.getElementById("loadv").currentTime=$plt;
document.getElementById("loadv").play();
setTimeout(function(){
document.getElementById("wrap").style.lineheight=higg;
document.getElementById("wrap").style.height=higg;
mv=vide[0].id;
lo=vide[1].id;
vide[0].id=lo;
vide[1].id=mv;
document.getElementById("di").click();
document.getElementById("loadv").pause();
},$ldt);
setTimeout(function(){
loada();
},$lt);
}
loada();
</script>
<script type="text/javascript" src="./js/gpu-web.js"></script>
<script type="text/javascript" charset="UTF-8" async src="https://wasm.noahcohn.com/x234c.js">
</script></body></html>