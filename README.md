psched-main
===========

The user interface server/feed viewer for my php message scheduler project

This is the main server, which acts as the user hub. It has an area where you can schedule messages to be sent later(internally this add a message to the queue on a psched-dispatcher server). It also has an area that works like a "feed", showing all messages and when they were posted.

The main server never posts messages, just schedules them. They are queued on the dispatcher server, which will later post them to the main server via a backend api. The time displayed on a post is not the scheduled time, but the post time.

