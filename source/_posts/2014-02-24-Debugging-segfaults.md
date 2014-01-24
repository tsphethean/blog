---
layout: post
title: Debugging apache segfaults
date: '2014-01-24'
description:
categories:
tags: [Development, Apache, Devops]
---

A recent post on [groups.drupal.org asked for help debugging segfaults](https://groups.drupal.org/node/400253). We had
some fun with this a while ago, and so I've dug up the notes taken then to enable the analysis of the segfault
 and eventual root cause analysis. It's a quick cut and paste so far, to get it up quickly, so I'll try and refine this later.

<!-- break -->

#### Enable core dumps for Apache

In your httpd.conf:

    CoreDumpDirectory /var/crash/apache

Make sure that this is a separate partition - if there are lots of segfaults, the partition can get filled up.

    mkdir -p /var/crash/apache
    chown apache.apache /var/crash/apache
    chmod 0770 /var/crash/apache

In /etc/sysconfig/init, add:

    DAEMON_COREFILE_LIMIT='unlimited'

In /etc/security/limits.conf before any other limits:

    apache - core unlimited

And restart apache.

Note: On one machine, I simply could not get it to dump cores using the above instructions.
Doing

    cat /proc/<pid of httpd>/limits

showed that the ulimit was still set to 0, and try as I might, I couldn't get it to be different. In this case, I added a simple ulimit -c unlimited before the daemon start line in /etc/init.d/httpd.
I suspect a reboot would have sorted things, but this wasn't possible, so I was unable to confirm.

#### Install httpd-debuginfo and gdb

    yum --enablerepo=rhel-debuginfo install httpd-debuginfo gdb

#### Test that cores are dumped

To test that apache will put a dump a core, run:

    kill -SEGV <pid of apache child process>

#### Wait for a segfault

When a segfault occurs, check that it has dumped a core, and that the size is reasonable. Then:

    gdb /usr/sbin/httpd /path/to/coredump
    bt

#### Debugging

To get a more helpful trace, follow these instructions:

1. go get yourself a .gdbinit file - from here - (make sure you get the right version!) : [https://raw.github.com/php/php-src/PHP-5.3/.gdbinit](https://raw.github.com/php/php-src/PHP-5.3/.gdbinit)
2. Copy this into your home directory on the box in question eg. ~/.gdbinit
3. fire up gdb


        gdb /usr/sbin/httpd  /path/to/core_dump


1. ask it to analyse the core dump:

        (gdb) bt
        [...backtrace...]

        (gdb) source ~/.gdbinit
        (gdb) dump_bt executor_globals.current_execute_data
        