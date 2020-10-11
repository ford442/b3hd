'use strict';
const utils = {};
utils.loopOnThresolds = function (onLoop, minValidThresold, callback) {
let thresold = 0.95;
if (typeof minValidThresold == 'function' || typeof minValidThresold == 'boolean') {
callback = minValidThresold || callback;
minValidThresold = 0.30;
}
if (typeof minValidThresold == 'undefined') minValidThresold = 0.30;
const minThresold = minValidThresold;
let object = {};
do {
let stop = false;
thresold = thresold - 0.05;
onLoop(object, thresold, function (bool) {
stop = bool;
});
if (stop) break;
} while (thresold > minThresold);
return callback && callback(object);
};
utils.generateObjectModel = function (defaultValue, callback) {
return utils.loopOnThresolds((object, thresold) => {
object[thresold.toString()] = JSON.parse(JSON.stringify(defaultValue));
}, (object) => {
return callback && callback(JSON.parse(JSON.stringify(object))) || object;
});
};
