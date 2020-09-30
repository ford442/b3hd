# b3hd


A GPU.js enabled, WASM based web video player PWA.

B3HD uses GPU.js to read from a randomly selected video file. Then the frames are fed to an emscripten compiled WebAssembly binary that buffers and plays using GPU.js.


INSTALLING AND USING

If you want to set up your own customized B3HD you can begin by uploading all of the files in the git repository to a web directory. Then browse to the address of the /b3hd/playlist-creator/playlist-creator.php file and point it to the folder containing your video files, by default "/b3hd/video/". This sets the input videos, without doing so you will get an error loading /b3hd/index.php.

You can replace the default intro graphics simply by replacing the intro.mp4 with another video named intro.mp4.

Clicking the screen will slide into view the time slider controlling how rapidly the clip switches. The slider's min/max duration can be adjusted by changing /index.php at line 158: "values: {min:.8, max:8.0}".


FURTHER DELELOPMENT

I plan to add BPM (beats per minute) tempo detection using the Web Audio API so that the clip changes can be automatically synchronized with music. Eventually I hope to incorporate a WebAssembly build of the ProjectM music visualizer.


SEE B3HD IN ACTION!

Visit https://b3hd.1ink.us for my project. A batch of videos selected from Adobe's Behance.net catalog.
