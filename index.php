<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="cleartype" content="on">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<script src="./js/slideout.min.js"></script>
<script type="text/javascript" src="./js/rSlider.min.js"></script>
<style>
::-webkit-scrollbar {
 display: none;
}
.bh{
text-align: center;
display: inline-block;
overflow: hidden;
/* width: 100%;*/
}
#canvas {
 }
#wrap {
 padding-bottom: 0;
 position: absolute;
 top: 50%;
 left: 50%;
 -moz-transform: translateX(-50%) translateY(-50%);
 -webkit-transform: translateX(-50%) translateY(-50%);
 transform: translateX(-50%) translateY(-50%);
}
#wrapper {
 font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}
body {
 background-color: black;
 overflow-x: hidden;
 overflow-y: scroll;
 width: 100%;
 height: 100%;
}
#brand a,
p a {
 border: 0px #fff dotted;
 }
#brand a:focus,
p a:focus {
outline: none;
 }
p {
 padding-top: 0em;
}
.px-video {
 position: absolute;
 top: 0;
 left: 0;
 margin-top: 0;
 width: 100%;
 height: 100%;
}
.px-video-container {
 overflow: hidden;
  width: 100%;
  height: 100%;
}
.px-video-wrapper {
 position: relative;
 padding-bottom: 56%;
 height: 0;
 z-index: 1;
}
.slideout-menu {
 position: fixed;
 left: 0;
 top: 0;
 bottom: 0;
 right: 0;
 z-index: 0;
 width: 384px;
 overflow-y: scroll;
 -webkit-overflow-scrolling: touch;
 display: none;
 }
.slideout-menu-left {
 left: 0;
}
.slideout-menu-right {
 right: 0;
}
.slideout-panel {
 position: relative;
 z-index: 1;
 will-change: transform;
 background-color: black;
 min-height: 100vh;
}
.slideout-open,
.slideout-open body,
.slideout-open .slideout-panel {
 overflow: hidden;
}
.slideout-open .slideout-menu {
 display: block;
}
</style><link rel="stylesheet" href="./css/rSlider.min.css"></head>
<body>
<nav id="menu">
<section class="menu-section" id="menu-sections">
<h2>Temporal Time:</h2>
<ul class="menu-section-list">
<div style="width: 384px;text color: white;">
<div id="slideframe"><input type="text" id="timeslider" />
</div>
</div>
</ul>
</section>
</nav>
<input type="checkbox" id="di" hidden="true" />
<div id="iwid" hidden></div>
<div id="ihig" hidden></div>
<div id="wid" hidden></div>
<div id="hig" hidden></div>
<div id="frate" hidden></div>
<div id="temptime" hidden>4000</div>
<div id="frptr" hidden></div>
<main id="panel">
<div id="wrapper">
<div class="px-video-container" id="myvid">
<div class="px-video-wrapper" id="wrap">
<video hidden muted src="" name="playing" id="myvideo" height="" width="" preload="meta"></video>
<video hidden muted src="" name="loading" id="loadvid" height="" width="" preload="auto"></video>
<div id="canvas-parent" class="bh"></div>
</div></div></div></main>

<script>
var millisec, sidefram, slideout, timeslider, tem, pan, a, hms, higg, slitime, loopti, he, wi, adr, high, inhre, ihe, rato, iwi, nrato, nvids, myvids, hig, men, di, looptime, rnum, seconds, rndtime, random, loopsecs, endc, loopti, lo, mv, vide;
tem = document.getElementById("temptime");
pan = document.getElementById("panel");
sidefram = document.getElementById("slideframe");
function grablooptime () {
looptime = tem.innerHTML;
looptime = (looptime * 10);
looptime = Math.round(looptime);
looptime = (looptime / 10);
}
grablooptime();
slideout = new Slideout({
"panel": document.getElementById("panel"),
"menu": document.getElementById("menu"),
"padding": 384,
"tolerance": 70,
"easing": "cubic-bezier(.32,2,.55,.27)"
});
pan.addEventListener("click", function() {
slideout.toggle();
sidefram.innerHTML = "";
setTimeout( function () {
sidefram.innerHTML = '<input type=' + '"te' + 'xt" id' + '="time' + 'slider" /' + '>';
timeslider = new rSlider({
target: "#timeslider",
values: {min:.8, max:8.0},
step: [0.1],
labels: false,
tooltip: true,
scale: false,
});
grablooptime();
slitime = (looptime / 1000);
slitime = (slitime * 10);
slitime = Math.round(slitime);
slitime = (slitime / 10);
timeslider.setValues(slitime);
document.getElementById("menu").addEventListener("click", function() {
loopti = timeslider.getValue();
loopti = (loopti * 10);
loopti = Math.round(loopti);
loopti = (loopti / 10);
loopti = (loopti * 1000);
tem.innerHTML = loopti;
});
setTimeout( function() {
slitime = tem.innerHTML;
}, 8);
}, 16);
});
nvids = <?php $cntr = file_get_contents("ctr.txt");echo "$cntr";?>;
myvids = <?php $cnt = file_get_contents("vids.txt");echo "$cnt";?>;
adr = myvids[0][0];
wi = myvids[0][1];
he = myvids[0][2];
document.getElementById("hig").innerHTML = he;
document.getElementById("wid").innerHTML = wi;
iwi = window.innerWidth;
rato = ((he / wi) * 10);
rato = Math.round(rato);
rato = (rato / 10);
ihe = (iwi * rato);
ihe = Math.round(ihe);
inrhe = (iwi * 0.56);
high = (ihe - inrhe);
if (high > 1) {
ihe = inrhe;
ihe = Math.round(ihe);
nrato = (ihe / he);
nrato = (nrato * 10);
nrato = Math.round(nrato);
nrato = (nrato / 10);
iwi = (wi * nrato);
iwi = Math.round(iwi);
};
higg = (ihe + "px");
document.getElementById("ihig").innerHTML = ihe;
document.getElementById("iwid").innerHTML = iwi; 
document.getElementById("wrap").style.lineheight = higg;
document.getElementById("wrap").style.height = higg;
document.getElementById("myvideo").src = adr;
document.getElementById("myvideo").width = iwi;
document.getElementById("myvideo").height = ihe;
document.getElementById("myvideo").play();
function loada() {
looptime = tem.innerHTML;
loadtime = (looptime * .9);
loopsecs = (looptime / 1000) + ( 2 * (loadtime / 1000));
loadtime = Math.round(loadtime);
random = Math.random();
random = (random * 10000000);
rnum = (random * nvids);
rnum = (rnum / 10000000);
rnum = Math.round(rnum);
fp = myvids[rnum][6];
fp = (fp * 100);
fp = Math.round(fp);
fp = (fp / 100);
if (fp = 600) {
fp = 60;
}
fp = (fp * 3);
fp = (1000 / fp);
fp = (fp * 1000);
fp = Math.round(fp);
fp = (fp / 1000);
document.getElementById("frate").innerHTML = fp;
wi = myvids[rnum][1];
he = myvids[rnum][2];
document.getElementById("hig").innerHTML = he;
document.getElementById("wid").innerHTML = wi;
adr = myvids[rnum][0];
iwi = window.innerWidth;
hms = myvids[rnum][3];
a = hms.split(":");
seconds = ((+a[0]) * 60) + (+a[1]);
rndtime = (Math.random());
millisec = (seconds * 1000);
rndtime = (rndtime * 1000000);
rndtime = (rndtime * millisec);
rndtime = (rndtime / 1000000);
pltime = Math.round(rndtime);
pltime = (pltime / 1000);
pltime = (pltime * 1000);
pltime = Math.round(pltime);
pltime = (pltime / 1000);
// pltime = (pltime - loopsecs);
function endavoid() {
pltime = (pltime - .5);
endc = (seconds - pltime);
if (endc < loopsecs) {
endavoid();
} else {};
};
function ifend() {
endc = (seconds - pltime);
if (endc < loopsecs) {
endavoid();
}
};
ifend();
rato = ((he / wi) * 10);
rato = Math.round(rato);
rato = (rato / 10);
ihe = (iwi * rato);
ihe = Math.round(ihe);
inrhe = (iwi * 0.56);
high = (ihe - inrhe);
if (high > 1) {
ihe = inrhe;
ihe = Math.round(ihe);
nrato = (ihe / he);
nrato = (nrato * 10);
nrato = Math.round(nrato);
nrato = (nrato / 10);
iwi = (wi * nrato);
iwi = Math.round(iwi);
};
higg = (ihe + "px");
document.getElementById("ihig").innerHTML = ihe;
document.getElementById("iwid").innerHTML = iwi;
document.getElementById("loadvid").src = adr;
document.getElementById("loadvid").width = iwi;
document.getElementById("loadvid").height = ihe;
document.getElementById("loadvid").currentTime = pltime;
document.getElementById("loadvid").play();
setTimeout(function () {
}, loadtime);
setTimeout(function () {
vide = document.querySelectorAll("video");
mv = vide[0].id;lo = vide[1].id;
vide[0].id = lo;vide[1].id = mv;
document.getElementById("wrap").style.lineheight = higg;
document.getElementById("wrap").style.height = higg;
document.getElementById("di").click();
}, loadtime);
setTimeout(function () {
loada();
}, looptime);
}
loada();
</script>
<script src="./js/gpu-web.js"></script>
<script async src="./js/b3hd.js"></script>
</body></html>
