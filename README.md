psched-main
===========

The user interface server/feed viewer for my php message scheduler project

This is the main server, which acts as the user hub. It has an area where you can schedule messages to be sent later(internally this add a message to the queue on a psched-dispatcher server). It also has an area that works like a "feed", showing all messages and when they were posted.

![Screenshot of Main Page](Main Interface.png "Main Page")

The main server posts messages, but the user is not able to do it via a standard interface. Instead they just schedule them. They are queued on the dispatcher server, which will later ask the main server to post them to the via a POST request. The time displayed on a post is not the scheduled time, but the post time.
