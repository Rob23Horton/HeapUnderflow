<h1>Topics</h1>
<b1>

    <?php

        include("connection.php");
        include_once("TopicFunctions.php");

        $topics = GetAllTopicNames($conn);

        foreach ($topics as $topic)
        {
            echo '<p class="vertical-box-item"><a class="header-button-style & button-update & link-button" href="../Pages/TopicPage.php?topic=' . htmlspecialchars($topic) . '">'.$topic.'</a> </p>';
        }

    ?>
</b1>