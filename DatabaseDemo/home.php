<?php
    $db = new mysqli('localhost','root','','registration_demo','3308');
    $sql = 'select * from users';
    $items = $db->query($sql);

    foreach ($items as $item) {
        printf('<li><span style="color: %s"> %s (%s)</span>
               <a href="update.php?id=%s">Update</a>
               <a href="delete.php?id=%s">Delete</a>
                </li>',
                $item['color'],
                $item['username'],
                $item['gender'],
            htmlspecialchars($item['id'], ENT_QUOTES),
            htmlspecialchars($item['id'], ENT_QUOTES));
    }
    $db->close();

?>
</ul>
