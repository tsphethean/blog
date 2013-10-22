---
layout: post
title: Answering "How long will it take?"
date: '2013-10-21'
description: Estimation, a developer perspective
categories:
tags: [Development, Agile]
draft: true

summary: "How long will it take?"
---
> "How long will it take to build my [thing]?"

A seemingly simple question that can strike fear into the heart of many developers,
estimation is both essential and fruitless at the same time. As a developer, you might
feel you can never win - always asked to do things quicker - whilst a project manager
usually wonders why developers estimates are inaccurate. In this post I hope to share
some techniques that have helped me along the way, and might keep the questioning PM at bay.

#### It's only an estimate

The first thing to remember, is the definition of estimate:

> "an approximate calculation or judgement of the value, number, quantity, or extent of something...
Synonyms: approximation, evaluation, **guess**"
[The Oxford Dictionary](http://www.oxforddictionaries.com/definition/english/estimate)

Estimate equals guess. Done properly, it should be an educated guess but your estimate is always going to be
flawed in some way, something will change, be discovered, or interfere and mean you're not going to
be 100% correct.

Getting it wrong doesn't matter, it's part of the learning process.

Simply take note of why your estimate was wrong, and feed that into your next round of estimating (remembering
that the same problem might not come up next time).

#### Never answer right away

How many times have you been asked how long something would take, maybe
in your daily standup, and quickly responded "by the end of the day", "end of the week", or similar,
without really thinking the estimate through? Sometimes you might get lucky and things pan out ok,
but many times these instinctive estimates don't think through the problem properly and
often take longer than first given.

Now that's fine, it was only an estimate after all, but you've set an expectation and in all likelihood
you're going to work extra hours to make it happen to avoid disappointing someone.

The best tip I ever read, came from reading [The Pragmatic Programmer](http://pragprog.com/the-pragmatic-programmer),
and went something like:

> "You almost always get better results if you slow the process down... Estimates given at the coffee
machine will come back to haunt you."

Step away from the discussion, ask for time to analyse the problem, even if its half an hour to organise your thoughts,
before giving an estimate and ensuring it's something you believe.

#### Break down the task

For small tasks, arriving at an estimate can be pretty straightforward, but usually we're not being asked for small
task estimates - people want to know how long adding a new feature, or building a new website, will take. The trouble with
this is that seemingly simple tasks can hide a multitude of traps that could inflate (or deflate) your estimate.

When faced with problems like this, the only way we can process enough information to give anything like an accurate
estimate is by breaking the task down into as many constituent sub-tasks as necessary until each sub-task can easily be
envisaged and estimated.

Break down the feature into components you're comfortable estimating. As a hint, if the estimate for any one component
is longer than 3 or 4 days, you probably need to break it down further. But having said that, don't make any task smaller than
half a day in your estimates - even that trivial one line code change will need regression testing, unit tests tweaking,
functional tests updating, and code review performing, so it's never "just a 10 minute change".

One word of warning though - you're not trying to do a detailed design here, just trying to get tasks or stories at a
level granular enough for you to know roughly what you're going to need to do.

#### List your assumptions

Every estimate is based on some assumptions you've made, so make sure you share these when presenting your
estimate back to whoever asked for it. If you think there are no assumptions, then have a look through the list
below and see if any would apply:

My estimate is accurate as long as ...

* ...I get uninterrupted time to focus on it
* ...the environments are configured correctly
* ...I can re-use component X that we built last time, without significant refactoring
* ...the interface specification is accurate

Also, make sure you define "done". Will done mean that you've committed the code and run some tests locally, or that
you'll have followed the change through various environments and its ready to be pushed into the next Production release?
Make sure you and and the person you're giving the estimate to have the same definition of done.

#### Add inflation

We've covered this a little bit when saying not to estimate any sub-task at less than half a day, in order to factor in
all the things we forget about when estimating. However, even when you add up all your sub-tasks (or put them into groups for
adding up) we should pad our larger estimates to reflect the inherant uncertainty in the longer term estimate.

For example, if your estimate is between 3-4 days, call it a week. If it's 3 weeks, then its a month, and so on. Using
larger values of time helps set expectations with your stakeholders and also lets you have contingency for the
inevitable unforseen roadblocks that will arise.

#### Look back

One of the number one criticisms of estimation is that we never learn from our bad estimates,
and so never improve our accuracy. In many ways, this is a false accusation because as we've
seen no estimate is created equal, however there is something to be said for looking back and
comparing your estimate with your actual, and making note of the reasons you either missed or
achieved your estimate.

#### Conclusion

Estimates are unfortunately a necessary part of being a developer, and being able to give confident, accurate
estimates breeds confidence from the rest of your project team.

##### Further reading

- [The Pragmatic Programmer](http://pragprog.com/the-pragmatic-programmer) - particularly Chapter XX.
