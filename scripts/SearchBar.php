<script src="javascript/SearchBar.js"></script>

<div>

    <h1>Search</h1>
    <b1>
        <form method="post" action="scripts/GetSearch.php">
            <div>
                <input type="text" name="SearchInput" placeholder="Search Here">
                <button type="submit" class="header-button-style & button-update" style="margin-top:5px">Search</button>
            </div>
            <div><input type="text" id="ReturnAddress" name="ReturnAddress" hidden></div>
            
        </form>

        <?php

        function IsTopic($var)
        {
            return $var[0] == "t" ? true : false;
        }

        function IsSubject($var)
        {
            return $var[0] == "s" ? true : false;
        }
        
        include_once("TopicFunctions.php");
        
        if (isset($_POST["SearchResultNum"]) && (int)$_POST["SearchResultNum"] > 0)
        {
            $resultCount = (int)$_POST["SearchResultNum"];

            $results = [];

            for ($counter = 0; $counter < $resultCount; $counter++)
            {
                array_push($results, $_POST["SearchResult$counter"]);
            }

            $topics = array_filter($results, "IsTopic");
            $subjects = array_filter($results, "IsSubject");


            echo '<div>';

            if (sizeof($topics) > 0)
            {
                echo '<h3>Topics ('.sizeof($topics).')</h3><b6>';

                foreach ($topics as $topic)
                {
                    $name = substr($topic, 1);
                    echo '<div style="padding-bottom:5px"><a class="header-button-style & button-update & link-button" href="../TopicPage.php?topic='.urlencode($name).'">'.$name.'</a></div>';
                }

                echo '</b6>';
            }

            if (sizeof($subjects) > 0){
                echo '<h3>Subjects ('.sizeof($subjects).')</h3><b6>';

                foreach ($subjects as $subject)
                {
                    $name = substr($subject, 1+4);
                    $topic_code = substr($subject, 1, 4);
                    $topicName = GetTopicNameFromId($conn, $topic_code);

                    echo '<div style="padding-bottom:5px"><a class="header-button-style & button-update & link-button" href="../SubjectPage.php?topic='.urlencode($topicName).'&subject='.urlencode($name).'">'.$name.'</a></div>';
                }

                echo '</b6>';
            }

            
            echo '</div>';
        }
        else if (isset($_POST["SearchResultNum"]))
        {
            echo '<div><p>No Result</p></div>';
        }
        
        ?>

    </b1>
</div>