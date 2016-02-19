    <nav class="row">
      <div class="medium-6 medium-offset-3 columns">
        <ul>
          <li><a href="index.php" <?php if ($page == "index") { echo "class='active'"; }?>>Subscribe</a></li>
          <li><a href="unsubscribe.php" <?php if ($page == "unsubscribe") { echo "class='active'"; }?>>Unsubscribe</a></li>
          <li><a href="sendmail.php" <?php if ($page == "sendmail") { echo "class='active'"; }?>>Send Mail</a></li>
        </ul>
      </div>
    </nav>