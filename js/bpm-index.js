'use strict';
class RealTimeBPMAnalyzer {
constructor (config = {}) {
this.options = {
element: null,
scriptNode: {
bufferSize: 4096,
numberOfInputChannels: 1,
numberOfOutputChannels: 1
},
continuousAnalysis: false,
stabilizedBpmCount: 2000,
computeBPMDelay: 10000,
stabilizationTime: 20000,
pushTime: 2000,
pushCallback: (err, bpm) => {
if (err) {
throw new Error(err);
}
},
onBpmStabilized: (thresold) => {
this.clearValidPeaks(thresold);
},
webAudioAPI: {
OfflineAudioContext: typeof window == 'object' && (window.OfflineAudioContext || window.webkitOfflineAudioContext)
}
};
Object.assign(this.options, config);
this.initClass();
}
initClass () {
this.minValidThresold = 0.30;
this.cumulatedPushTime = 0;
this.waitPushTime = null;
this.waitStabilization = null;
this.validPeaks = utils.generateObjectModel([]);
this.nextIndexPeaks = utils.generateObjectModel(0);
this.chunkCoeff = 1;
}
clearValidPeaks (minThresold) {
console.log('[clearValidPeaks] function: under', minThresold);
this.minValidThresold = minThresold.toFixed(2);
utils.loopOnThresolds((object, thresold) => {
if (thresold < minThresold) {
delete this.validPeaks[thresold];
delete this.nextIndexPeaks[thresold];
}
});
}
analyze (event) {
const currentMaxIndex = this.options.scriptNode.bufferSize * this.chunkCoeff;
const currentMinIndex = currentMaxIndex - this.options.scriptNode.bufferSize;
const source = analyzer.getLowPassSource(event.inputBuffer, this.options.webAudioAPI.OfflineAudioContext);
source.start(0);
utils.loopOnThresolds((object, thresold) => {
if (this.nextIndexPeaks[thresold] < currentMaxIndex) {
const offsetForNextPeak = this.nextIndexPeaks[thresold] % 4096;
analyzer.findPeaksAtThresold(source.buffer.getChannelData(0), thresold, offsetForNextPeak, (peaks, atThresold) => {
if (typeof (peaks) != 'undefined' && peaks != undefined) {
Object.keys(peaks).forEach((key) => {
const relativeChunkPeak = peaks[key];
if (typeof (relativeChunkPeak) != 'undefined') {
this.nextIndexPeaks[atThresold] = currentMinIndex + relativeChunkPeak + 10000;
this.validPeaks[atThresold].push(currentMinIndex + relativeChunkPeak);
}
});
}
});
}
}, this.minValidThresold, () => {
if (this.waitPushTime === null) {
this.waitPushTime = setTimeout(() => {
this.cumulatedPushTime += this.options.pushTime;
this.waitPushTime = null;
analyzer.computeBPM(this.validPeaks, event.inputBuffer.sampleRate, (err, bpm, thresold) => {
this.options.pushCallback(err, bpm, thresold);
if (!err && bpm) {
if (bpm[0].count >= this.options.stabilizedBpmCount) {
console.log('[freezePushBack]');
this.waitPushTime = 'never';
this.minValidThresold = 1;
}
}
if (this.cumulatedPushTime >= this.options.computeBPMDelay &&
this.minValidThresold < thresold
) {
console.log('[onBpmStabilized] function: Fired !');
this.options.onBpmStabilized(thresold);
if (this.options.continuousAnalysis) {
clearTimeout(this.waitStabilization);
this.waitStabilization = setTimeout(() => {
console.log('[waitStabilization] setTimeout: Fired !');
this.options.computeBPMDelay = 0;
this.initClass();
}, this.options.stabilizationTime);
}
}
});
}, this.options.pushTime);
}
this.chunkCoeff++;
});
}
}
window.RealTimeBPMAnalyzer = RealTimeBPMAnalyzer;
