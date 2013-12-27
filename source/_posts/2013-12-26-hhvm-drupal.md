---
layout: post
title: Drupal and HHVM
date: '2013-12-26'
description: An initial play with Drupal on HHVM
categories:
tags: [Development, Drupal, HHVM]

summary: "An initial play with Drupal on HHVM"
---

The HipHop Virtual Machine team recently issued a [blog post](http://www.hhvm.com/blog/2813/we-are-the-98-5-and-the-16)
of the results of a 3 week
lockdown focusing on making HHVM more compatible with popular open source PHP projects,
and improving performance across the board. As part of this, it was stated that compatibility with Drupal (7 and 8)
was at 100%. I decided to have a play at getting HHVM up and running with Drupal and doing some initial performance
investigations.

### Setting up the VM

From a quick search, I came across an article from last year, where [Nick Veenhof installed HHVM but found some
problems with PDO compatibility](http://nickveenhof.be/blog/getting-drupal-7-almost-running-hhvm). Using this as a starting
point I got HHVM up and running with the following steps:

1. Using the original article as a base, I went the Virtual Machine route too. Fortunately I already use Vagrant and VirtualBox
in my day-to-day work, so had those tools available, but if you don't then you'll need to install them:
  * [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
  * [Vagrant](http://vagrantup.com/)
1. I then used the [Drupal Vagrant Project](https://drupal.org/project/vagrant) for my base VM (and borrowed a lot of steps from Nick!):
<script src="https://gist.github.com/tsphethean/8138503.js"></script>
I had to run vagrant provision a couple of times to get everything to install correctly - possibly some dependency issues in the
Vagrant project, but it seemed to work itself out.

### Installing HHVM

I initially tried installing the pre-built [HHVM package for Ubuntu 12.04](https://github.com/facebook/hhvm/wiki/Prebuilt-Packages-on-Ubuntu-12.04), but got errors about incompatible versions of
packages, so in the end I followed the instructions for building and installing HHVM and its dependencies.

The docs on the HHVM wiki worked perfectly, so although it took a little while and looks a little long winded I was able
to follow each step, ending with building HipHop.

[Building and installing HHVM on Ubuntu 12.04](https://github.com/facebook/hhvm/wiki/Building-and-installing-HHVM-on-Ubuntu-12.04)

### Configuring HHVM for Drupal

Once installed, I looked at a few examples of HHVM config files to get the server up and running and serving Drupal
correctly. The main tricky bit was the rewrite rules for clean URLs. Saving the code below into */etc/hhvm.hdf*

<script src="https://gist.github.com/tsphethean/8138831.js"></script>

Running HHVM was then a case of running the following command:

    sudo hphp/hhvm/hhvm --config /etc/hhvm.hdf --user vagrant --mode daemon -v "Log.Level=Verbose"-v "Log.NoSilencer=on"-v "Log.Header=on"

and then keeping an eye on the logs:

    tail -f /var/log/hhvm/error.log


Once that was done, I could access *http://drupal.vbox.local:8000* in my browser and access my Drupal site as normal.


### Initial performance view

In no way have I done a full performance analysis yet, as I ran out of time for the day, but I did do some very quick
analysis for a rough feel of the performance benefits of HHVM. The advantage of the setup above is that with Apache running
on the Vagrant box as well, you can access the same site over HHVM (port 8000) and Apache (port 80) to compare.

I enabled Devel and enabled the "Page timer" and "Memory usage" display, and tried out a couple of sample URLs:

| Test | Apache time | HHVM time | Apache memory | HHVM memory |
------|-----------------|-----------|-----------|----------|
| Homepage | 346 ms | 105 ms | 6.75MB | 0.82 MB |
| Node with 6 comments | 378 ms | 136 ms | 7.82 MB | 1.15 MB |

The initial results are quite encouraging, with page execution time reduced by about 70% and memory usage about 7 times lower
under HHVM.

My next plans are to do some more in depth profiling of HHVM and use ApacheBench to get some more representative
high volume statistics and will write those up in future posts.

Hopefully this post will get others up and running with HHVM and Drupal too - it certainly seems worth a look!
