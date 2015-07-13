---
layout: default
title: Mail Panel
permalink: /docs/mail-panel/
---

# Mail Panel

This panel will track and display mails that have been sent via your application.

It comes with a panel to display data related to an `AuditEntry` as well as it's own grid and view to see all sent mail.

## Installation

You will need to [configure your application to send mail](http://www.yiiframework.com/doc-2.0/guide-tutorial-mailing.html).

As soon as the panel has been added to your configuration it will start tracking mail by listening to the `BaseMailer::EVENT_AFTER_SEND` event.

You can add it to your configuration as follows:

```php
<?php
$config = [
    'modules' => [
       'audit' => [
          'panels' => [
             'audit/mail',
          ],
       ],
    ],
]
```

## Usage

Simply send an email:

```php
<?php
Yii::$app->mailer->compose()
    ->setFrom('from@domain.com')
    ->setTo('to@domain.com')
    ->setSubject('Message subject')
    ->setTextBody('Plain text content')
    ->setHtmlBody('<b>HTML content</b>')
    ->send();
```

Now check in the audit module to see your mail:

```
http://localhost/path/to/index.php?r=audit/mail
```