<?php $this->load->helper('url'); ?>
<div class="container">
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo site_url() . "pm/index" ?>">Inbox</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url() . "pm/messages/" . MSG_UNREAD ?>">Unread</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url() . "pm/messages/" . MSG_SENT ?>">Sent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url() . "pm/messages/" . MSG_DELETED ?>">Trashed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url() . "pm/send" ?>">Compose</a>
        </li>
    </ul>
</div>
