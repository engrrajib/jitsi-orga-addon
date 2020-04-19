# jitsi-orga-addon
This script can be used to organize jitsi meet conversations a little bit better.

## Installation
1. Download and unzip this repository
2. Edit config under `config/config.json` => see Configuration
3. Move the content of the folder to a destination webspace
4. Enjoy!

## Configuration-Parameters
Change the configuration and personalize your installation!

### name
Change the `name` value to the name you want to display in the top navbar

### password
`password`: This password is needed to join any conference room as participant

### homepage
Change `homepage`-Value to a site you want to redirect if the user clicks on the name. You can leave this blank if you don't want users to click the text.

### leader_password
The `leader_password` is the password that conference leaders need to enter before they can join the conversation as a leader.

### jitsi-domain
The Domain of the jitsi-Server. You can use the official one with the domain `meet.jit.si`

### conferences
The list of all conference rooms, that users should be able to use.
Format:
`{"name":"<ENTER READABLE NAME HERE", "jitsi-room":"<ENTER THE jitsi room-id of destination room here>"}`
for multiple conference rooms, just add multiple of this lines with an `,` at the end of each other, except for the last element.

## Need more features?
If you need more features like LDAP Authentication or permission groups, feel free to contact me:
jitsi-orga@support.philipprogramm.de

## Questions or Feedback
If you have questions or feedback for me, feel free to contact me under jitsi-orga@support.philipprogramm.de or leave a ticket under "Issues"

Have fun!
