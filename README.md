Cyprusnewspapers
================
The objective of this project is to obtain the daily frontpages of Cypriot newspapers and display them on a website. It is developing an easier "quicker" way to read papers and navigate news and news headlines. Most papers contain the majority of their news headlines on the "FRONT PAGE"!

It began with Cypriot papers, then expanded to frontpages of Cypriot magazines. The idea could eventually extend to websites, books, shopping/supermarket catalogues etc.

FRONTpage images of Newspapers:
===============================
A cron job "scrapescript.php" scrapes the major front page newspapers/magazines images multiple times daily.
This is currently running as we speak and images are stored in:

http://www.cyprusnewspapers.eu/images/cyprusnewspapers/big

For the large images and:

http://www.cyprusnewspapers.eu/images/cyprusnewspapers/small

For the small/thumbnail images

I assume a similar kind of concept shall work for the cached "webpage" images. (see below FRONTpage of Websites)

At the moment the scraping and displaying of the papers is done in .php
I have a website established in Joomla at the moment which I prepared more for a sample/demo "proof of concept" 
It can be found at: 
http://www.cyprusnewspapers.eu

FRONTpage of Websites:
======================
The idea is to cache in some way Cypriot news websites ("frontpage of websites") so a user can scroll through (like in a carousel style) which news websites they would like to read / navigate to by previewing the daily cached image prior to visiting the site. By Clicking on the cached image a new tab shall open to the news webpage. The idea is based on Googles discontinued lab "Fast Flip" http://en.wikipedia.org/wiki/Google_Fast_Flip

Newspaper Subscribers:
=======================
For the time being I have been scraping the frontpage newspapers. I want to add the ability for the newspaper companies to add their front pages themselves. This will enable me to include local newspapers that are not easily available.
Newspapers will need to become memebers (joining/signing up). They then shall then be able to drop and drag (or via NTFS file structure) their FRONTpage to a folder 
http://www.cyprusnewspapers.eu/images/cyprusnewspapers/small/"dd_mm_yy"  for the small images and
http://www.cyprusnewspapers.eu/images/cyprusnewspapers/big/"dd_mm_yy"    for the large images
 
Upon the next scrape their news Frontpage will be displayed.

From the Beginning:
===================
I want to create this site from scratch now that I have established the proof of concept and in order to learn/practise what I have learnt from Codeacademy (html5, jquery, javascript, php) This will allow me to add cool features and make the site look neat and revolutionary. 

I urge others to collaborate and add their ideas, design, functionality 
Download the Zip. It contains the:
--simplehtmldom
--index.html file
--styles.css
--scrapescript.php file (which is already being run daily)
--lib/cyprusimageslib file (which is the call to display the newspapers on the page)

All Help / ideas are  very welcomed!
