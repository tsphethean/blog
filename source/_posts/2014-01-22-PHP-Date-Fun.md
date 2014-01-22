---
layout: post
title: Date fun in PHP
date: '2014-01-22'
description: Fun with date manipulation in PHP.
categories:
tags: [Development, PHP]

---

A project I'm working on at the moment has a requirement to work out subscription
dates for subscriptions of varying length (3, 6 or 12 months). After some "fun"
working around some quirks of PHP date handling (and memories of working through this
 kind of stuff before) I thought it worth writing up, partly
so I've got a reference next time it comes up, but also in case anyone else finds it
useful.

<!-- break -->

The issue comes around adding intervals to dates, in this case a certain number of months.
Previously, I've usually used mktime() and strtotime() for simple date arithmetic. Let's say
we have a 3 month subscription starting on the 1st January:

    $date = mktime(0,0,0,1+3,01,2014);
    echo date('Y-m-d', $date);
    // outputs 2014-04-01

or

    $date = strtotime("01 January 2014 +3 months");
    echo date('Y-m-d', $date);
    // outputs 2014-04-01

Both of these examples will end up with the "correct" answer, where the modified date is
 on the 1st April 2014.

The situation changes however if we're doing a subscription which starts at the end of the month,
 let's say 31st January:

    $date = mktime(0,0,0,1+3,31,2014);
    echo date('Y-m-d', $date);
    // outputs 2014-05-01

or

    $date = strtotime("31 January 2014 +3 months");
    echo date('Y-m-d', $date);
    // outputs 2014-05-01

In both cases, because April is only 30 days long, PHP works out the answer as being 1st May. However,
for the scenario I was looking at the subscription was defined as ending on either same date in the month
it was created, or the last day of the month, whichever was shortest (so in the exmaple above, the
expected output would be 30th April 2014. This is quite common in billing/subscription models.

So how to solve it? Well through my diggiing I was reminded of the PHP DateTime class which was added in PHP 5.3
and makes working with dates a bit nicer. So for the above examples we could do:

    $date = new DateTime('2014-01-31');
    $interval = new DateInterval('P3M');
    $date->add($interval);
    echo $date->format('Y-m-d');
    // Still outputs 2014-05-01

No joy here. The trick is that we need to check whether the difference in month values after manipulation
matches what would happen if we did simple adding of the desired number of months to the original date -
and then if it differs, wind back the date to the previous month and return the *last* day of that month.

So:

    <?php

    $date = new DateTime('2014-01-31');
    // clone the original so we can refer back to it.
    $original_date = clone($date);
    // add 3 months to the date, as before
    $date->add(new DateInterval('P3M'));

    // Check if the modified date matches what
    // we'd expect from the original date.
    if ($date->format('n') != ($original_date->format('n') + 3)) {
      // If it doesn't, roll back a month.
      $date->sub(new DateInterval( "P1M" ));
      // Output the date format using "t" to
      // get the number of days in the month.
      echo $new_date->format('Y-m-t');

      // outputs 2014-04-30 - win!
    }
    else {
      // All fine, output the date normally.
      echo $date->format('Y-m-d');
    }

So there we have it, adding months to dates doesn't quite have the behaviour you (well, I at least)
 might expect, but it's relatively straightforward to work around it to get what you want.
Obviously the code solution above  can be nicely abstracted into a function or class to allow the
number of months and start dates to be configured, and unit tests written to confirm that we get
what we expect for a variety of dates - and maybe that's something I'll write up in a future post.
