# Mentors

### Initialization

> **Note**: When testing locally it is best to disable customer.io job processing by setting the QUEUE_CONNECTION to
> database. Otherwise, processing will be much slower since it needs to wait for the
> customer.io requests

Run the following to create mentors, assign mentors to active users,
register the help scout web hook (Only in production) and populate the help scout user table.

```
r mwp artisan mentors:init
```

HELPSCOUT_MENTOR_MAILBOXES_TO_WATCH env variable must be set. Accepts comma list of mailbox ids.
Find mailbox ids that you want to update incoming conversations on with the following command

```
r mwp artisan helpscout:getMailBoxes
```

### UMS Integration

Mentors page showing all mentors
https://dev.musora.com/admin#/mentors

User Page can be used to :

- View, edit or set a Students Mentor
- Promote a mentor
- Demote a mentor, this reassigns all users and displays a list of reassigned emails
- View or edit mentor details like supported brands, active student count and max student count

### Help Scout Integration

The help scout integration is used to assign new incoming student conversations to their assigned mentors.
We receive incoming help scout web hook requests to determine which mentor to assign the conversation to.

/mentors/helpscout/conversation/new - Web hook endpoint for help scout new conversation. 
Production web hook registered on InitializeMentors

Available helpscout artisan commands to fix issues with webhooks

```
r mwp artisan helpscout:webhooks
r mwp artisan helpscout:unregister {url}
r mwp artisan helpscout:register {url} convo.created
```

#### Troubleshooting
If conversations are not being assigned in helpscout.

Does the user have an assigned mentor?  (see http://musora.com/admin/users/{id})
Is the mailbox you want to watch in env HELPSCOUT_MENTOR_MAILBOXES_TO_WATCH?
Is the Mentor in helpscout and do they have access to the watched mailbox? (see https://secure.helpscout.net/users/)
Does Mentor email in musora match helpscout email?  Otherwise we can't make the link.  See musora_laravel.helpscout_users table.

#### Testing on Staging

Make sure HELPSCOUT_MENTOR_MAILBOXES_TO_WATCH is set
Run mentor:registerWebHook to register the web hook

The final assignment will depend on whether the mentor is actually in the mailboxMaybe need to update helpscout_users to
all point to.  
For testing on the sandbox we can set all helpscout users to the Dev Department user

```
UPDATE helpscout_users SET helpscout_user_id = 554771
```

Ensure you unregister the web hook after

#### Debugging Locally

> **Note**: This did not work when i tried it on the office network, only at home

Use ngrok to create an endpoint to your local test environment. May need to register an account online to complete this
operation.

```
ngrok http https://dev.musora.com:8443/
```

Take the ngrok.io url and build the web hook end point. Run the following artisan command to register the webhook with
helpscout.

```
r mwp artisan helpscout:register https://3a05-50-67-89-148.ngrok.io/mentors/helpscout/conversation/new convo.created
```

Run helpscout:webhooks to make sure url is registered.

Tail the log file to watch incoming requests. I changed my .env LOG_CHANNEL=single and run tail on the laravel log file
in rail environment terminal(./rrr.sh)

```
tail -f /app/musora-web-platform/storage/logs/laravel.log
```

To test you can send an email to musora-dev-sandbox-testing@musoramedia.helpscoutapp.com to see the results.

### Customer IO Integration

Whenever a students mentor is updated we post the following customer attributes to the musora workspace in customer.io

- primary_brand
- assigned_mentor_email

See EventDataSynchronizer Module for implementation details

#### Debugging

Customer.io syncing uses Laravel Queues to push information to customer.io without interrupting the current request.  
Ensure the QUEUE_CONNECTION env setting is set to sync, to automatically process the jobs in real time.
By default this is setup to push data to the Customer.io Dev Sandbox Musora.
> **Note**: Demoting a mentor might not work with real time processing because it creates 1000s of calls to customer.io.
> To test this change QUEUE_CONNECTION to database and process the commands using the artisan queue:listen command

```
r mwp artisan queue:listen database --queue=customer-io --timeout=10000000
```
