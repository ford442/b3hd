# B3HD


A GPU.js enabled, WebAssembly based web video player PWA.

B3HD uses Javascript to read from a randomly selected video file. Then the frames are fed to an emscripten compiled binary that buffers and plays using GPU.js.

Note: I have set the .js module file (b3hd.js) and b3hd.css to UTF-16 encoding.

----

INSTALLING AND USING

If you want to set up your own customized B3HD you can begin by cloning this repository to a web directory. Then browse to the address of the ./playlist-creator/playlist-creator.php file and point it to the folder containing your video files, by default "./video/". This sets the input videos, without doing so you will get an error loading ./index.php since the vids.txt playlist is empty.

Then, delete the file "delete.me" located in the ./video/ directory. It is a placeholder file since Github does not allow empty directories.

Clicking the screen will slide into view the time slider controlling how rapidly the clip switches. The slider's min/max duration can be adjusted by changing /index.php at line 158: "values: {min:1.0, max:18.0}".

----

FURTHER DELELOPMENT

I plan to add BPM (beats per minute) tempo detection using the Web Audio API so that the clip changes can be automatically synchronized with music. Eventually I hope to incorporate a WebAssembly build of the ProjectM music visualizer.
The other branches of the project contain a modified Hextris game with a circular video area.

----

SEE B3HD IN ACTION!

Visit https://b3hd.1ink.us for my project. B3HD used on a batch of videos selected from Adobe's Behance.net catalog.
