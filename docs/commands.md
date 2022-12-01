# Commands

This contains information on some good practices and custom logic for handling commands.
See laravel commands for general command knowledge
https://laravel.com/docs/9.x/artisan.

### Execution

Local commands can be executed using

```
r mwp artisan {commandName}
```

Staging/Production commands can be executed use vapors CLI
(see https://docs.vapor.build/1.0/introduction.html#introduction)
or web interface (https://vapor.laravel.com/app)

### Naming

Names shall be camel case prefixed with the module name "{moduleName}:{commandName}"
Examples:

```
mentors:verify
notifications:dailySummary
```

### Base Command Class

There is a base command class, app/Console/Commands/Infrastructure/Command.php, with some handy functions for new
running and debugging new commands

The info function is overriden to log all information to both the command log and
the [system logs](logging.md#Production/Staging Logs) as it is more convenient to view logs in papertrail than waiting
for command to complete in vapor

Its important that we are aware of AWS Lambdas 15 minute timeout to ensure commands
are completely processed. Commands can be queued get around this and distribute the load:

```
runChainQuery(...)
runBatchQuery(...)
```

see references for how to use these functions.  
When chunking queries ensure you try different chuck counts to ensure the command is running optimally.
Changing chunks for 500 to 1000 count drastically improve total command time, sometimes 2x faster once you find the
optimal value

### Logging

Use the following code snippet to keep logging consistent between commands. It makes it easy to check the logs to see
when the commands were executed and how long they took.

```
        $this->info("Processing $this->name");
        $timeStart = microtime(true);
        
        //Logic here

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("Finished $this->name ($sec s)");
```

It is handy to search for Finished in the logs (https://my.papertrailapp.com/groups/19008992/events?q=Finished)
to get a quick overview of recent run commands, including scheduled commands.

### Scheduled Commands

Scheduled commands are defined in app/Console/Kernel.php.
Its a good practice to use batched/queued commands to ensure our system scales where necessary.
