# Overview

---

- [Priority 1](#p1)
- [Priority 2](#p2)
- [Priority 3](#p3)
- [Priority 4](#p4)
- [Priority 5](#p5)
- [Priority 6](#p6)


<a name="p1"></a>
## Priority 1
As a user I want to be able to create a workspace for my organization
Acceptance Criteria:
- I should be able to choose a ​unique​ name for my workspace
- A workspace can have multiple users
- A user can be part of multiple workspaces

<a name="p2"></a>
## Priority 2
As a user of a workspace I should be able to create channels in said workspace
Acceptance Criteria:
- The channel should have a name and description
- Bonus points for emoji support

<a name="p3"></a>
## Priority 3
As a user of a workspace I should be able to invite other users from the workspace to a channel
Acceptance Criteria:
- A channel can have multiple users
- A user can be part of multiple channels
- A user within a channel should be able to see all activity in the channel
- A user should be able to see all the channels they are a part of within a workspace
- A user needs to be invited to a channel to query it

<a name="p4"></a>
## Priority 4
As a user of a channel I should be able to send messages in the channel
Acceptance Criteria:
- A message belongs belongs to a user
- A message belongs to a channel
- I should be able to see all the messages in a channel if I am a member of the channel
- Bonus points for supporting emojis and gifs

<a name="p5"></a>
## Priority 5
As a user of a channel I should receive messages in real time
Acceptance Criteria:
- I should receive messages sent in the group in real time
- I should be notified via a push notification that a new message has been sent in the
channel
- I should not receive a message if I am it’s author

<a name="p6"></a>
## Priority 6
As a user I want to be able to authenticate to a workspace that I have created or been invited to
Acceptance Criteria:
- I should be able to authenticate into a workspace that I am a part of
- Bonus points for OAuth
