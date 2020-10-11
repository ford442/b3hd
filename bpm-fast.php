<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="cleartype" content="on">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>B*3*H*D</title>
<script src="./js/slideout.min.js"></script>
<script type="text/javascript" src="./js/rSlider.min.js"></script>
<style>
::-webkit-scrollbar {
 display: none;
}
#canvas {
 }
#wrap {
 padding-top: 0;
 position: absolute;
 top: 50%;
 left: 50%;
 -moz-transform: translateX(-50%) translateY(-50%);
 -webkit-transform: translateX(-50%) translateY(-50%);
 transform: translateX(-50%) translateY(-50%);
}
#wrapper {
}
body {
 background-color: grey;
 overflow-x: hidden;
 overflow-y: scroll;
}
#brand a,
p a {
 border: 0px #fff;
 }
#brand a:focus,
p a:focus {
outline: none;
 }
p {
 padding-top: 0em;
}
.px-video {
 top: 0;
 left: 0;
 margin-top: 0;
}
.px-video-container {
}
.px-video-wrapper {
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
 z-index: 1;
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
<input type="text" id="timeslider" />
Realtime BPM/Tempo Analyzer
<p>
<button class="btn btn-sm btn-primary" id="start">START</button> 
</p>
<audio src="./jm.flac" id="track" preload="auto" controls loop></audio>
<p id="current-bpm"></p>
<h2>Temporal Time:</h2>
<ul class="menu-section-list">
<div style="width: 384px;text color: white;">
<div id="slideframe">
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
<div id="inhred" hidden></div>
<var id="hiv" hidden>0</var>
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
let context;
const start = () => {
return (e) => {
e.currentTarget.setAttribute('disabled', 'disabled');
context = new window.AudioContext() || window.mozAudioContext() || window.webkitAudioContext();
document.getElementById('track').play();
const source = context.createMediaElementSource(document.getElementById('track'));
const scriptProcessorNode = context.createScriptProcessor(4096, 1, 1);
scriptProcessorNode.connect(context.destination);
source.connect(scriptProcessorNode);
source.connect(context.destination);
const onAudioProcess = new RealTimeBPMAnalyzer({
scriptNode: {
bufferSize: 4096,
numberOfInputChannels: 1,
numberOfOutputChannels: 1
},
pushTime: 1000,
pushCallback: function (err, bpm) {
if (err) throw err;
if (typeof bpm[0] != 'undefined') {
var bpsec = bpm[0].tempo;
bpsec = bpsec / 4;
bpsec = bpsec * 100;
bpsec = Math.round(bpsec);
bpsec = bpsec / 100;
bpsec = 60 / bpsec;
// bpsec = bpsec * 1.3333;
// bpsec = bpsec * 0.6;
bpsec = bpsec * 10000;
bpsec = Math.round(bpsec);
bpsec = bpsec / 10000;
bpsec = bpsec * 1000;
bpsec = Math.round(bpsec);
document.getElementById("temptime").innerHTML = bpsec;
}
}
});
scriptProcessorNode.onaudioprocess = function (e) {
onAudioProcess.analyze(e);
};
};
};
const stop = () => {
return () => {
context.resume().then(() => {
document.getElementById('start').removeAttribute('disabled');
});
};
};
document.getElementById('start').addEventListener('click', start());
document.getElementById('track').addEventListener('ended', stop());
var millisec, sidefram, slideout, timeslider, tem, dat, datb, pan, a, hms, higg, slitime, loopti, he, wi, adr, high, inhre, inhrez, ihe, rato, iwi, nrato, nvids, myvids, hig, men, di, looptime, rnum, seconds, rndtime, random, loopsecs, endc, loopti, lo, mv, vide;
tem = document.getElementById("temptime");
pan = document.getElementById("panel");
sidefram = document.getElementById("slideframe");
function grablooptime () {
looptime = tem.innerHTML;
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
sidefram.innerHTML = '<p>---</p><p>---</p><input type=' + '"te' + 'xt" id' + '="time' + 'slider" /' + '>';
timeslider = new rSlider({
target: "#timeslider",
values: {min:1.00, max:18.00},
step: [0.20],
labels: false,
tooltip: true,
scale: false,
});
grablooptime();
slitime = (looptime / 1000);
slitime = Math.round(slitime);
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
inhre = window.innerHeight;
inhre = Math.round(inhre);
document.getElementById("inhred").innerHTML = inhre;
iwi = window.innerWidth;
rato = ((he / wi) * 10);
rato = Math.round(rato);
rato = (rato / 10);
ihe = (iwi * rato);
ihe = Math.round(ihe);
dat = document.getElementById("inhred");
datb = document.getElementById("ihig");
inhrez = dat.innerHTML;
high = (ihe - dat.innerHTML);
if (high > 1) {
ihe = dat.innerHTML;
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
inhre = window.innerHeight;
inhre = Math.round(inhre);
document.getElementById("inhred").innerHTML = inhre;
looptime = tem.innerHTML;
loadtime = (looptime * .45);
loadtime = Math.round(loadtime);
// loopsecs = (looptime / 1000) + ( 2 * (loadtime / 1000));
loopsecs = (looptime * 1.8);
loopsecs = (loopsecs / 1000);
loopsecs = loopsecs * 100;
loopsecs = Math.round(loopsecs);
loopsecs = loopsecs / 100;
loadtime = Math.round(loadtime);
random = Math.random();
random = (random * 10000000);
rnum = (random * nvids);
rnum = (rnum / 10000000);
rnum = Math.round(rnum);
fp = myvids[rnum][6];
fp = (fp * 10000);
fp = Math.round(fp);
fp = (fp / 10000);
if (fp = 600) {
fp = 60;
}
fp = (fp * 3);
fp = (1000 / fp);
fp = (fp * 10000);
fp = Math.round(fp);
fp = (fp / 10000);
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
rndtime = (rndtime * 10000000);
rndtime = (rndtime * millisec);
rndtime = (rndtime / 10000000);
pltime = Math.round(rndtime);
pltime = (pltime / 1000);
pltime = (pltime * 10000);
pltime = Math.round(pltime);
pltime = (pltime / 10000);
// pltime = (pltime - (loadtime / 2000));
function endavoid() {
pltime = (pltime - .42);
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
dat = document.getElementById("inhred");
inhrez = dat.innerHTML;
high = (ihe - dat.innerHTML);
if (high > 1) {
dat = document.getElementById("inhred");
datb = document.getElementById("ihig");
ihe = dat.innerHTML;
datb.innerHTML = ihe;
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
<script type="text/javascript" src="./js/bpm-index.js"></script>
<script type="text/javascript" src="./js/bpm-analyzer.js"></script>
<script type="text/javascript" src="./js/bpm-utils.js"></script>
<script type="text/javascript" src="./js/gpu-web.js"></script>
<script type="text/javascript" async src="./js/b3hd.js"></script>
</body></html>
