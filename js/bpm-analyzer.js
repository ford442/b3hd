'use strict';
const analyzer = {};
analyzer.getLowPassSource = function (buffer, OfflineContext) {
const { length, numberOfChannels, sampleRate } = buffer;
const context = new OfflineContext(numberOfChannels, length, sampleRate);
const source = context.createBufferSource();
source.buffer = buffer;
const filter = context.createBiquadFilter();
filter.type = 'lowpass';
source.connect(filter);
filter.connect(context.destination);
return source;
};
analyzer.findPeaksAtThresold = function (data, thresold, offset = 0, callback) {
let peaks = [];
for (var i = offset, l = data.length; i < l; i += 1) {
if (data[i] > thresold) {
peaks.push(i);
i += 10000;
}
}
if (peaks.length == 0) {
peaks = undefined;
}
return callback && callback(peaks, thresold) || peaks;
};
analyzer.computeBPM = function (data, sampleRate, callback) {
const minPeaks = 15;
let peaksFound = false;
utils.loopOnThresolds((object, thresold, stop) => {
if (peaksFound) return stop(true);
if (data[thresold].length > minPeaks) {
peaksFound = true;
return callback(null, [
analyzer.identifyIntervals,
analyzer.groupByTempo(sampleRate),
analyzer.getTopCandidates
].reduce(
(state, fn) => fn(state),
data[thresold]
), thresold);
}
}, () => {
return !peaksFound && callback(new Error('Could not find enough samples for a reliable detection.')) || false;
});
};
analyzer.getTopCandidates = function (candidates) {
return candidates.sort((a, b) => (b.count - a.count)).splice(0, 5);
};
analyzer.identifyIntervals = function (peaks) {
const intervals = [];
peaks.forEach((peak, index) => {
for (let i = 0; i < 10; i += 1) {
let interval = peaks[index + i] - peak;
let foundInterval = intervals.some(intervalCount => {
if (intervalCount.interval === interval) {
intervalCount.count += 1;
return intervalCount.count;
}
});
if (!foundInterval) {
intervals.push({
interval: interval,
count: 1
});
}
}
});
return intervals;
};
analyzer.groupByTempo = function (sampleRate) {
return (intervalCounts) => {
const tempoCounts = [];
intervalCounts.forEach(intervalCount => {
if (intervalCount.interval !== 0) {
intervalCount.interval = Math.abs(intervalCount.interval);
let theoreticalTempo = (60 / (intervalCount.interval / sampleRate));
while (theoreticalTempo < 90) {
theoreticalTempo *= 2;
}
while (theoreticalTempo > 180) theoreticalTempo /= 2;
theoreticalTempo = Math.round(theoreticalTempo);
let foundTempo = tempoCounts.some(tempoCount => {
if (tempoCount.tempo === theoreticalTempo) {
tempoCount.count += intervalCount.count;
return tempoCount.count;
}
});
if (!foundTempo) {
tempoCounts.push({
tempo: theoreticalTempo,
count: intervalCount.count
});
}
}
});
return tempoCounts;
};
};
