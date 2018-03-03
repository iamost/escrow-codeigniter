<div class="container">
    <?php if (count($messages) > 0): ?>
        <table class="table">
            <thead class="table-active">
                <tr>
                    <th scope="col">
                        <?php
                        if ($type != MSG_SENT)
                            echo 'From';
                        else
                            echo 'Recipients';
                        ?>
                    </th>
                    <th scope="col">Subject</th>
                    <th scope="col">Date</th>
                    <?php if ($type != MSG_SENT): ?>
                        <th scope="col">Reply</th>
                    <?php endif; ?>
                    <th scope="col" class="text-center">
                        <?php
                        if ($type != MSG_DELETED)
                            echo 'Delete';
                        else
                            echo 'Restore';
                        ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($messages); $i++): ?>
                    <tr>
                        <td>
                            <?php
                            if ($type != MSG_SENT)
                                echo $messages[$i][TF_PM_AUTHOR];
                            else {
                                $recipients = $messages[$i][PM_RECIPIENTS];
                                foreach ($recipients as $recipient)
                                    echo (next($recipients)) ? $recipient . ', ' : $recipient;
                            }
                            ?>
                        </td>
                        <td>
                            <a href='<?php echo site_url() . '/pm/message/' . $messages[$i][TF_PM_ID]; ?>'><?php echo $messages[$i][TF_PM_SUBJECT] ?></a>
                        </td>
                        <td>
                            <?php echo $messages[$i][TF_PM_DATE]; ?>
                        </td>
                        <?php if ($type != MSG_SENT): ?>
                            <td>
                                <?php echo '<a href="' . site_url() . '/pm/send/' . $messages[$i][TF_PM_AUTHOR] . '/RE&#58;' . $messages[$i][TF_PM_SUBJECT] . '"> reply </a>' ?>
                            </td>
                        <?php endif; ?>
                        <td align="center">
                            <?php
                            if ($type != MSG_DELETED)
                                echo '<a href="' . site_url() . '/pm/delete/' . $messages[$i][TF_PM_ID] . '/' . $type . '"> &times; </a>';
                            else
                                echo '<a href="' . site_url() . '/pm/restore/' . $messages[$i][TF_PM_ID] . '"> o </a>';
                            ?>
                        </td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    <?php else: ?>
    <h3 class="text-muted text-center">No messages found.</h3>
    <?php endif; ?>
</div>