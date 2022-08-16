# Mentors

### Launch
Run InitializeMentors artisan command on production launch.  This assigns mentors

### UMS Integration
Mentors page showing all mentors
https://dev.musora.com/admin#/mentors

User Page can be used to :
- View, edit or set a Students Mentor
- Promote a mentor
- Demote a mentor, this reassigns all users and displays a list of reassigned emails
- View or edit mentor details like supported brands, active student count and max student count

### Help Scout Integration
/mentors/helpscout/conversation/new - Web hook endpoint for help scout new conversation.  Production web hook registered on InitializeMentors

Available helpscout artisan commands to fix issues with webhooks
```
r mwp artisan helpscout:webhooks
r mwp artisan helpscout:unregister {url}
r mwp artisan helpscout:register {url} convo.created
```

#### Debugging
Use ngrok to create an endpoint to your local test environment.  May need to register an account online to complete this operation.
```
ngrok http https://dev.musora.com:8443/
```
Take the ngrok.io url and build the web hook end point.  Run the following artisan command to register the webhook with helpscout.
  Only the production environment will actually update the conversation with the assigned mentor.
```
r mwp artisan helpscout:register https://3a05-50-67-89-148.ngrok.io/mentor/helpscout/conversation/new convo.created
```
Run helpscout:webhooks to make sure url is registered.

Tail the log file to watch incoming requests.  I changed my .env LOG_CHANNEL=single and run tail on the laravel log file in rail environment terminal(./rrr.sh)
```
tail -f /app/musora-web-platform/storage/logs/laravel.log
```

To test you can send an email to musora-dev-sandbox-testing@musoramedia.helpscoutapp.com to see the results.
