---
layout: post
title: Reviewing code reviews
date: '2013-11-28'
description: What makes a good code review?
categories:
tags: [Development]

summary: "How to make sure your code reviews are effective"
---

A large part of my role, and that of most senior developers, is carrying out reviews
of the code written by the team to ensure that it meets coding standards for performance,
security, architectural principles, and adherance to the conventions of the framework or
platform being developed.

This can soon turn into a full time job in itself, and working round that volume of work
can lead to rushed or ignored reviews. I'd like to share a few things I've found useful
in avoiding this, and ensuring code reviews remain a valued and respected part of the development
process. My examples will largely focus on reviewing Drupal code, but easily apply
elsewhere.

<!--break-->

#### Automate as much as possible

The more you can automate, the less you have to do manually. There are so
many aspects of code which can be automatically checked, even before a code review is created, which
can speed up the code review process. Use code sniffers to check adherance to coding
standards and look for parsing errors, run unit tests, run mess detection.

All of this can be done on the developers workstation before they commit - ideally triggered
as pre-commit hooks so that the responsibilty is placed back to the developer making the change
and you don't have to spend your time writing:

> add a space between ) and {

#### Use a tool

There are lots of tools you can use for your code review process - Atlassian Crucible/Fisheye, Github,
Gerrit, Phabricator to name a few. Your workflow, VCS and other tools may dictate which one
is best for you, but ensure that you have a single place to go to review code, add comments. Ideally the
tool will integrate with your issue/task tracker so you can quickly move between requirement and
solution to give your review context (and tie review "pass" or "fail" into the ticket workflow).

The benefits of a central tool are:

* Visibility of changes and comments through the whole team
* People who join a review part way through can see previous comments and the progression of
a piece of code
* Encourages other developers to get involved in doing code reviews, or even if they just "watch" them
then they will begin to see what things are being picked up regularly and try to avoid them
* Good tools allow you to browse back through repository histories so if you're concerned about a change
you can look back at previous changes to that area of code to understand the thinking

#### Review changesets, not whole files or patches

Reviewing a whole file in one go (unless it's a new file) can lead to comments being raised against code that
has not changed for the ticket you are concerned with. Whilst this kind of review can be useful in some
scenarios, generally you want to focus on the impacts of changes, and save the "big bang" reviews
for more formal technical debt reviews. Of course, if you code review from the start of the project then this will
be less necessary...

At the other end of the scale, reviewing a patch or diff on its own relies a lot on your brain
interpreting the diff, knowing the context of the code being changed (or going to some effort to
apply the patch in context).

Alternatively, reviewing a changeset from your VCS gives you more context, of both the change itself, and the
reasons for the change (from a good commit message).

#### Encourage small changes, and small reviews

The smaller the change, the easier it is to review.

Since reviewing generally involves looking at a bunch of changes and building a picture of how the
changes combine, the less moving parts there are to build that picture then the more likely you are
to miss something. Unfortunately at the point you're reviewing a huge change it's too late, so this is
a tip of building an ethos of regular reviews of small changes within your team, rather than saving up weeks
and weeks of work before submitting it for review.

This has other benefits, reviewing work as it goes along reducing the likelihood for the "big refactor"
later on when you realise a change needs significant re-work to pass review.

#### Keep the comments constructive

Remember that your review comments are about the code, and are in complete isolation from the person who
wrote the code. Keep the comments factual, refer to documented standards or approaches where relevant,
and if you spot large problems in the code then invite the author to sit with you whilst you review so
that you can discuss the review as you go through it and turn it into a learning/mentoring exercise which
will have a much more positive long term outcome than hitting someone with a multitude of review comments.

#### Share the burden

Don't try and review every change yourself. If you do then you're introducing a bottleneck on your
workflow and creating a Big Red Bus risk. Encourage everyone in the team to participate in reviews,
even if the final say is yours. From this you will gradually develop new reviewers and spread the
responsibility of the final approval.

#### Don't give up!

Effective code review is directly linked to quality of the code which reaches production, so don't give in
to time or management pressures and skip reviews. To support this, the graphs below shows the impact on new
defects (bottom graph) raised with a corresponding increase in code review coverage (top graph) when a project I've recently worked
on introduced mandatory code reviews for every change...

![picture Code review coverage vs New defects](/components/images/code-reviews.png "Code review coverage vs New defects")

...as you can see, the argument about whether code reviews were a good thing was ended pretty quickly!

So that's my brain dump... what other things do you find make code reviewing easier or more effective?
