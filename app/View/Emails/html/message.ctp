<p>Hello <?php echo $to; ?>,</p>

<p><?php echo $from; ?> just sent you this message through the Plymouth Entrepreneurs Society:</p>

<p><?php echo htmlspecialchars($message); ?></p>

<p>To reply to this message, visit this member through their profile at:</p>

<p><a href="//localhost/ISAD234/profile/<?php echo $toId; ?>">localhost/ISAD234/profile/<?php echo $toId; ?></a></p>