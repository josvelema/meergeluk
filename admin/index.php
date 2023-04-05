<?php
include 'main.php';
// Retrieve all messages
$stmt = $pdo->prepare('SELECT * FROM messages WHERE cast(submit_date as DATE) = cast(now() as DATE) ORDER BY submit_date DESC');
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Retrieve the average messages per day
$stmt = $pdo->prepare('SELECT count(*) * 1.0 / count(DISTINCT cast(submit_date as DATE)) FROM messages');
$stmt->execute();
$messages_average_per_day = $stmt->fetchColumn();
// Retrieve the total number of unique emails
$stmt = $pdo->prepare('SELECT count(DISTINCT email) AS total FROM messages');
$stmt->execute();
$total_unique_emails = $stmt->fetchColumn();
// Get the total number of messages
$stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM messages');
$stmt->execute();
$messages_total = $stmt->fetchColumn();
// Get the total number of unread messages
$stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM messages WHERE is_read = 0');
$stmt->execute();
$unread_messages_total = $stmt->fetchColumn();
?>
<?=template_admin_header('Dashboard', 'dashboard')?>

<h2>Dashboard</h2>

<div class="dashboard">
    <div class="content-block stat">
        <div>
            <h3>Today's Messages</h3>
            <p><?=number_format(count($messages))?></p>
        </div>
        <i class="fas fa-envelope-open-text"></i>
    </div>

    <div class="content-block stat">
        <div>
            <h3>Total Unread Messages</h3>
            <p><?=number_format($unread_messages_total)?></p>
        </div>
        <i class="fas fa-envelope"></i>
    </div>

    <div class="content-block stat">
        <div>
            <h3>Total Messages</h3>
            <p><?=number_format($messages_total)?></p>
        </div>
        <i class="fas fa-inbox"></i>
    </div>

    <div class="content-block stat">
        <div>
            <h3>Avg Messages Per Day</h3>
            <p><?=number_format($messages_average_per_day, 2)?></p>
        </div>
        <i class="fas fa-clock"></i>
    </div>

</div>

<h2>Today's Messages</h2>

<div class="content-block">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>From</td>
                    <td>Subject</td>
                    <td class="responsive-hidden">Message</td>
                    <td class="responsive-hidden">Date</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                <tr>
                    <td colspan="8" style="text-align:center;">There are no recent messages</td>
                </tr>
                <?php else: ?>
                <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?=$message['email']?></td>
                    <td><?=mb_strimwidth(nl2br(htmlspecialchars($message['subject'], ENT_QUOTES)), 0, 100, '...')?></td>
                    <td class="responsive-hidden"><?=mb_strimwidth(nl2br(htmlspecialchars($message['msg'], ENT_QUOTES)), 0, 50, '...')?></td>
                    <td class="responsive-hidden"><?=date('F j, Y H:ia', strtotime($message['submit_date']))?></td>
                    <td>
                        <a href="message.php?id=<?=$message['id']?>">View</a>
                        <a href="messages.php?delete=<?=$message['id']?>" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?=template_admin_footer()?>