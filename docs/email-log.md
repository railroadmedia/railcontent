# Email Log

Emails are streamed from AWS Simple Email Service to Open Search using AWS Kinesis.
View the [OpenSearch Dashboard](https://search-email-log-4bijp3p4noj2rffivy5ae5tnoa.us-east-2.es.amazonaws.com/_dashboards/app/login?nextUrl=%2F_dashboards) to get started.
The login information is under "OpenSearch Email Log" in 1Password.

This was the guide used to configure the system.
https://aws.amazon.com/premiumsupport/knowledge-center/ses-email-sending-history/

# Setup Notes

### Kinesis
[Kinesis Stream](https://us-east-2.console.aws.amazon.com/firehose/home?region=us-east-2#/details/email-log-stream/configuration)

### SES
[SES Configuration Set](https://us-east-2.console.aws.amazon.com/ses/home?region=us-east-2#/configuration-sets/email-log)

Each domain needed to be setup as a verified identity and the default configuration set to the email-log
https://us-east-2.console.aws.amazon.com/ses/home?region=us-east-2#/verified-identities

If emails are not coming through to kinesis, make sure configuration set Event destination is enabled.  

### OpenSearch
[OpenSearch Domain](https://us-east-2.console.aws.amazon.com/aos/home?region=us-east-2#opensearch/domains/email-log)

Setup a single 30GB node.

OpenSearch was not setup in the VPC due to complications connecting to the system.  

OpenSearch required the kinesis Backend role to be added to the all_access role to all bulk inserts of data
https://aws.amazon.com/premiumsupport/knowledge-center/opensearch-troubleshoot-cloudwatch-logs/
