# subs
Edit subtitle timing (.srt)

Assumes you have a (correctly formatted) .srt-file in parent directory.

"index.php" uses GET-variables to edit subtitles:

- i: the offset-change you'd like to make to the subtitle item count
- d: the offset-change to the timing of all individual subs

EXAMPLE
-------

Original:

    1
    00:01:57,534 --> 00:01:58,740
    Uit de weg, verdomme!

    2
    00:02:21,174 --> 00:02:22,460
    Daar zijn ze.

"index.php/?i=3?d=1,1":

    4
    00:01:57,534 --> 00:01:58,743
    Uit de weg, verdomme!

    5
    00:02:21,174 --> 00:02:22,463
    Daar zijn ze.
    
"index.php/?i=-5&d=-3,926":

    -4
    00:01:53,608 --> 00:01:54,809
    Uit de weg, verdomme!

    -3
    00:02:17,248 --> 00:02:18,529
    Daar zijn ze.
