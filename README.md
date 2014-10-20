yiibook-cms-ch22
================

This is the CMS (blog) example from Chapter 22 of "The Yii Book" (the first edition). This code is for Yii 1.

The book itself explains the code in detail. You can buy the book at [http://yii.larryullman.com](http://yii.larryullman.com). But this code is being made freely available.

## Installing

You can find the SQL needed to create and populate the database in the **protected/data/ch22.sql** file. The password for all user accounts is "password".

You'll need to run `composer install` from within the **protected** directory to install the ElasticSearch library. This means you'll also need to have [Composer](https://getcomposer.org/) installed and have [ElasticSearch](http://www.elasticsearch.org/) installed and running. See Chapter 20 of the book for details on using ElasticSearch.

## What's Missing

This is not an absolutely complete example, but it's much more complete than any other in the book. There are multitude ways that you, or I, or any other developer could change this example, flesh it out, tweak it, optimize it, etc. My goal in creating it was not to make it perfect. The goal was to create a *mostly-complete* example, which I've done. The larger goal, within the context of the book, is to explain how complete projects are developed. Again, the book goes into all of this in detail.

But, before anyone says anything, just a few things I'd probably do or add include:

* Create a synopsis of a page ability (for SEO and excerpts)
* Make comments approvable
* Write page details to meta tags in the HTML
* Add a file upload for HTML editor
* Ajax-ify more things
* Add caching
* Add edit links to the public pages (if logged in)
* Complete the user management (ability to change password, admin ability to change user's type)

Also, there's a minor issue with the styling of the pagination links on the home page and form errors not being styled properly, but...c'est la vie. If these things bother you, I encourage you to fix them! (Yes, obviously, for a real site, I'd fix them, but this isn't a real site.)

## Problems, Questions, and Help?

I will not be providing technical support for this code through GitHub. If there are unequivocal problems with the code itself (not your attempt to make use of it), please file an issue. I'll fix the code if warranted, but do not expect a reply. As a practical matter, I can only provide technical support through my existing [support forums](http://www.larryullman.com/forums/index.php?/forum/32-the-yii-book/).

## The book, Yii 2, and the Future

This is the penultimate chapter that I have to write, the other being Chapter 23, which is an e-commerce example. Chapter 24 is done. Next I'm going to do the code for Chapter 23 and release it. Then I'll write up the chapters and publish the final version of the first edition of the book. Then I start working on the second edition, for Yii 2.

This code will be updated for Yii 2, for the second edition of "The Yii Book", and will be posted in a new repository (actually, it'll be made into an installable application via Composer).

## What's with the Commits?

Okay, so the commit history on this isn't pretty. My goal was to track, broadly, the steps I took to develop the project from scratch. The end result is commits that are way too big and occasionally not focused enough. So don't treat this commit history as a good model of using Git!