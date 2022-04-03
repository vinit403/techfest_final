<?php
// Replace sender@example.com with your "From" address.
                // This address must be verified with Amazon SES.
                $sender = 'admin@techpulse.co.in';
                $senderName = 'Techpluse Admin';

                // Replace recipient@example.com with a "To" address. If your account
                // is still in the sandbox, this address must be verified.
                $recipient = $mailid;

                // Replace smtp_username with your Amazon SES SMTP user name.
                $usernameSmtp = 'postmaster@techpulse.co.in';

                // Replace smtp_password with your Amazon SES SMTP password.
                $passwordSmtp = 'f36f82f60f438dde08eefa8b87f8d86a-62916a6c-3012292c';

                // Specify a configuration set. If you do not want to use a configuration
                // set, comment or remove the next line.
                //$configurationSet = 'ConfigSet';

                // If you're using Amazon SES in a region other than US West (Oregon),
                // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
                // endpoint in the appropriate region.
                $host = 'smtp.mailgun.org';
                $port = 587;

?>