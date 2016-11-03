<!DOCTYPE html>
<html>
	<head>
		<title>Easy nsIVersionComparator</title>
	</head>
	<body>
		<p>Check the result of a services.vc comparison.
        <form action="ezvc.php" method="post">
            Current Version: <input type="text" name="currVersion"><br>
            Compare to Version: <input type="text" name="compVersion"><br>
            <input type="submit">
        </form>
        <hr>
        <?php
            require_once('../backend/modules/nsIVersionComparator.php');
            if (array_key_exists('currVersion', $_POST) && array_key_exists('compVersion', $_POST)) {
                
                $vcResult = ToolkitVersionComparator::compare($_POST['currVersion'], $_POST['compVersion']);
                
                if ($vcResult < 0) {
                    $htmlWriteOut = '<p>Current version: ' . $_POST['currVersion'] . ' is older than Compare Version: ' . $_POST['compVersion'] . '</p>';
                }
                elseif ($vcResult == 0) {
                    $htmlWriteOut = '<p>Current version: ' . $_POST['currVersion'] . ' is the same as Compare Version: ' . $_POST['compVersion'] . '</p>';
                }
                elseif ($vcResult > 0) {
                    $htmlWriteOut = '<p>Current version: ' . $_POST['currVersion'] . ' is newer than Compare Version: ' . $_POST['compVersion'] . '</p>';
                }
                print($htmlWriteOut);
            }
        ?>
	</body>
</html>